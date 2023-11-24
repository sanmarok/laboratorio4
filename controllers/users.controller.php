<?php

use function PHPSTORM_META\type;

class ControllerUsers
{
    static public function ctrLogin()
    {
        if (isset($_POST['loginEmail'])) {
            $url = ControllerTemplate::url();
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][azA-Z0-9_]+)*[.][a-zAZ]{2,4}$/', $_POST["loginEmail"],)) {
                $crypPassword = crypt($_POST['loginPassword'], 'mugen');
            }
            $table = 'users';
            $item = 'email';
            $value = $_POST['loginEmail'];

            $response = ModelUsers::mdlShowUsers($table, $item, $value);

            if (is_array($response) && ($response['email'] == $_POST['loginEmail'] && $response['password'] == $crypPassword)) {
                if ($response['status'] == 'active') {
                    $_SESSION['user_type_id'] = $response['user_type_id'];
                    $_SESSION['name'] = $response['name'];
                    $_SESSION['last_name'] = $response['last_name'];


                    date_default_timezone_set('America/Argentina/Buenos_Aires');

                    $item1  = "last_login_date";
                    $value1 = date('Y-m-d H:i:s');

                    $item2  = "id";
                    $value2 = $response["id"];

                    $lastLogin = ModelUsers::mdlUpdateLogin($table, $item1, $value1, $item2, $value2);

                    echo '<script>
                        window.location.href = "users";
                        </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "El usuario está inactivo. No se puede iniciar sesión",
                    });
                </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "No se pudo iniciar sesión",
                });
            </script>';
            }
        }
    }

    static public function ctrLogout()
    {
        if (isset($_SESSION['user_type_id'])) {
            session_destroy();
            echo '<script>
            window.location.reload();
            </script>';
        }
    }

    static public function ctrGetUSers($item, $value)
    {
        $table = 'users';
        $response = ModelUsers::mdlShowUsers($table, $item, $value);
        return $response;
    }

    static public function ctrGetUserTypes()
    {
        return ModelUsers::mdlGetUserType();
    }

    static public function ctrAddUser()
    {
        if (isset($_POST['name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['typeuser']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            // Validar que no estén vacíos
            if (empty($_POST['name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['typeuser']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Todos los campos son necesarios",
                        confirmButtonText: "Aceptar"
                    }).then(() =>{window.location = "users";});
                </script>';
                return;
            }

            // Validar formato de correo electrónico
            if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][azA-Z0-9_]+)*[.][a-zAZ]{2,4}$/', $_POST["email"])) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Formato de correo electrónico inválido",
                        confirmButtonText: "Aceptar"
                    }).then(() =>{window.location = "users";});
                </script>';
                return;
            }

            // Validar que las contraseñas coincidan
            if ($_POST['password'] !== $_POST['confirm_password']) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Las contraseñas no coinciden",
                        confirmButtonText: "Aceptar"
                    }).then(() =>{window.location = "users";});
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
                }).then(() =>{window.location = "users";});
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
                }).then(() =>{window.location = "users";});
            </script>';
                return;
            }

            //Validar existencia de email
            $table = 'users';
            $item = 'email';
            $value = $_POST["email"];
            $emailCheck = ModelUsers::mdlShowUsers($table, $item, $value);
            if ($emailCheck == true) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "El correo electrónico ya está registrado",
                        confirmButtonText: "Aceptar"
                    }).then(() =>{window.location = "users";});
                </script>';
                return;
            }

            $response = ModelUsers::mdlAddUser($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['typeuser'], $_POST['password']);



            if ($response == "success") {
                echo '<script>

                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: "Usuario agregado correctamente",
                    confirmButtonText: "Aceptar"

                }).then(() =>{window.location = "users";});
            </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Error desconocido",
                    confirmButtonText: "Aceptar"
                }).then(() =>{window.location = "users";});
            </script>';
                return;
            }
        } else {
            return;
        }
    }

    static public function ctrDeleteUser()
    {
        if (isset($_POST['delete_user_id'])) {
            $verifyUser = ModelUsers::mdlShowUsers('users', 'id', $_POST['delete_user_id']);

            // Verificar si se encontró un usuario con el ID especificado
            if ($verifyUser && is_array($verifyUser)) {
                if ($verifyUser['id'] != 1) {
                    $response = ModelUsers::mdlDeleteUser($_POST['delete_user_id']);

                    if ($response == "success") {
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: "Usuario eliminado correctamente",
                                confirmButtonText: "Aceptar"
                            }).then(() =>{window.location = "users";});
                        </script>';
                        return;
                    } else if ($response == "error") {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "¡Error!",
                                text: "Error al eliminar el usuario",
                                confirmButtonText: "Aceptar"
                            }).then(() =>{window.location = "users";});
                        </script>';
                        return;
                    }
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Este usuario no puede eliminarse",
                            confirmButtonText: "Aceptar"
                        }).then(() =>{window.location = "users";});
                    </script>';
                    return;
                }
            } else {
                // No se encontró un usuario con el ID especificado
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "No se encontró el usuario con el ID especificado",
                        confirmButtonText: "Aceptar"
                    }).then(() =>{window.location = "users";});
                </script>';
                return;
            }
        } else {
            return;
        }
    }
}
