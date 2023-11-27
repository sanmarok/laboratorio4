function isValidEmail(email) {
  // Utiliza una expresión regular simple para verificar el formato del correo electrónico
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function validateAddClientForm() {
  var form = document.getElementById("newClientForm");
  var name = document.getElementById("name");
  var lastName = document.getElementById("last_name");
  var email = document.getElementById("email");
  var maritalStatus = document.getElementById("marital_status");
  var dni = document.getElementById("dni");
  var birthDate = document.getElementById("birth_date");

  // Remove the Bootstrap was-validated class to reset the validation state
  form.classList.remove("was-validated");

  // Add the Bootstrap validation class to trigger the styling and feedback
  form.classList.add("was-validated");

  // Perform custom validation

  // Check name and last name length
  if (name.value.length < 2 || lastName.value.length < 2) {
    return false;
  }

  // Check email format using the isValidEmail function
  if (!isValidEmail(email.value)) {
    email.classList.add("is-invalid");
    return false;
  }

  // Check DNI format using the isValidDNI function
  if (!isValidDNI(dni.value)) {
    dni.classList.add("is-invalid");
    return false;
  }

  // Check if a marital status is selected
  if (maritalStatus.value === "") {
    maritalStatus.classList.add("is-invalid");
    return false;
  }

  // Check if birth date is a valid date
  if (!isValidDate(birthDate.value)) {
    birthDate.classList.add("is-invalid");
    return false;
  }

  return form.checkValidity(); // Allow the form to be submitted if it's valid
}

// Custom validation function for DNI (Document Number)
function isValidDNI(dni) {
  // Expresión regular para permitir solo números y exactamente 8 dígitos
  var dniRegex = /^[0-9]{8}$/;
  return dniRegex.test(dni);
}

// Custom validation function for Date
function isValidDate(date) {
  // Expresión regular para validar el formato de fecha (YYYY-MM-DD)
  var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
  return dateRegex.test(date);
}

function validateDNI(input) {
  var dni = input.value.trim();
  var isValid = isValidDNI(dni);

  // Actualizar clases y mensaje de validación
  if (isValid) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
  }
}

function confirmDeleteClient(button) {
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
      // Obtén el formulario y activa el envío
      var form = button.nextElementSibling;
      form.addEventListener("submit", function () {
        // Asegúrate de agregar algún manejo después de enviar el formulario si es necesario
        Swal.fire("¡Borrado!", "El cliente ha sido borrado.", "success");
      });
      form.submit();
    }
  });
}

function validateEditClientForm(clientId) {
  var form = document.getElementById("editClientForm_" + clientId);
  var name = document.getElementById("editClientName_" + clientId);
  var lastName = document.getElementById("editClientLastName_" + clientId);
  var email = document.getElementById("editClientEmail_" + clientId);
  var maritalStatus = document.getElementById(
    "editClientMaritalStatus_" + clientId
  );
  var dni = document.getElementById("editClientDNI_" + clientId);
  var birthDate = document.getElementById("editClientBirthDate_" + clientId);

  // Remove the Bootstrap was-validated class to reset the validation state
  form.classList.remove("was-validated");

  // Add the Bootstrap validation class to trigger the styling and feedback
  form.classList.add("was-validated");

  // Perform custom validation

  // Check name and last name length
  if (name.value.length < 2 || lastName.value.length < 2) {
    return false;
  }

  // Check email format using the isValidEmail function
  if (!isValidEmail(email.value)) {
    email.classList.add("is-invalid");
    return false;
  }

  // Check DNI format using the isValidDNI function
  if (!isValidDNI(dni.value)) {
    dni.classList.add("is-invalid");
    return false;
  }

  // Check if a marital status is selected
  if (maritalStatus.value === "") {
    maritalStatus.classList.add("is-invalid");
    return false;
  }

  // Check if birth date is a valid date
  if (!isValidDate(birthDate.value)) {
    birthDate.classList.add("is-invalid");
    return false;
  }

  return form.checkValidity(); // Allow the form to be submitted if it's valid
}
