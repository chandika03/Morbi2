// const form = document.querySelector("form");
const form = document.getElementById("myform");
const login = document.getElementById("login-btn");
const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm-password");
const nameError = document.getElementById("name-error");
const emailError = document.getElementById("email-error");
const passwordError = document.getElementById("password-error");
const confirmPasswordError = document.getElementById("confirm-password-error");

login.addEventListener("submit", function (event) {
  event.preventDefault();
  if (
    validateName() &&
    validateEmail() &&
    validatePassword() &&
    validateConfirmPassword()
  ) {
    form.submit();
  }
});

function validateName() {
  const namevalue = nameInput.value.trim();
  const nameregex = /^[a-zA-Z\s]+$/;
  if (namevalue === "") {
    setError(nameInput, "Name needs to be filled out", "name-error");
    return false;
  } else if (!nameregex.test(namevalue)) {
    setError(nameInput, "Name shouldn't contain number.", "name-error");
    return false;
  } else {
    removeError(nameInput, "name-error");
    return true;
  }
}

function validateEmail() {
  const emailValue = emailInput.value.trim();
  const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (emailValue === "") {
    setError(emailInput, "Email is required", "email-error");
  } else if (!emailRegex.test(emailValue)) {
    setError(emailInput, "Invalid email format!", "email-error");
  } else {
    removeError(emailInput, "email-error");
    return true;
  }
}

function validatePassword() {
  const passValue = passwordInput.value.trim();
  if (passValue === "") {
    setError(passwordInput, "Password is required", "password-error");
    return false;
  } else if (passValue.length < 8) {
    setError(
      passwordInput,
      " Password must be atleast 8 characters",
      "password-error"
    );
    return false;
  } else {
    removeError(passwordInput, "password-error");
    return true;
  }
}

function validateConfirmPassword() {
  const confirmPassValue = confirmPasswordInput.value.trim();
  const passValue = passwordInput.value.trim();
  if (confirmPassValue === "") {
    setError(
      confirmPasswordInput,
      "Confirm password is required",
      "confirm-password-error"
    );
    return false;
  } else if (confirmPassValue !== passValue) {
    setError(
      confirmPasswordInput,
      "Passwords do not match",
      "confirm-password-error"
    );
    return false;
  } else {
    removeError(confirmPasswordInput, "confirm-password-error");
    return true;
  }
}

// Set error message
function setError(inputElement, message, errorId) {
  const errorElement = document.getElementById(errorId);
  errorElement.textContent = message;
  inputElement.classList.add("error-message");
}

// Remove error message
function removeError(inputElement, errorId) {
  const errorElement = document.getElementById(errorId);
  errorElement.textContent = "";
  inputElement.classList.remove("error-message");
}

// Event listeners
nameInput.addEventListener("blur", validateName);
emailInput.addEventListener("blur", validateEmail);
passwordInput.addEventListener("blur", validatePassword);
confirmPasswordInput.addEventListener("blur", validateConfirmPassword);

function togglePassword() {
  const x = passwordInput;
  const show = document.getElementById("hideopen");
  const hide = document.getElementById("hideclose");
  if (x.type === "password") {
    x.type = "text";
    show.style.display = "block";
    hide.style.display = "none";
  } else {
    x.type = "password";
    show.style.display = "none";
    hide.style.display = "block";
  }
}
function toggleCPassword() {
  const y = confirmPasswordInput;
  const show = document.getElementById("Chideopen");
  const hide = document.getElementById("Chideclose");
  if (y.type === "password") {
    y.type = "text";
    show.style.display = "block";
    hide.style.display = "none";
  } else {
    y.type = "password";
    show.style.display = "none";
    hide.style.display = "block";
  }
}
