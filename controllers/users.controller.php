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
                    $_SESSION['id'] = $response['id'];

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

    static public function ctrChangeUserStatus()
    {
        if (isset($_POST['change_status_user_id']) && isset($_POST['new_status'])) {
            $verifyUser = ModelUsers::mdlShowUsers('users', 'id', $_POST['change_status_user_id']);

            // Verificar si se encontró un usuario con el ID especificado
            if ($verifyUser && is_array($verifyUser)) {
                if ($verifyUser['id'] != 1) {
                    $response = ModelUsers::mdlChangeUserStatus($_POST['change_status_user_id'], $_POST['new_status']);

                    if ($response == "success") {
                        echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: "Estado del usuario cambiado correctamente",
                            confirmButtonText: "Aceptar"
                        }).then(() =>{window.location = "users";});
                    </script>';
                        return;
                    } else if ($response == "error") {
                        echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error al cambiar el estado del usuario",
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
                        text: "El estado de este usuario no puede cambiarse",
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

    static public function ctrRestorePassword()
    {
        if (isset($_POST['userIdRestore']) && isset($_POST['newPasswordRestore']) && isset($_POST['confirmPasswordRestore'])) {
            // Validar que no estén vacíos
            if (empty($_POST['userIdRestore']) || empty($_POST['newPasswordRestore']) || empty($_POST['confirmPasswordRestore'])) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Todos los campos son necesarios",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "users"; });
                </script>';
                return;
            }

            // Validar que las contraseñas coincidan
            if ($_POST['newPasswordRestore'] !== $_POST['confirmPasswordRestore']) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Las contraseñas no coinciden",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "users"; });
                </script>';
                return;
            }

            // Agrega aquí cualquier validación adicional que necesites

            // Lógica para cambiar la contraseña
            $userId = $_POST['userIdRestore'];
            $newPassword = $_POST['newPasswordRestore'];
            $response = ModelUsers::mdlChangePassword($userId, $newPassword);

            if ($response == "success") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Contraseña restaurada correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "users"; });
                </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error desconocido",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "users"; });
                </script>';
                return;
            }
        } else {
            return;
        }
    }

    public static function ctrDeleteUserType()
    {
        if (isset($_POST['delete_user_type_id'])) {
            $userTypeId = $_POST['delete_user_type_id'];

            // Realiza las validaciones necesarias antes de eliminar el tipo de usuario

            $response = ModelUsers::mdlDeleteUserType($userTypeId);

            switch ($response) {
                case "success":
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Tipo de usuario eliminado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "userstypes"; });
                </script>';
                    break;
                case "error":
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error al eliminar el tipo de usuario",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "userstypes"; });
                </script>';
                    break;
                case "error_associated_users":
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "No se puede eliminar el tipo de usuario. Hay usuarios asociados.",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "userstypes"; });
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

    static public function ctrEditUser()
    {
        if (isset($_POST['editUserId']) && isset($_POST['editName']) && isset($_POST['editLastName']) && isset($_POST['editEmail']) && isset($_POST['editTypeUser'])) {
            $userId = $_POST['editUserId'];
            $editName = $_POST['editName'];
            $editLastName = $_POST['editLastName'];
            $editEmail = $_POST['editEmail'];
            $editTypeUser = $_POST['editTypeUser'];

            if ($userId == 1 && $editTypeUser != 1) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "No se puede editar el tipo de este usuario",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "users"; });
            </script>';
                return;
            }

            // Realizar la actualización en el modelo (ModelUsers)
            $response = ModelUsers::mdlEditUser($userId, $editName, $editLastName, $editEmail, $editTypeUser);

            if ($response == "success") {
                echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: "Usuario editado correctamente",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "users"; });
            </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Error al editar el usuario",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "users"; });
            </script>';
                return;
            }
        } else {
            return;
        }
    }

    static public function ctrAddUserType()
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
                    }).then(() => { window.location = "userstypes"; });
                </script>';
                return;
            }
            $typename = $_POST['typename'];
            $response = ModelUsers::mdlAddUserType($typename);
            if ($response == "success") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Tipo de usuario agregado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "userstypes"; });
                </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error desconocido al agregar el tipo de usuario",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "userstypes"; });
                </script>';
                return;
            }
        } else {
            return;
        }
    }

    static public function ctrEditUserType()
    {
        if (isset($_POST['editUserTypeId']) && isset($_POST['editTypeName'])) {
            $userTypeId = $_POST['editUserTypeId'];
            $editTypeName = $_POST['editTypeName'];
            $response = ModelUsers::mdlEditUserType($userTypeId, $editTypeName);

            switch ($response) {
                case "success":
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: "Tipo de usuario editado correctamente",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "userstypes"; });
                    </script>';
                    break;
                case "error":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error al editar el tipo de usuario",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "userstypes"; });
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
