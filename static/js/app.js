//Toggle Show/Hide Password
const togglePassword = document.querySelector("#togglePasswordCheckBox");
// console.log(togglePassword);

const password = document.querySelector("#password");
// console.log(password);

togglePassword.addEventListener("click", () => {
  // Toggle the type attribute using
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";

  password.setAttribute("type", type);
});
