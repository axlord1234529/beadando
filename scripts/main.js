let hamburger = document.querySelector(".hamburger");
hamburger.onclick = function () {
    let navBar = document.querySelector(".nav-bar");
    navBar.classList.toggle("active");
}

const wrapper = document.querySelector(".wrapper"),
    signupHeader = document.querySelector(".signup header"),
    loginHeader = document.querySelector(".login header");

loginHeader.addEventListener("click", () => {
    wrapper.classList.add("active");
});
signupHeader.addEventListener("click", () => {
    wrapper.classList.remove("active");
});