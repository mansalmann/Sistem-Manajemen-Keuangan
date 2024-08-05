<?php

// isinya adalah function untuk konfigurasi database yang ingin digunakan
// terdapat dua ruang lingkup penggunaan database
// lingkup test dan lingkup production

function getDatabaseConfig(): array
{
    return [
        "database_env" => [
            "testing" => [
                "url" => "mysql:host=localhost:3306;dbname=manajemen_keuangan_test",
                "username" => "root",
                "password" => "",
            ],
            "production" => [
                "url" => "mysql:host=localhost:3306;dbname=manajemen_keuangan",
                "username" => "root",
                "password" => "",
            ]
        ]

    ];
}