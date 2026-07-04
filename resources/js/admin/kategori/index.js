import { deleteData } from "./../../utility/delete.js";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".btn-delete").forEach((button) => {
        button.addEventListener("click", () => {
            deleteData({
                button,

                route: window.routes.deleteKategori,

                rowPrefix: "row",

                message: "Yakin ingin menghapus Kategori?",
            });
        });
    });
});
