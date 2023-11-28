<?php
class ModelProducts
{
    static public function mdlGetCategorys()
    {
        try {
            $table = "category";
            $stmt = Connection::connect()->prepare("SELECT DISTINCT id, name FROM $table");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlAddCategory($typename)
    {
        try {
            $stmt = Connection::connect()->prepare("INSERT INTO category (name) VALUES (:typename)");
            $stmt->bindParam(":typename", $typename, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error";
        }
    }

    static public function mdlDeleteCategory($delete_user_type_id)
    {
        try {
            $table = 'category';

            // Sentencia SQL preparada
            $sql = "DELETE FROM $table WHERE id = :delete_user_type_id";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetro
            $stmt->bindParam(":delete_user_type_id", $delete_user_type_id, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            $errorCode = $stmt->errorInfo()[1];

            // Si es un error de clave foránea (FK violation), devuelve un código especial
            if ($errorCode == 1451) {
                return "has_users";
            } else {
                return "error";
            }
        }
    }

    static public function mdlEditCategory($userTypeId, $editTypeName)
    {
        try {
            $stmt = Connection::connect()->prepare("UPDATE category SET name = :name WHERE id = :id");

            $stmt->bindParam(":id", $userTypeId, PDO::PARAM_INT);
            $stmt->bindParam(":name", $editTypeName, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error";
        }
    }

    static public function mdlGetProducts()
    {
        try {
            $tableProducts = "products";
            $tableCategory = "category";

            $stmt = Connection::connect()->prepare("
                SELECT p.*, c.name AS category_name
                FROM $tableProducts p
                INNER JOIN $tableCategory c ON p.category_id = c.id
            ");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlAddProduct($productName, $category, $price, $stock, $status, $imagePath)
    {
        try {
            $table = 'products';

            // Sentencia SQL preparada
            $sql = "INSERT INTO $table (name, category_id, price, stock, status, image_path) VALUES (:product_name, :category, :price, :stock, :status, :image_path)";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetros
            $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
            $stmt->bindParam(":category", $category, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->bindParam(":image_path", $imagePath, PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error";
        }
    }

    static public function mdlChangeProductStatus($change_status_product_id, $new_status)
    {

        try {
            $table = 'products';

            // Sentencia SQL preparada
            $sql = "UPDATE $table SET status = :new_status WHERE id = :change_status_product_id";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetros
            $stmt->bindParam(":new_status", $new_status, PDO::PARAM_STR);
            $stmt->bindParam(":change_status_product_id", $change_status_product_id, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error";
        }
    }

    static public function mdlDeleteProduct($delete_user_id)
    {
        try {
            $table = 'products';

            // Sentencia SQL preparada
            $sql = "DELETE FROM $table WHERE id = :delete_user_id";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetro
            $stmt->bindParam(":delete_user_id", $delete_user_id, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "ERROR: " . $e->getMessage();
        }
    }
}
