export async function deleteData({
    button,
    route,
    rowPrefix = "row",
    message = "Apakah yakin ingin menghapus data?",
}) {
    const id = button.dataset.id;

    const token = document.querySelector('meta[name="csrf-token"]').content;

    // Ambil parameter tanggal dari URL (jika ada)
    const tanggal = new URLSearchParams(window.location.search).get("tanggal");

    // Buat URL request
    let url = route.replace(":id", id);

    if (tanggal) {
        url += `?tanggal=${tanggal}`;
    }

    // Konfirmasi
    if (!confirm(message)) {
        return;
    }

    try {
        const response = await fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": token,
                Accept: "application/json",
                "Content-Type": "application/json",
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP Error ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            // Hapus card/baris dari halaman
            const row = document.getElementById(`${rowPrefix}-${id}`);

            if (row) {
                row.remove();
            }

            // Update Total Pendapatan jika ada
            const totalPendapatan = document.getElementById("total-pendapatan");

            if (totalPendapatan && data.totalUangMasuk !== undefined) {
                totalPendapatan.textContent =
                    "Rp " + Number(data.totalUangMasuk).toLocaleString("id-ID");
            }

            alert(data.message);
        }

        return data;
    } catch (error) {
        console.error(error);

        alert("Terjadi kesalahan saat menghapus data.");

        throw error;
    }
}
