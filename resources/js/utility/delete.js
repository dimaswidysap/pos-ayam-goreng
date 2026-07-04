import { showConfirm, showToast } from "./ui-alert.js";

export async function deleteData({
    button,
    route,
    rowPrefix = "row",
    message = "Apakah yakin ingin menghapus data?",
}) {
    const id = button.dataset.id;
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const tanggal = new URLSearchParams(window.location.search).get("tanggal");

    let url = route.replace(":id", id);
    if (tanggal) url += `?tanggal=${tanggal}`;

    const confirmed = await showConfirm(message);
    if (!confirmed) return;

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
            const row = document.getElementById(`${rowPrefix}-${id}`);
            if (row) row.remove();

            const totalPendapatan = document.getElementById("total-pendapatan");
            if (totalPendapatan && data.totalUangMasuk !== undefined) {
                totalPendapatan.textContent =
                    "Rp " + Number(data.totalUangMasuk).toLocaleString("id-ID");
            }

            showToast(data.message, "success");
        }

        return data;
    } catch (error) {
        console.error(error);
        showToast("Terjadi kesalahan saat menghapus data.", "error");
        throw error;
    }
}
