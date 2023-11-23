<?php

class ModelUsers
{
    static public function mdlShowUsers($table, $item, $value)
    {
        if ($item != null) {
            try {
                $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
                $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "ERROR: " . $e->getMessage();
            }
        } else {
            try {
                $stmt = Connection::connect()->prepare("SELECT u.*, t.name AS typeuser FROM $table AS u INNER JOIN usertypes AS t ON u.user_type_id = t.id");

                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "ERROR: " . $e->getMessage();
            }
        }
    }

    static public function mdlUpdateLogin($table, $item1, $value1, $item2, $value2)
    {
        try {
            $stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

            // Usar simplemente $value1 y $value2 aquí
            $stmt->bindParam(":" . $item1, $value1, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $value2, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return;
            } else {
                return print_r(Connection::connect()->errorInfo());
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlGetUserType()
    {
        try {
            $table = "usertypes";
            $stmt = Connection::connect()->prepare("SELECT DISTINCT id, name FROM $table");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    static public function mdlAddUser($name, $last_name, $email, $user_type_id, $password, $status = 'active')
    {
        try {
            $table = 'users';
            $password = crypt($password, 'mugen');
            // Sentencia SQL preparada
            $sql = "INSERT INTO $table (name, last_name, email, user_type_id, password, status) VALUES (:name, :last_name, :email, :user_type_id, :password, :status)";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetros
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":user_type_id", $user_type_id, PDO::PARAM_INT);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);  // No necesitas hacer crypt aquí, asumiré que ya está cifrada
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);

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

    static public function mdlDeleteUser($delete_user_id)
    {
        try {
            $table = 'users';

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
