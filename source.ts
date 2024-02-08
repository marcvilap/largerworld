import Swiper from "swiper";
import { Navigation } from "swiper/modules";

const popup = document.querySelector("#popup");
document.querySelectorAll(".close-popup").forEach((elem) => {
  elem.addEventListener("click", () => {
    popup?.classList.add("opacity-0", "invisible");
  });
});

document.querySelectorAll(".reveal-group").forEach((elem) => {
  new IntersectionObserver((entries) => {
    entries.forEach((entry) =>
      elem.classList.toggle("reveal-active", entry.isIntersecting)
    );
  }).observe(elem);
});

const ajax_forms = document.querySelectorAll(
  "[data-ajax]"
) as NodeListOf<HTMLFormElement>;
ajax_forms.forEach((elem) => {
  elem.addEventListener("submit", async (event) => {
    event.preventDefault();
    let alert = elem.querySelector(".alert");
    let button = elem.querySelector("button");
    const button_html = button?.innerHTML ?? "";
    alert?.classList.remove("alert-success", "alert-failure");
    if (alert) alert.innerHTML = "";
    if (button) button.innerHTML = "<em>Sending...</em>";
    try {
      const ajax = elem.dataset.ajax;
      if (ajax) {
        const response = await fetch(ajax, {
          method: "POST",
          body: new FormData(elem),
        });
        const data = await response.json();
        const message = data.data;
        if (data.success) {
          if (message === "reload") {
            location.reload();
          } else {
            if (alert) alert.innerHTML = String(message);
            alert?.classList.add("alert-success");
            elem.reset();
          }
        } else {
          throw message;
        }
      }
    } catch (error) {
      if (alert) alert.innerHTML = String(error);
      alert?.classList.add("alert-failure");
    } finally {
      if (button) button.innerHTML = button_html;
    }
  });
});

new Swiper(".swiper", {
  modules: [Navigation],
  loop: true,
  slidesPerView: 1,
  spaceBetween: 0,
  navigation: {
    nextEl: ".swiper-next",
    prevEl: ".swiper-prev",
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
      spaceBetween: 16,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 32,
    },
  },
});
