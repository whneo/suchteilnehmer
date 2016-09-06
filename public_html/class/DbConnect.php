<?php

include './config.php';

class DbConnect {

    private static $conn;

    public static function getConnection() {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWD);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            } catch (Exception $exc) {
                echo '<b><span style="color:#F5022A" />Konnte mich nicht mit db verbinden</b>' . '<br/>';
                echo $exc->getTraceAsString();
                die();
            }
        }
        return self::$conn;
    }
}
