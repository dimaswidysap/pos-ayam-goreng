import { deleteData } from "../utility/delete";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".btn-delete").forEach((button) => {
        button.addEventListener("click", () => {
            deleteData({
                button,

                route: window.routes.deleteTransaksi,

                rowPrefix: "row",

                message: "Yakin ingin menghapus transaksi?",
            });
        });
    });
});
