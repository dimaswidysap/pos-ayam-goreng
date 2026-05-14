// code mencari produk


(function () {
    const input = document.getElementById('kategori-search-input');
    const rows = document.querySelectorAll('#produk-table tbody tr');

    console.log(input)
    console.log(rows)
    if (!input) return;
    input.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = (!q || text.includes(q)) ? '' : 'none';
        });
    });
})();