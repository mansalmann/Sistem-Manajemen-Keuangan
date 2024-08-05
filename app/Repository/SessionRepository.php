<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Repository {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\Session;

    class SessionRepository
    {

        // session management untuk mengetahui data user saat ini yang sedang login
        private \PDO $connection;

        public function __construct(\PDO $pdo)
        {
            $this->connection = $pdo;
        }

        // untuk menyimpan data session ke database
        public function save(Session $session): Session
        {
            $statement = $this->connection->prepare("INSERT INTO sessions (id, user_id) VALUES (?,?)");
            $statement->execute([$session->id, $session->userId]);
            return $session;
        }

        // untuk mencari data session berdasarkan id user yang telah tersimpan di database
        public function findById(?string $id): ?Session
        {
            $statement = $this->connection->prepare("SELECT id,user_id FROM sessions WHERE id = ?");
            $statement->execute([$id]);

            try {
                if ($data = $statement->fetch()) {
                    $session = new Session();
                    // mengisi data hasil query ke property Session (representasi tabel session)
                    $session->id = $data["id"];
                    $session->userId = $data["user_id"];
                    return $session;
                } else {
                    return null;
                }
            } finally {
                $statement->closeCursor();
            }
        }

        // untuk menghapus seluruh data session berdasarkan id di database (proses logout)
        public function deleteById(string $id): void
        {
            $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
            $statement->execute([$id]);
        }

        // untuk menghapus seluruh data session di database (keperluan testing)
        public function deleteAll(): void
        {
            $this->connection->exec("DELETE FROM sessions");
        }

    }
}