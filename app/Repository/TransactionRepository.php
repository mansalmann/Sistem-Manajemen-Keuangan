<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Repository {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\Transaction;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionActivityRequest;

    class TransactionRepository
    {

        private \PDO $connection;

        public function __construct(\PDO $pdo)
        {
            $this->connection = $pdo;
        }

        // untuk menyimpan data transaksi ke database
        public function save(Transaction $transaction): Transaction
        {

            $statement = $this->connection->prepare("INSERT INTO informasi_keuangan(jenis_kategori, sub_kategori, jumlah, deskripsi) VALUES(?,?,?,?)");

            $statement->execute([$transaction->jenis_kategori, $transaction->sub_kategori, $transaction->jumlah, $transaction->deskripsi]);

            return $transaction;
        }

        public function showAllCategories(string $categoryType): array
        {
            $results = $this->connection->prepare("SELECT sub_kategori FROM kategori WHERE jenis_kategori = ?");
            $results->execute([$categoryType]);

            $subCategories = [];
            while ($data = $results->fetch()) {
                $subCategories[] = $data["sub_kategori"];
            }
            return $subCategories;
        }

        public function showAll(): array
        {
            $result = $this->connection->query("SELECT jenis_kategori, sub_kategori, jumlah, deskripsi, waktu_transaksi FROM informasi_keuangan");

            $total = $this->connection->query(
                "SELECT
            COALESCE(
                (SELECT SUM(jumlah) FROM informasi_keuangan WHERE jenis_kategori = 'Pemasukan'), 0) -
            COALESCE(
                (SELECT SUM(jumlah) FROM informasi_keuangan WHERE jenis_kategori = 'Pengeluaran'), 0) 
            AS 'sisa_saldo';"
            );

            // cari nilai pemasukan dan pengeluaran terakhir atau terbaru
            $latestValue = $this->connection->query(
                "SELECT
            COALESCE(
                (SELECT jumlah FROM informasi_keuangan WHERE jenis_kategori = 'Pemasukan' ORDER BY waktu_transaksi DESC LIMIT 1), 0
                ) AS 'Pemasukan',
            COALESCE(
                (SELECT jumlah FROM informasi_keuangan WHERE jenis_kategori = 'Pengeluaran' ORDER BY waktu_transaksi DESC LIMIT 1), 0
                ) AS 'Pengeluaran';"
            );

            $subCategories = [];
            while ($data = $result->fetch()) {
                $dataArray = [];
                $dataArray[] = $data["jenis_kategori"];
                $dataArray[] = $data["sub_kategori"];
                $dataArray[] = $data["jumlah"];
                $dataArray[] = $data["deskripsi"];
                $dataArray[] = $data["waktu_transaksi"];

                $subCategories[] = $dataArray;
            }

            if ($data = $total->fetch()) {
                $subCategories[] = $data["sisa_saldo"];
            }

            while ($data = $latestValue->fetch()) {
                $dataArray = [];
                $dataArray[] = $data["Pemasukan"];
                $dataArray[] = $data["Pengeluaran"];

                $subCategories[] = $dataArray;
            }

            return $subCategories;
        }

        public function deleteByDateTime(string $datetime)
        {
            $result = $this->connection->prepare("DELETE FROM informasi_keuangan WHERE waktu_transaksi = ?");

            $result->execute([$datetime]);
        }

        public function updateTransactionData(Transaction $update)
        {

            $statement = $this->connection->prepare("UPDATE informasi_keuangan SET jenis_kategori = ?, sub_kategori = ?, jumlah = ?, deskripsi = ? WHERE waktu_transaksi = ?");

            $statement->execute([$update->jenis_kategori, $update->sub_kategori, $update->jumlah, $update->deskripsi, $update->waktu_transaksi]);
        }

        public function addTransactionActivity(TransactionActivityRequest $request)
        {
            $result = $this->connection->prepare("INSERT INTO kategori (jenis_kategori,sub_kategori) VALUES(?,?)");

            $result->execute([$request->jenis_kategori, $request->sub_kategori]);
        }
    }


}