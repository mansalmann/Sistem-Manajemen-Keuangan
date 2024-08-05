<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Repository {

    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;

    class UserRepository
    {

        // layer repository itu yang berhubungan dengan database
        // maka membutuhkan PDO untuk bisa terhubung ke database
        private \PDO $connection;

        // constructor
        // ketika memanggil repository pastikan bahwa sistem telah terhubung ke database
        public function __construct(\PDO $pdo)
        {
            $this->connection = $pdo;
        }

        // registrasi data user ke database
        public function save(User $user): User
        {

            $statement = $this->connection->prepare("INSERT INTO users(id,name,password) VALUES(?,?,?)");

            $statement->execute([
                $user->id,
                $user->name,
                $user->password
            ]);

            return $user;
        }

        // cari user berdasarkan id
        public function findById(string $id): ?User
        {
            $statement = $this->connection->prepare("SELECT id,name,password FROM users WHERE id = ?");
            $statement->execute([$id]);

            try {
                if ($data = $statement->fetch()) {
                    $user = new User();
                    // mengisi data hasil query ke property User (representasi tabel user)
                    $user->id = $data["id"];
                    $user->name = $data["name"];
                    $user->password = $data["password"];

                    return $user;
                } else {
                    return null;
                }
            } finally {
                // close cursor untuk mengurangi penggunaan memori di server
                $statement->closeCursor();
            }
        }

        // untuk menghapus semua data user di database (keperluan testing)
        public function deleteAll(): void
        {
            $this->connection->exec("DELETE FROM users");
        }

        // untuk memperbarui profil pengguna
        public function update(User $user): User
        {
            $statement = $this->connection->prepare("UPDATE users SET name = ? , password = ? WHERE id = ?");
            $statement->execute([$user->name, $user->password, $user->id]);

            return $user;
        }
    }
}