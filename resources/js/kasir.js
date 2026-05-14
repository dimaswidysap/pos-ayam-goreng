// ============================================================
//  UTILITY
// ============================================================

/**
 * Format angka ke format Rupiah (tanpa simbol Rp)
 * contoh: 15000 → "15.000"
 */
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

/**
 * Tampilkan toast notifikasi sementara di pojok kanan bawah
 * @param {string} pesan  - teks yang ditampilkan
 * @param {string} tipe   - 'success' | 'error' | '' (default abu-abu)
 */
function showToast(pesan, tipe = '') {
    const toast = document.getElementById('toast');
    if (!toast) return;

    toast.textContent = pesan;
    toast.className =
        'fixed bottom-6 right-6 z-[9999] px-4 py-2 rounded-lg text-sm text-white ' +
        'transition-all duration-300 pointer-events-none';

    if (tipe === 'success') toast.classList.add('bg-green-600');
    else if (tipe === 'error') toast.classList.add('bg-red-500');
    else toast.classList.add('bg-slate-700');

    toast.classList.remove('opacity-0', 'translate-y-2');
    toast.classList.add('opacity-100', 'translate-y-0');

    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
        toast.classList.remove('opacity-100', 'translate-y-0');
    }, 3000);
}

// ============================================================
//  RENDER KERANJANG
// ============================================================

/**
 * Render ulang tabel keranjang berdasarkan data cart dari server/session
 * @param {Object} cartData - object cart { id: { name, price, quantity, ... } }
 */
