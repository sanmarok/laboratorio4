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

// Función para validar el formato de correo electrónico
function isValidEmail(email) {
  // Utiliza una expresión regular simple para verificar el formato del correo electrónico
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
