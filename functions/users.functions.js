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
  var email = document.getElementById("email"); // Agregado el campo de correo electrónico

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

  // Check name and last name length
  if (name.value.length < 2 || lastName.value.length < 2) {
    return false;
  }

  // Check email format using the isValidEmail function
  if (!isValidEmail(email.value)) {
    email.classList.add("is-invalid");
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

function confirmChangeStatus(button, userId, newStatus) {
  var confirmText = "";
  var successText = "";

  if (newStatus === "active") {
    confirmText = "¿Estás seguro de activar este usuario?";
    successText = "Usuario activado correctamente.";
  } else if (newStatus === "inactive") {
    confirmText = "¿Estás seguro de desactivar este usuario?";
    successText = "Usuario desactivado correctamente.";
  }

  Swal.fire({
    title: confirmText,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, cambiar estado",
  }).then((result) => {
    if (result.isConfirmed) {
      // Establece el nuevo estado en el formulario
      var form = document.getElementById("changeStatusForm" + userId);
      form.querySelector("[name=new_status]").value = newStatus;

      // Envía el formulario
      form.submit();

      Swal.fire("¡Éxito!", successText, "success");
    }
  });
}

function validateRestorePasswordForm(userId) {
  var form = document.getElementById("restorePasswordForm_" + userId);
  var newPassword = document.getElementById("newPasswordRestore_" + userId);
  var confirmPassword = document.getElementById(
    "confirmPasswordRestore_" + userId
  );
  var mismatchMessage = document.getElementById(
    "passwordMismatchMessageRestore_" + userId
  );

  // Remove the Bootstrap was-validated class to reset the validation state
  form.classList.remove("was-validated");

  // Clear previous error messages
  mismatchMessage.style.display = "none";

  // Add the Bootstrap validation class to trigger the styling and feedback
  form.classList.add("was-validated");

  // Perform custom validation
  if (newPassword.value.length < 4) {
    // If the new password is less than 4 characters, show error message, mark the new password field as invalid, and focus on the new password field
    mismatchMessage.style.display = "block";
    newPassword.classList.remove("is-valid");
    newPassword.classList.add("is-invalid");
    newPassword.focus();
    return false; // Prevent the form from being submitted
  } else {
    // If the new password is valid, remove the is-invalid class and add the is-valid class to the new password field
    newPassword.classList.remove("is-invalid");
    newPassword.classList.add("is-valid");
  }

  if (newPassword.value !== confirmPassword.value) {
    // If passwords don't match, show error message, mark the confirm password field as invalid, and focus on the new password field
    mismatchMessage.style.display = "block";
    confirmPassword.classList.remove("is-valid");
    confirmPassword.classList.add("is-invalid");
    newPassword.focus();
    return false; // Prevent the form from being submitted
  } else {
    // If passwords match, remove the is-invalid class and add the is-valid class to the confirm password field
    confirmPassword.classList.remove("is-invalid");
    confirmPassword.classList.add("is-valid");
  }

  return form.checkValidity(); // Allow the form to be submitted if it's valid
}

function confirmDeleteUserType(button) {
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
      Swal.fire("¡Borrado!", "El  tipo de usuario ha sido borrado.", "success");
    }
  });
}

function validateEditUserForm(userId) {
  // Obtén el formulario y los campos
  var form = document.getElementById("editUserForm_" + userId);
  var editNameField = document.getElementById("editName_" + userId);
  var editLastNameField = document.getElementById("editLastName_" + userId);
  var editEmailField = document.getElementById("editEmail_" + userId);
  var editTypeUserField = document.getElementById("editTypeUser_" + userId);

  // Limpiar mensajes de error anteriores
  editNameField.classList.remove("is-invalid");
  editLastNameField.classList.remove("is-invalid");
  editEmailField.classList.remove("is-invalid");
  editTypeUserField.classList.remove("is-invalid");

  // Realizar validación personalizada
  if (editNameField.value.length < 2) {
    editNameField.classList.add("is-invalid");
    return false;
  }

  if (editLastNameField.value.length < 2) {
    editLastNameField.classList.add("is-invalid");
    return false;
  }

  if (!isValidEmail(editEmailField.value)) {
    // Agregar validación para el formato de correo electrónico
    editEmailField.classList.add("is-invalid");
    return false;
  }

  if (editTypeUserField.value === "") {
    // Agregar validación para asegurarse de que se haya seleccionado un tipo de usuario
    editTypeUserField.classList.add("is-invalid");
    return false;
  }

  // Puedes agregar más validaciones personalizadas según sea necesario

  // Si todos los campos son válidos, permitir enviar el formulario
  return form.checkValidity();
}

function validateAddTypeForm() {
  var form = document.getElementById("newUserType");
  var typename = document.getElementById("typename");

  // Remove the Bootstrap was-validated class to reset the validation state
  form.classList.remove("was-validated");

  // Limpiar mensajes de error anteriores
  typename.classList.remove("is-invalid");

  // Agregar la clase Bootstrap de validación para activar el estilo y la retroalimentación
  form.classList.add("was-validated");

  // Realizar validación personalizada
  if (typename.value.length < 4) {
    // Si el nombre tiene menos de 4 caracteres, mostrar un mensaje de error y marcar el campo como inválido
    typename.classList.add("is-invalid");
    return false; // Evitar que se envíe el formulario
  }

  // Puedes agregar más validaciones personalizadas según sea necesario

  // Si todos los campos son válidos, permitir enviar el formulario
  return form.checkValidity();
}

function validateEditTypeForm(typeId) {
  var form = document.getElementById("editUserForm_" + typeId);
  var typeName = document.getElementById("editTypeName_" + typeId);

  // Limpiar mensajes de error anteriores
  typeName.classList.remove("is-invalid");

  // Realizar validación personalizada
  if (typeName.value.length < 4) {
    // Si el nombre tiene menos de 4 caracteres, mostrar un mensaje de error y marcar el campo como inválido
    typeName.classList.add("is-invalid");
    return false; // Evitar que se envíe el formulario
  }

  return form.checkValidity();
}
