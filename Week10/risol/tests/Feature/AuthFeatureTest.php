<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Feature Test untuk autentikasi modern Risol Majesty
 *
 * Mencakup pengujian:
 * - Google reCAPTCHA v2 (form login & register)
 * - Login Google SSO (Laravel Socialite)
 * - Proteksi route dengan middleware
 * - Pengujian HTTP 200 dan 302
 */
class AuthFeatureTest extends TestCase
{
    // ============================================================
    // PENGUJIAN HTTP 200 — Halaman dapat diakses
    // ============================================================

    /**
     * Uji halaman utama mengembalikan HTTP 200
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Uji halaman login mengembalikan HTTP 200
     * dan memuat form reCAPTCHA v2
     */
    public function test_login_page_is_accessible_and_has_recaptcha(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Pastikan widget reCAPTCHA ada di halaman login
        $response->assertSee('g-recaptcha');
        $response->assertSee('recaptcha/api.js');
    }

    /**
     * Uji halaman register mengembalikan HTTP 200
     * dan memuat form reCAPTCHA v2
     */
    public function test_register_page_is_accessible_and_has_recaptcha(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Pastikan widget reCAPTCHA ada di halaman register
        $response->assertSee('g-recaptcha');
        $response->assertSee('recaptcha/api.js');
    }

    // ============================================================
    // PENGUJIAN HTTP 302 — Redirect
    // ============================================================

    /**
     * Uji endpoint Google SSO redirect mengembalikan HTTP 302
     * (redirect ke halaman login Google)
     */
    public function test_google_redirect_route_returns_302(): void
    {
        $response = $this->get('/auth/google/redirect');

        // Google SSO harus me-redirect user ke OAuth Google
        $response->assertStatus(302);
    }

    /**
     * Uji halaman manage tidak bisa diakses tanpa login
     * harus redirect ke halaman login (HTTP 302)
     */
    public function test_manage_page_redirects_to_login_without_auth(): void
    {
        $response = $this->get('/manage');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Uji logout redirect ke halaman home (HTTP 302)
     */
    public function test_logout_redirects_to_home(): void
    {
        // Simulasi user sudah login
        $this->withSession(['login' => true, 'user' => 'admin']);

        $response = $this->post('/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    // ============================================================
    // PENGUJIAN VALIDASI reCAPTCHA
    // ============================================================

    /**
     * Uji login ditolak jika reCAPTCHA tidak dicentang
     * (g-recaptcha-response kosong) — menggunakan Http::fake()
     * agar tidak bergantung pada koneksi ke server Google
     */
    public function test_login_is_rejected_without_recaptcha(): void
    {
        // Mock HTTP: simulasi Google API menolak (success=false)
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => false,
                'error-codes' => ['missing-input-response'],
            ], 200),
        ]);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin123',
            // g-recaptcha-response sengaja tidak dikirim
        ]);

        // Harus dikembalikan ke form dengan error
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['g-recaptcha-response']);
    }

    /**
     * Uji register ditolak jika reCAPTCHA tidak dicentang
     * — menggunakan Http::fake() agar tidak bergantung pada jaringan
     */
    public function test_register_is_rejected_without_recaptcha(): void
    {
        // Mock HTTP: simulasi Google API menolak (success=false)
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => false,
                'error-codes' => ['missing-input-response'],
            ], 200),
        ]);

        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
            // g-recaptcha-response sengaja tidak dikirim
        ]);

        // Harus dikembalikan ke form dengan error
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['g-recaptcha-response']);
    }

    // ============================================================
    // PENGUJIAN GOOGLE SSO
    // ============================================================

    /**
     * Uji route Google redirect tersedia dan berfungsi
     */
    public function test_google_sso_redirect_route_exists(): void
    {
        $response = $this->get('/auth/google/redirect');

        // Harus redirect (bukan 404/500)
        $this->assertContains($response->status(), [302, 200]);
    }
}
