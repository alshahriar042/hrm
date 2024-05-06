const navbar = document.querySelector(".nav-fixed");
window.onscroll = () => {
  if (window.scrollY > 0) {
    navbar.classList.add("nav-active");
  } else {
    navbar.classList.remove("nav-active");
  }
};

//nav active
const activePage = window.location.pathname;
const navLinks = document.querySelectorAll(".nav-item a").forEach((link) => {
  if (link.href.includes(`${activePage}`)) {
    link.classList.add("navText-active");
  }
});

// password text show and hide
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#id_password");

togglePassword.addEventListener("click", function (e) {
  // toggle the type attribute
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  // toggle the eye slash icon
  this.classList.toggle("fa-eye");
});
