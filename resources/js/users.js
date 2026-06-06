(function () {
    const input = document.getElementById('users-search');
    const rows = document.querySelectorAll('.users-container');

    if (!input) return;
    input.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = (!q || text.includes(q)) ? '' : 'none';
        });
    });
})();