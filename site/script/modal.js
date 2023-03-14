window.addEventListener('DOMContentLoaded',()=>{
	const modalOpen = document.querySelector("[data-modal]"),
      modalCLose = document.querySelector("[data-close]"),
      modalWindow = document.querySelector(".modal");
    modalOpen.addEventListener("click", function () {
      modalWindow.classList.add("show");
      modalWindow.classList.remove("hide");
      document.body.style.overflow = "hidden";
    });

    modalCLose.addEventListener("click", () => {
      modalWindow.classList.add("hide");
      modalWindow.classList.remove("show");
      document.body.style.overflow = "";
    });

    const modalDialog = document.querySelector(".modal__dialog");

    modalWindow.addEventListener("click", (e) => {
      if (e.target === modalDialog) {
        modalWindow.classList.add("hide");
        modalWindow.classList.remove("show");
        document.body.style.overflow = "";
      }
    });
})