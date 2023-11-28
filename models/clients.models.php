<?php
class ModelClients
{
    static public function mdlGetClients()
    {
        try {
            $stmt = Connection::connect()->prepare("SELECT c.*, m.name AS marital_status_name FROM clients AS c
                                                    INNER JOIN maritalstatus AS m ON c.marital_status_id = m.id");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Aplicar formato de fechas
            foreach ($results as &$result) {
                if (isset($result['birth_date'])) {
                    $result['birth_date'] = date('d/m/Y', strtotime($result['birth_date']));
                }

                if (isset($result['creation_date'])) {
                    $result['creation_date'] = date('d/m/Y', strtotime($result['creation_date']));
                }
            }

            return $results;
        } catch (Exception $e) {
            return "ERROR: " . $e->getMessage();
        }
    }

    static public function mdlGetMaritalStatus()
    {
        try {
            $stmt = Connection::connect()->prepare("SELECT * FROM maritalstatus ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Aplicar formato de fechas
            foreach ($results as &$result) {

                if (isset($result['creation_date'])) {
                    $result['creation_date'] = date('d/m/Y', strtotime($result['creation_date']));
                }
            }

            return $results;
        } catch (Exception $e) {
            return "ERROR: " . $e->getMessage();
        }
    }

    static public function mdlAddClient($name, $last_name, $email, $marital_status, $dni, $birth_date)
    {
        try {
            $table = 'clients';

            // Sentencia SQL preparada
            $sql = "INSERT INTO $table (name, last_name, email, marital_status_id, dni, birth_date) VALUES (:name, :last_name, :email, :marital_status, :dni, :birth_date)";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetros
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
            $stmt->bindParam(":marital_status", $marital_status, PDO::PARAM_INT);
            $stmt->bindParam(":birth_date", $birth_date, PDO::PARAM_STR);


            // Ejecutar la consulta
            if ($stmt->execute()) {

                return "success";
            } else {

                return "error";
            }
        } catch (PDOException $e) {
            // Capturar error de duplicado para email o DNI
            if ($e->errorInfo[1] === 1062) {


                if (strpos($e->errorInfo[2], 'email')) {
                    return "duplicate_email";
                } elseif (strpos($e->errorInfo[2], 'dni')) {
                    return "duplicate_dni";
                }
            }

            return "ERROR: " . $e->getMessage();
        }
    }

    static public function mdlDeleteClient($delete_client_id)
    {
        try {
            $table = 'clients';

            // Sentencia SQL preparada
            $sql = "DELETE FROM $table WHERE id = :delete_user_id";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetro
            $stmt->bindParam(":delete_user_id", $delete_client_id, PDO::PARAM_INT);

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

    static public function mdlEditClient($client_id, $name, $last_name, $email, $marital_status, $dni, $birth_date,)
    {
        try {
            $table = 'clients';

            // Sentencia SQL preparada
            $sql = "UPDATE $table SET name = :name, last_name = :last_name, email = :email, marital_status_id = :marital_status, dni = :dni, birth_date = :birth_date WHERE id = :client_id";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetros
            $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
            $stmt->bindParam(":marital_status", $marital_status, PDO::PARAM_INT);
            $stmt->bindParam(":birth_date", $birth_date, PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Capturar error de duplicado para email o DNI
            if ($e->errorInfo[1] === 1062) {
                if (strpos($e->errorInfo[2], 'email')) {
                    return "duplicate_email";
                } elseif (strpos($e->errorInfo[2], 'dni')) {
                    return "duplicate_dni";
                }
            }
            return "ERROR: " . $e->getMessage();
        }
    }

    static public function mdlDeleteMaritalStatus($delete_user_type_id)
    {
        try {
            $table = 'maritalstatus';

            // Sentencia SQL preparada
            $sql = "DELETE FROM $table WHERE id = :delete_user_type_id";
            $stmt = Connection::connect()->prepare($sql);

            // Asignar parámetro
            $stmt->bindParam(":delete_user_type_id", $delete_user_type_id, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "success";
            } else {
                $errorCode = $stmt->errorInfo()[1];

                // Si es un error de clave foránea (FK violation), devuelve un código especial
                if ($errorCode == 1451) {
                    return "has_users";
                } else {
                    return "error";
                }
            }
        } catch (PDOException $e) {
            return "ERROR: " . $e->getMessage();
        }
    }



    static public function mdlAddMaritalStatus($typename)
    {
        try {
            $stmt = Connection::connect()->prepare("INSERT INTO maritalstatus (name) VALUES (:typename)");
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

    static public function mdlEditMaritalStatus($userTypeId, $editTypeName)
    {
        try {
            $stmt = Connection::connect()->prepare("UPDATE maritalstatus SET name = :name WHERE id = :id");

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
}
