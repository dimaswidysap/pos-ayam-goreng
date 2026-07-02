const btnHamKasir = document.getElementById("agw-ham-kasir");
const sidebar = document.getElementById("sidebar");

btnHamKasir.addEventListener("click", () => {
    sidebar.classList.remove("translate-x-full");
});

const btnCloseKasir = document.getElementById("agw-close-kasir");

btnCloseKasir.addEventListener("click", () => {
    sidebar.classList.add("translate-x-full");
});
