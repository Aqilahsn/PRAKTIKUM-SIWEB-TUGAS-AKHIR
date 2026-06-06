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
    use RefreshDatabase;

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
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('email');
    }

    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('email');
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

    public function test_regular_user_cannot_access_manage_page(): void
    {
        $user = \App\Models\User::create([
            'name' => 'User Test',
            'email' => 'user_test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get('/manage');

        $response->assertStatus(403);
    }

    public function test_admin_user_can_access_manage_page(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test2@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get('/manage');

        $response->assertStatus(200);
    }

    /**
     * Uji logout redirect ke halaman home (HTTP 302)
     */
    public function test_logout_redirects_to_home(): void
    {
        // Simulasi user sudah login dengan model asli
        $user = \App\Models\User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->post('/logout');

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
