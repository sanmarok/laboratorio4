// functions/functions.js

document.addEventListener("DOMContentLoaded", function () {
  $(function () {
    $("#dataTableUsers")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
      })
      .buttons()
      .container()
      .appendTo("#dataTableUsers_wrapper .col-md-6:eq(0)");
  });
});

function togglePassword(inputId) {
  var passwordInput = document.getElementById(inputId);
  var showPasswordBtn = document.getElementById("showPasswordBtn");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    showPasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    passwordInput.type = "password";
    showPasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
  }
}

// Validation function with Bootstrap classes
function validateAddUserForm() {
  var form = document.getElementById("newUserForm");
  var password = document.getElementById("password");
  var confirmPassword = document.getElementById("confirm_password");
  var passwordMismatchMessage = document.getElementById(
    "passwordMismatchMessage"
  );
  var name = document.getElementById("name");
  var lastName = document.getElementById("last_name");

  // Remove the Bootstrap was-validated class to reset the validation state
  form.classList.remove("was-validated");

  // Clear previous error messages
  passwordMismatchMessage.style.display = "none";

  // Add the Bootstrap validation class to trigger the styling and feedback
  form.classList.add("was-validated");

  // Perform custom validation
  if (password.value !== confirmPassword.value) {
    // If passwords don't match, show error message, mark the confirm password field as invalid, and focus on the password field
    passwordMismatchMessage.style.display = "block";
    confirmPassword.classList.remove("is-valid");
    confirmPassword.classList.add("is-invalid");
    password.focus();
    return false; // Prevent the form from being submitted
  } else {
    // If passwords match, remove the is-invalid class and add the is-valid class to the confirm password field
    confirmPassword.classList.remove("is-invalid");
    confirmPassword.classList.add("is-valid");
  }

  // Additional custom validation if needed

  // Check name and last name length
  if (name.value.length < 2 || lastName.value.length < 2) {
    return false;
  }

  return form.checkValidity(); // Allow the form to be submitted if it's valid
}

function denegatedUser() {
  Swal.fire({
    icon: "error",
    title: "Acceso no permitido",
    text: "No tienes permisos para acceder a esta página.",
    showConfirmButton: false,
    timer: 1000,
    customClass: {
      popup: "white-text",
      title: "white-text",
    },
  }).then(() => {
    window.location = "home";
  });
}

function confirmDeleteUser(button) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, borrarlo",
  }).then((result) => {
    if (result.isConfirmed) {
      // Obtén el formulario y envíalo
      var form = button.nextElementSibling;
      form.submit();
      Swal.fire("¡Borrado!", "El usuario ha sido borrado.", "success");
    }
  });
}
