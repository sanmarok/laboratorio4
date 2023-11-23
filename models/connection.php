<?php
class Connection
{
    const HOST = "localhost";
    const DBNAME = "laboratorio4";
    const USER = "root";
    const PASSWORD = "";

    static public function connect()
    {
        try {
            $link = new PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME,
                self::USER,
                self::PASSWORD
            );
            $link->exec("set names utf8");
            return $link;
        } catch (PDOException $e) {
            die("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }
}
