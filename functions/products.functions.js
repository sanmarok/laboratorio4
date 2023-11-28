function confirmChangeStatusProducts(button, userId, newStatus) {
  var confirmText = "";
  var successText = "";

  if (newStatus === "active") {
    confirmText = "¿Estás seguro de activar este producto?";
    successText = "Producto activado correctamente.";
  } else if (newStatus === "inactive") {
    confirmText = "¿Estás seguro de desactivar este producto?";
    successText = "Producto desactivado correctamente.";
  }

  Swal.fire({
    title: confirmText,
    text: "¡No podrás revertir esto!",
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

      // Move the success message inside the isConfirmed block
      Swal.fire("¡Éxito!", successText, "success");
    }
  });
}

function validateAddProductForm() {
  var form = document.getElementById("newProductForm");
  var imageInput = document.getElementById("imagePath");

  if (form.checkValidity() === false) {
    event.preventDefault();
    event.stopPropagation();
  }

  // Validar el tamaño del archivo de imagen
  var maxSize = 1 * 1024 * 1024; // 1 MB en bytes
  if (imageInput.files.length > 0 && imageInput.files[0].size > maxSize) {
    alert("El archivo de imagen no debe pesar más de 1 MB.");
    return false;
  }

  // Validar el tipo de archivo de imagen
  var allowedTypes = ["image/jpeg", "image/png"];
  if (
    imageInput.files.length > 0 &&
    allowedTypes.indexOf(imageInput.files[0].type) === -1
  ) {
    alert("Por favor, seleccione una imagen válida (JPEG, PNG, etc.).");
    return false;
  }

  form.classList.add("was-validated");
}
