// ===== DARK MODE =====
const tombol = document.getElementById('themeToggle');

if (tombol) {
    tombol.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}

// ===== BELI (KURANGI STOK) =====
document.querySelectorAll('.btn-beli').forEach(btn => {
    btn.addEventListener('click', () => {
        const stockEl = btn.parentElement.querySelector('.stock-number');
        let stock = parseInt(stockEl.innerText);

        if (stock > 0) {
            stock--;
            stockEl.innerText = stock;
            alert('Berhasil membeli!');
        } else {
            alert('Stok habis!');
        }
    });
});