function renderCart(cartData) {
    const tbody = document.getElementById('cart-table-body');
    const emptyMsg = document.getElementById('empty-cart-msg');
    const grandTotalEl = document.getElementById('grand-total');
    const totalItemEl = document.getElementById('total-item');

    if (!tbody) return;
    tbody.innerHTML = '';

    let grandTotal = 0;
    let totalItem = 0;

    for (const key in cartData) {
        const item = cartData[key];
        const subtotal = item.price * item.quantity;
        grandTotal += subtotal;
        totalItem += item.quantity;

        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-100 hover:bg-slate-50';
        tr.innerHTML = `
            <td class="py-2 max-w-[100px] overflow-hidden whitespace-nowrap text-ellipsis"
                title="${item.name}">${item.name}</td>
            <td class="py-2 text-center">${item.quantity}</td>
            <td class="py-2 text-right">${formatRupiah(item.price)}</td>
            <td class="py-2 text-right">${formatRupiah(subtotal)}</td>
            <td class="py-2 text-center">
                <button onclick="decreaseCart('${key}')"
                    class="w-6 h-6 rounded-full border border-red-400 text-red-500
                           hover:bg-red-500 hover:text-white flex items-center justify-center
                           text-base leading-none transition-colors mx-auto">
                    −
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    }

    if (grandTotalEl) grandTotalEl.innerText = formatRupiah(grandTotal);
    if (totalItemEl) totalItemEl.innerText = totalItem + ' item';
    if (emptyMsg) emptyMsg.style.display = totalItem === 0 ? 'block' : 'none';

    // Simpan state global untuk dipakai oleh fungsi lain
    window._cartData = cartData;
    window._grandTotal = grandTotal;

    // Hitung ulang kembalian jika input sudah ada isinya
    hitungKembalian();
}

// ============================================================
//  HITUNG KEMBALIAN REAL-TIME
// ============================================================

/**
 * Hitung dan tampilkan kembalian berdasarkan input uang pelanggan vs grand total.
 * Juga mengaktifkan / menonaktifkan tombol bayar.
 */
function hitungKembalian() {
    const inputBayar = document.getElementById('input-bayar');
    const kembalianEl = document.getElementById('kembalian-info');
    const btnBayar = document.getElementById('btn-bayar');

    if (!inputBayar || !kembalianEl || !btnBayar) return;

    const uang = parseFloat(inputBayar.value) || 0;
    const total = window._grandTotal || 0;

    if (total === 0) {
        kembalianEl.textContent = '';
        btnBayar.disabled = true;
        return;
    }

    if (uang >= total) {
        kembalianEl.textContent = 'Kembalian: Rp ' + formatRupiah(uang - total);
        kembalianEl.className = 'text-right text-sm font-semibold text-green-600 min-h-[20px]';
        btnBayar.disabled = false;
    } else if (uang > 0) {
        kembalianEl.textContent = 'Kurang: Rp ' + formatRupiah(total - uang);
        kembalianEl.className = 'text-right text-sm font-semibold text-red-500 min-h-[20px]';
        btnBayar.disabled = true;
    } else {
        kembalianEl.textContent = '';
        kembalianEl.className = 'text-right text-sm font-semibold min-h-[20px]';
        btnBayar.disabled = true;
    }
}

// ============================================================
//  FETCH: LOAD CART (saat halaman pertama kali dibuka)
// ============================================================

/**
 * Ambil data cart dari session Laravel, lalu render ke tabel
 */
function loadCart() {
    fetch('/kasir/getCart')
        .then(r => r.json())
        .then(data => {
            if (data.success) renderCart(data.cart);
        })
        .catch(e => console.error('loadCart error:', e));
}

// ============================================================
//  FETCH: TAMBAH ITEM KE CART
// ============================================================

/**
 * Kirim request tambah produk ke session cart Laravel
 */
function addCart(productId, productName, productPrice, category, foto) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    fetch('/kasir/addCart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            id: productId,
            name: productName,
            price: productPrice,
            category: category,
            foto: foto,
        }),
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                renderCart(data.cart);
                showToast(`✓ ${productName} ditambahkan`, 'success');
            }
        })
        .catch(e => console.error('addCart error:', e));
}

// ============================================================
//  FETCH: KURANGI / HAPUS ITEM DARI CART
// ============================================================

/**
 * Kurangi quantity item; jika sudah 1 maka item dihapus dari cart
 * Di-expose ke window agar bisa dipanggil dari onclick di innerHTML
 */
window.decreaseCart = function (productId) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    fetch('/kasir/decreaseCart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ id: productId }),
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) renderCart(data.cart);
        })
        .catch(e => console.error('decreaseCart error:', e));
};

// ============================================================
//  FETCH: PROSES PEMBAYARAN
// ============================================================

/**
 * Kirim data transaksi ke server, tampilkan struk jika berhasil
 */
function prosesBayar() {
    const inputBayar = document.getElementById('input-bayar');
    const btnBayar = document.getElementById('btn-bayar');
    const uangPelanggan = parseFloat(inputBayar.value) || 0;
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    if (uangPelanggan <= 0) {
        showToast('Masukkan uang pelanggan terlebih dahulu.', 'error');
        return;
    }

    btnBayar.disabled = true;
    btnBayar.textContent = 'Memproses...';

    fetch('/kasir/cetakTransaksi', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ uang_pelanggan: uangPelanggan }),
    })
        .then(r => r.json())
        .then(data => {
            btnBayar.textContent = 'Proses Pembayaran';

            if (data.success) {
                // Tampilkan struk di modal, reset cart & input
                tampilkanStruk(data, window._cartData, uangPelanggan, window._grandTotal);
                renderCart({});
                inputBayar.value = '';
            } else {
                showToast(data.message, 'error');
                btnBayar.disabled = false;
            }
        })
        .catch(e => {
            console.error('prosesBayar error:', e);
            showToast('Terjadi kesalahan jaringan.', 'error');
            btnBayar.disabled = false;
            btnBayar.textContent = 'Proses Pembayaran';
        });
}

// ============================================================
//  MODAL STRUK
// ============================================================

/**
 * Isi konten modal struk lalu tampilkan
 */
function tampilkanStruk(responseData, cartData, uangPelanggan, totalHarga) {
    const now = new Date();
    const tgl = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const noTrx = String(responseData.id_transaksi).padStart(5, '0');

    // Baris item
    let itemsHtml = '';
    for (const key in cartData) {
        const item = cartData[key];
        const subtotal = item.price * item.quantity;
        itemsHtml += `
            <div style="display:flex;justify-content:space-between;margin-bottom:6px">
                <div>
                    <div style="font-weight:600">${item.name}</div>
                    <div style="color:#888;font-size:.75rem">
                        ${item.quantity} x Rp ${formatRupiah(item.price)}
                    </div>
                </div>
                <div style="white-space:nowrap;font-weight:600">
                    Rp ${formatRupiah(subtotal)}
                </div>
            </div>`;
    }

    // Desain Struk Baru
    document.getElementById('struk-content').innerHTML = `
    <div class="text-center mb-4 pb-4 border-b border-dashed border-border-dark">
        <h3 class="text-lg font-black text-text tracking-widest uppercase italic">
            Ayam Goreng Widy
        </h3>
        <p class="text-[10px] text-text-muted mt-1 font-sans font-medium">
            ${tgl} — ${jam}
        </p>
        <p class="text-[10px] text-text-light font-sans tracking-tight">
            ID TRX: #${noTrx}
        </p>
    </div>

    <div class="space-y-2 mb-4 font-sans italic text-text">
        ${itemsHtml}
    </div>

    <div class="border-t border-dashed border-border-dark pt-3 space-y-1">
        <div class="flex justify-between font-black text-sm text-text">
            <span>TOTAL</span>
            <span>Rp ${formatRupiah(totalHarga)}</span>
        </div>
        
        <div class="flex justify-between text-[11px] text-text-muted pt-2 font-medium">
            <span>Bayar (Tunai)</span>
            <span>Rp ${formatRupiah(uangPelanggan)}</span>
        </div>
        
        <div class="flex justify-between font-bold text-secondary text-sm pt-1">
            <span>Kembalian</span>
            <span>Rp ${formatRupiah(responseData.kembalian)}</span>
        </div>
    </div>

    <div class="text-center mt-6 pt-4 border-t border-dashed border-border-dark font-sans italic">
        <p class="text-[11px] text-text font-bold">Terima kasih atas kunjungannya!</p>
        <p class="text-[10px] text-text-muted leading-relaxed">
            Semoga harimu menyenangkan & <br> selamat menikmati hidangan kami 😊
        </p>
    </div>
`;
    const modal = document.getElementById('modal-struk');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

/** Cetak struk via browser print dialog */
function cetakStruk() {
    window.print();
}

/** Tutup modal struk */
function tutupModal() {
    const modal = document.getElementById('modal-struk');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// ============================================================
//  FILTER KATEGORI
// ============================================================

function filterProduk() {
    const keyword = (document.getElementById('input-search')?.value || '')
        .toLowerCase()
        .trim();

    // ambil tombol kategori yang aktif
    const aktifBtn = document.querySelector(
        '#filter-kategori .filter-btn.bg-primary'
    );

    const kategori = aktifBtn?.dataset.kategori || 'semua';

    document.querySelectorAll('#grid-produk .add-to-cart-btn').forEach(card => {

        // filter nama produk
        const namaProduk = (card.dataset.name || '').toLowerCase();

        // filter kategori
        const kategoriProduk = (card.dataset.category || '').toLowerCase();

        const namaOk = namaProduk.includes(keyword);

        const katOk =
            kategori === 'semua' ||
            kategoriProduk === kategori.toLowerCase();

        card.style.display = namaOk && katOk ? '' : 'none';
    });
}

// ===============================
// EVENT SEARCH
// ===============================
document.getElementById('input-search')?.addEventListener('input', filterProduk);

// ===============================
// EVENT FILTER KATEGORI
// ===============================
document.querySelectorAll('#filter-kategori .filter-btn').forEach(btn => {

    btn.addEventListener('click', () => {

        // reset semua tombol
        document.querySelectorAll('#filter-kategori .filter-btn').forEach(b => {

            b.classList.remove(
                'bg-primary',
                'text-white'
            );

            b.classList.add(
                'bg-white',
                'text-text-muted'
            );
        });

        // aktifkan tombol yang dipilih
        btn.classList.remove(
            'bg-white',
            'text-text-muted'
        );

        btn.classList.add(
            'bg-primary',
            'text-white'
        );

        // jalankan filter
        filterProduk();
    });
});

// ============================================================
//  INIT — DOMContentLoaded
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

    // --- Muat cart dari session ---
    loadCart();

    // --- Klik kartu produk → tambah ke cart ---
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            addCart(
                this.dataset.id,
                this.dataset.name,
                this.dataset.price,
                this.dataset.category,
                this.dataset.foto,
            );
        });
    });

    // --- Input uang pelanggan → hitung kembalian real-time ---
    document.getElementById('input-bayar')
        ?.addEventListener('input', hitungKembalian);

    // --- Tombol Uang Pas ---
    document.getElementById('btn-uang-pas')
        ?.addEventListener('click', () => {
            const total = window._grandTotal || 0;
            if (total > 0) {
                document.getElementById('input-bayar').value = total;
                hitungKembalian();
            }
        });

    // --- Tombol Proses Pembayaran ---
    document.getElementById('btn-bayar')
        ?.addEventListener('click', prosesBayar);

    // --- Tombol Cetak (di dalam modal) ---
    document.getElementById('btn-cetak-struk')
        ?.addEventListener('click', cetakStruk);

    // --- Tombol Tutup Modal ---
    document.getElementById('btn-tutup-modal')
        ?.addEventListener('click', tutupModal);

    // --- Klik overlay modal → tutup ---
    document.getElementById('modal-struk')
        ?.addEventListener('click', function (e) {
            if (e.target === this) tutupModal();
        });

    // --- Filter kategori ---
    document.getElementById('filter-kategori')
        ?.addEventListener('click', function (e) {
            const btn = e.target.closest('button.filter-btn');
            if (!btn) return;

            // Reset semua tombol
            document.querySelectorAll('#filter-kategori .filter-btn').forEach(b => {
                b.classList.remove('bg-slate-700', 'text-white');
                b.classList.add('bg-white');
            });
            // Aktifkan tombol yang diklik
            btn.classList.add('bg-slate-700', 'text-white');
            btn.classList.remove('bg-white');

            filterProduk();
        });

    // --- Search produk ---
    document.getElementById('input-search')
        ?.addEventListener('input', filterProduk);
});