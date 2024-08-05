<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Config {

    class DatabaseCall
    {

        // koneksi ke database menggunakan PDO
        private static ?\PDO $pdo = null;

        // function getConnection untuk selalu dipanggil jika ada kebutuhan dengan database
        public static function getDatabaseConnection(string $database_env = "testing")
        {
            if (self::$pdo === null) {
                // include kan file konfigurasi database
                require_once (__DIR__ . "/../../config/DatabaseConfig.php");
                // panggil function yang menghandle konfigurasi database
                $database_configuration = getDatabaseConfig();
                // buat PDO dengan parameter mysql: host=$host:$port;dbname=$database,$username, $password yang diambil dari konfigurasi database di atas
                // nilai ruang lingkup database default nya adalah pada saat kondisi testing aplikasi
                self::$pdo = new \PDO(
                    $database_configuration["database_env"][$database_env]["url"],
                    $database_configuration["database_env"][$database_env]["username"],
                    $database_configuration["database_env"][$database_env]["password"],
                );
            }
            return self::$pdo;
        }

        // beginTransaction
        public static function beginTransaction()
        {
            self::$pdo->beginTransaction();
        }

        // commitTransaction
        public static function commitTransaction()
        {
            self::$pdo->commit();
        }

        // rollBackTranscation
        public static function rollBackTransaction()
        {
            self::$pdo->rollBack();
        }
    }
}