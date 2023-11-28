<?php

class ControllerProducts
{
    static public function ctrGetCategorys()
    {
        return ModelProducts::mdlGetCategorys();
    }

    static public function ctrAddCategorys()
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
                    }).then(() => { window.location = "category"; });
                </script>';
                return;
            }
            $typename = $_POST['typename'];
            $response = ModelProducts::mdlAddCategory($typename);
            if ($response == "success") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Tipo de usuario agregado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "category"; });
                </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error desconocido al agregar el tipo de usuario",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "category"; });
                </script>';
                return;
            }
        } else {
            return;
        }
    }

    public static function ctrDeleteCategorys()
    {
        if (isset($_POST['delete_user_type_id'])) {
            $userTypeId = $_POST['delete_user_type_id'];

            $response = ModelProducts::mdlDeleteCategory($userTypeId);

            switch ($response) {
                case "success":
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Tipo de usuario eliminado correctamente",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "category"; });
                </script>';
                    break;
                case "error":
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error al eliminar el tipo de usuario",
                        confirmButtonText: "Aceptar"
                    }).then(() => { window.location = "category"; });
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

    static public function ctrEditCategory()
    {
        if (isset($_POST['editUserTypeId']) && isset($_POST['editTypeName'])) {
            $userTypeId = $_POST['editUserTypeId'];
            $editTypeName = $_POST['editTypeName'];
            $response = ModelProducts::mdlEditCategory($userTypeId, $editTypeName);

            switch ($response) {
                case "success":
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: "Tipo de usuario editado correctamente",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "category"; });
                    </script>';
                    break;
                case "error":
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error al editar el tipo de usuario",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "category"; });
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

    static public function ctrGetProducts()
    {
        return ModelProducts::mdlGetProducts();
    }

    static public function ctrAddProduct()
    {

        function generar_url($texto)
        {
            // Implementa la lógica necesaria para generar la URL a partir del texto
            // Puedes utilizar funciones de manejo de cadenas, eliminar espacios, convertir a minúsculas, etc.
            // Aquí tienes un ejemplo básico:
            $url = strtolower(str_replace(" ", "-", $texto));
            return $url;
        }

        if (isset($_POST["productName"])) {
            // Verificar que los campos requeridos no estén vacíos
            if (empty($_POST["productName"]) || empty($_POST["category"]) || empty($_POST["price"]) || empty($_POST["stock"]) || empty($_POST["status"])) {
                echo '<script>
            Swal.fire({
                icon: "error",
                title: "¡Error!",
                text: "Todos los campos son necesarios",
                confirmButtonText: "Aceptar"
            }).then(() => { window.location = "products"; });
        </script>';
                return;
            }

            // Obtener los datos del formulario
            $productName = $_POST["productName"];
            $category = $_POST["category"];
            $price = $_POST["price"];
            $stock = $_POST["stock"];
            $status = $_POST["status"];

            // Verificar si se ha subido una imagen
            if (isset($_FILES["imagePath"]["tmp_name"])) {
                // Obtener información sobre la imagen
                list($ancho, $alto) = getimagesize($_FILES["imagePath"]["tmp_name"]);
                $nuevoAncho = $ancho;
                $nuevoAlto = $alto;
                $directorio = "views/images/products/";


                // Crear el directorio para guardar la imagen
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0755, true); // El tercer parámetro true crea directorios padres si no existen
                }

                // De acuerdo al tipo de imagen, aplicar las funciones por defecto de PHP
                if ($_FILES["imagePath"]["type"] == "image/jpeg") {
                    $nombre = generar_url($productName);
                    $imagen = $directorio . $nombre . ".jpg";
                    $origen = imagecreatefromjpeg($_FILES["imagePath"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $imagen);
                } elseif ($_FILES["imagePath"]["type"] == "image/png") {
                    $nombre = generar_url($productName);
                    $imagen = $directorio . $nombre . ".png";

                    // Añade este bloque para verificar el tipo de archivo
                    $imageData = getimagesize($_FILES["imagePath"]["tmp_name"]);
                    if ($imageData['mime'] !== 'image/png') {
                        echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "El archivo no es una imagen PNG válida",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "products"; });
                    </script>';
                        return;
                    }

                    $origen = imagecreatefrompng($_FILES["imagePath"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $imagen);
                } else {
                    echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "Tipo de archivo no aceptado",
                    confirmButtonText: "Aceptar"
                }).then(() => { window.location = "products"; });
            </script>';
                    return;
                }

                // Llamada a la función para agregar el producto a la base de datos
                $response = ModelProducts::mdlAddProduct($productName, $category, $price, $stock, $status, $imagen);


                switch ($response) {
                    case "success":
                        echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: "Producto agregado correctamente",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "products"; });
                    </script>';
                        break;
                    case "error":
                        echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error agregar producto",
                            confirmButtonText: "Aceptar"
                        }).then(() => { window.location = "products"; });
                    </script>';
                        break;
                    default:
                        // Maneja otros posibles resultados aquí
                        break;
                }
            } else {
                echo "La imagen es obligatoria.";
                // Puedes redirigir al usuario o realizar alguna acción adicional aquí
            }
        } else {
            return;
        }
    }

    static public function ctrChangeProductStatus()
    {

        if (isset($_POST['change_status_user_id']) && isset($_POST['new_status'])) {

            $response = ModelProducts::mdlChangeProductStatus($_POST['change_status_user_id'], $_POST['new_status']);

            if ($response == "success") {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: "Estado del usuario cambiado correctamente",
                            confirmButtonText: "Aceptar"
                        }).then(() =>{window.location = "products";});
                    </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Error al cambiar el estado del usuario",
                            confirmButtonText: "Aceptar"
                        }).then(() =>{window.location = "products";});
                    </script>';
                return;
            }
        } else {
            return;
        }
    }

    static public function ctrDeleteProduct()
    {
        if (isset($_POST['delete_user_id'])) {

            $response = ModelProducts::mdlDeleteProduct($_POST['delete_user_id']);

            if ($response == "success") {
                echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: "Usuario eliminado correctamente",
                                confirmButtonText: "Aceptar"
                            }).then(() =>{window.location = "products";});
                        </script>';
                return;
            } else if ($response == "error") {
                echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "¡Error!",
                                text: "Error al eliminar el usuario",
                                confirmButtonText: "Aceptar"
                            }).then(() =>{window.location = "products";});
                        </script>';
                return;
            }
        } else {
            return;
        }
    }
}
