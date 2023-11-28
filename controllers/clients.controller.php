<?php
class ControllerClients
{
    static public function ctrGetClients()
    {
        $response = ModelClients::mdlGetClients();
        return $response;
    }

    static public function ctrGetMaritalStatus()
    {
        $response = ModelClients::mdlGetMaritalStatus();
        return $response;
    }

    static public function ctrAddClient()
    {
        if (
            isset($_POST['name']) && isset($_POST['last_name']) && isset($_POST['email'])
            && isset($_POST['marital_status']) && isset($_POST['dni']) && isset($_POST['birth_date'])
        ) {
            if (
                empty($_POST['name']) || empty($_POST['last_name']) || empty($_POST['email'])
                || empty($_POST['marital_status']) || empty($_POST['dni']) || empty($_POST['birth_date'])
            ) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Todos los campos son necesarios",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de correo electrónico
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Formato de correo electrónico inválido",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de DNI
            if (!preg_match('/^[0-9]{8}$/', $_POST["dni"])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Formato de DNI inválido",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de nombre (al menos 2 caracteres y solo letras)
            if (!preg_match('/^[A-Za-z]{2,}$/', $_POST["name"])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "El nombre debe contener al menos 2 caracteres y solo letras",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de apellido (al menos 2 caracteres y solo letras)
            if (!preg_match('/^[A-Za-z]{2,}$/', $_POST["last_name"])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "El apellido debe contener al menos 2 caracteres y solo letras",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }


            $response = ModelClients::mdlAddClient(
                $_POST['name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['marital_status'],
                $_POST['dni'],
                $_POST['birth_date']
            );

            // Manejar casos específicos de error
            switch ($response) {
                case "success":
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Cliente agregado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => {window.location = "clients";});
                </script>';
                    return;
                    break;
                case "duplicate_email":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "El correo electrónico ya está registrado",
                            confirmButtonText: "Aceptar"
                        }).then(() => {window.location = "clients";});
                    </script>';
                    return;
                case "duplicate_dni":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "El DNI ya está registrado",
                            confirmButtonText: "Aceptar"
                        }).then(() => {window.location = "clients";});
                    </script>';
                    return;
                case "error":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error desconocido",
                            confirmButtonText: "Aceptar"
                        }).then(() => {window.location = "clients";});
                    </script>';
                    return;
            }
        } else {
            return;
        }
    }

    static public function ctrDeleteClient()
    {
        if (isset($_POST['delete_client_id'])) {
            // Validar que el ID no esté vacío
            if (empty($_POST['delete_client_id'])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "ID de cliente vacío",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "clients"; });
            </script>';
                return;
            }

            // Eliminar el cliente
            $response = ModelClients::mdlDeleteClient($_POST['delete_client_id']);

            if ($response == "success") {
                echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: "Cliente eliminado correctamente",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "clients"; });
            </script>';
                return;
            } elseif ($response == "error") {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Error al eliminar el cliente",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "clients"; });
            </script>';
                return;
            }
        } else {
            return;
        }
    }

    static public function ctrEditClient()
    {
        if (
            isset($_POST['editClientId']) && isset($_POST['editClientName']) && isset($_POST['editClientLastName'])
            && isset($_POST['editClientEmail']) && isset($_POST['editClientMaritalStatus']) && isset($_POST['editClientDNI'])
            && isset($_POST['editClientBirthDate'])
        ) {
            if (
                empty($_POST['editClientName']) || empty($_POST['editClientLastName']) || empty($_POST['editClientEmail'])
                || empty($_POST['editClientMaritalStatus']) || empty($_POST['editClientDNI']) || empty($_POST['editClientBirthDate'])
            ) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Todos los campos son necesarios",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de correo electrónico
            if (!filter_var($_POST["editClientEmail"], FILTER_VALIDATE_EMAIL)) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Formato de correo electrónico inválido",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de DNI
            if (!preg_match('/^[0-9]{8}$/', $_POST["editClientDNI"])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Formato de DNI inválido",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de nombre (al menos 2 caracteres y solo letras)
            if (!preg_match('/^[A-Za-z]{2,}$/', $_POST["editClientName"])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "El nombre debe contener al menos 2 caracteres y solo letras",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            // Validar formato de apellido (al menos 2 caracteres y solo letras)
            if (!preg_match('/^[A-Za-z]{2,}$/', $_POST["editClientLastName"])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "El apellido debe contener al menos 2 caracteres y solo letras",
                    confirmButtonText: "Aceptar"
                }).then(() => {window.location = "clients";});
            </script>';
                return;
            }

            $response = ModelClients::mdlEditClient(
                $_POST['editClientId'],
                $_POST['editClientName'],
                $_POST['editClientLastName'],
                $_POST['editClientEmail'],
                $_POST['editClientMaritalStatus'],
                $_POST['editClientDNI'],
                $_POST['editClientBirthDate']
            );

            // Manejar casos específicos de error
            switch ($response) {
                case "success":
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Cliente editado correctamente uwu",
                        confirmButtonText: "Aceptar"
                    }).then(() => {window.location = "clients";});
                </script>';
                    return;
                    break;
                case "duplicate_email":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "El correo electrónico ya está registrado",
                            confirmButtonText: "Aceptar"
                        }).then(() => {window.location = "clients";});
                    </script>';
                    return;
                case "duplicate_dni":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "El DNI ya está registrado",
                            confirmButtonText: "Aceptar"
                        }).then(() => {window.location = "clients";});
                    </script>';
                    return;
                case "error":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error desconocido",
                            confirmButtonText: "Aceptar"
                        }).then(() => {window.location = "clients";});
                    </script>';
                    return;
            }
        } else {
            return;
        }
    }

    public static function ctrDeleteMaritalStatus()
    {
        if (isset($_POST['delete_user_type_id'])) {
            $userTypeId = $_POST['delete_user_type_id'];

            $response = ModelClients::mdlDeleteMaritalStatus($userTypeId);

            switch ($response) {
                case "success":
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Tipo de usuario eliminado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "maritalstatus"; });
                </script>';
                    break;
                case "error":
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error al eliminar el tipo de usuario",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "maritalstatus"; });
                </script>';
                    break;
                case "has_users":
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "No se puede eliminar el tipo de usuario. Hay usuarios asociados.",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "maritalstatus"; });
                </script>';
                    break;
                default:
                    // Maneja otros posibles resultados aquí
                    break;
            }
        } else {
            return;
        }
    }


    static public function ctrAddMaritalStatus()
    {
        if (isset($_POST['typename'])) {
            // Validar que no esté vacío
            if (empty($_POST['typename'])) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "El nombre del tipo de usuario es obligatorio",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "maritalstatus"; });
                </script>';
                return;
            }
            $typename = $_POST['typename'];
            $response = ModelClients::mdlAddMaritalStatus($typename);
            if ($response == "success") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Tipo de usuario agregado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "maritalstatus"; });
                </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error desconocido al agregar el tipo de usuario",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "maritalstatus"; });
                </script>';
                return;
            }
        } else {
            return;
        }
    }

    static public function ctrEditMaritalStatus()
    {
        if (isset($_POST['editUserTypeId']) && isset($_POST['editTypeName'])) {
            $userTypeId = $_POST['editUserTypeId'];
            $editTypeName = $_POST['editTypeName'];
            $response = ModelClients::mdlEditMaritalStatus($userTypeId, $editTypeName);

            switch ($response) {
                case "success":
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: "Tipo de usuario editado correctamente",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "maritalstatus"; });
                    </script>';
                    break;
                case "error":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error al editar el tipo de usuario",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "maritalstatus"; });
                    </script>';
                    break;
                default:
                    // Maneja otros posibles resultados aquí
                    break;
            }
        } else {
            return;
        }
    }
}
