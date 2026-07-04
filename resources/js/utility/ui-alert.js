export function showConfirm(message = "Apakah yakin ingin menghapus data?") {
    return new Promise((resolve) => {
        const modal = document.getElementById("confirm-modal");
        const msgEl = document.getElementById("confirm-message");
        const btnOk = document.getElementById("confirm-ok");
        const btnCancel = document.getElementById("confirm-cancel");

        msgEl.textContent = message;
        modal.classList.remove("hidden");
        modal.classList.add("flex");

        function cleanup(result) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            btnOk.removeEventListener("click", onOk);
            btnCancel.removeEventListener("click", onCancel);
            resolve(result);
        }

        function onOk() {
            cleanup(true);
        }
        function onCancel() {
            cleanup(false);
        }

        btnOk.addEventListener("click", onOk);
        btnCancel.addEventListener("click", onCancel);
    });
}

export function showToast(message, type = "success") {
    const toast = document.getElementById("toast-alert");
    const msgEl = document.getElementById("toast-message");

    const colorClass =
        {
            success: "bg-secondary",
            error: "bg-red-500",
        }[type] || "bg-secondary";

    toast.className = `fixed top-10 right-1/2 translate-x-[50%] z-110 px-4 py-3 rounded-md shadow-lg text-sm text-white max-w-sm ${colorClass}`;
    msgEl.textContent = message;
    toast.classList.remove("hidden");

    setTimeout(() => {
        toast.classList.add("hidden");
    }, 4000);
}
