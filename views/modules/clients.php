<?php
if (!isset($_SESSION['user_type_id'])) {
    // Si la sesión no está establecida, redirige a la página de autenticación
    echo '<script>window.location="authentication";</script>';
} else {
    // Si la sesión está establecida, verifica el tipo de usuario
    if ($_SESSION['user_type_id'] != 1) {
        echo '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Acceso no permitido",
                    text: "No tienes permisos para acceder a esta página.",
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: "white-text",
                        title: "white-text"
                    }
                });
                setTimeout(function(){
                    window.location.href = "index.php";
                }, 3000);
              </script>';
    }
}
