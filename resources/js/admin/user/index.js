import { deleteData } from "./../../utility/delete.js";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".btn-delete").forEach((button) => {
        button.addEventListener("click", () => {
            deleteData({
                button,

                route: window.routes.deleteUser,

                rowPrefix: "row",

                message: "Yakin ingin menghapus User?",
            });
        });
    });
});
