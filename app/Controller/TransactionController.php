<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Controller {
    use ProgrammerSalman\SistemManajemenKeuangan\App\View;
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Exception\ValidationException;
    use ProgrammerSalman\SistemManajemenKeuangan\Helper\Helper;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionActivityRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionDeleteRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\TransactionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\TransactionService;

    class TransactionController
    {

        private TransactionService $transactionService;

        public function __construct()
        {
            $repository = new TransactionRepository(DatabaseCall::getDatabaseConnection());
            $this->transactionService = new TransactionService($repository);
        }

        public function TransactionPage()
        {
            $user_real_name = new Helper();
            View::renderPage("Feature/transaction", [
                "title" => "Tambah Data Transaksi",
                "name" => ucfirst($user_real_name->showUserName()->name)
            ]);
        }

        public function postTransaction()
        {
            $request = new TransactionRequest();
            $request->jenis_kategori = $_POST["jenis_kategori"];
            $request->sub_kategori = $_POST["sub_kategori"];
            $request->jumlah = $_POST["jumlah"];
            $request->deskripsi = $_POST["deskripsi"];

            // cek jika ada error yang mungkin dapat terjadi
            try {
                $this->transactionService->save($request);
                View::redirect("/dashboard");
            } catch (ValidationException $exception) {
                View::renderPage("Feature/transaction", [
                    "title" => "Tambah Data Transaksi",
                    "error" => $exception->getMessage()
                ]);
            }
        }

        public function deleteTransaction()
        {
            $data = $_POST["datetime"];
            $deleteDatetime = new TransactionDeleteRequest();
            $deleteDatetime->datetime = $data;

            $this->transactionService->deleteByDateTime($deleteDatetime->datetime);

            View::redirect("/dashboard");
        }

        public function updateTransactionPage()
        {
            $user_real_name = new Helper();
            $request = new TransactionRequest();
            $request->jenis_kategori = $_POST["jenis_kategori"];
            $request->sub_kategori = $_POST["sub_kategori"];
            $request->jumlah = $_POST["jumlah"];
            $request->deskripsi = $_POST["deskripsi"];
            $request->waktu_transaksi = $_POST["waktu_transaksi"];

            View::renderPage("Feature/update", [
                "title" => "Edit Data Transaksi",
                "jenis_kategori" => $request->jenis_kategori,
                "sub_kategori" => $request->sub_kategori,
                "jumlah" => $request->jumlah,
                "deskripsi" => $request->deskripsi,
                "waktu_transaksi" => $request->waktu_transaksi,
                "name" => ucfirst($user_real_name->showUserName()->name)
            ]);
        }
        public function postUpdateTransaction()
        {

            $request = new TransactionRequest();
            $request->jenis_kategori = $_POST["jenis_kategori"];
            $request->sub_kategori = $_POST["sub_kategori"];
            $request->jumlah = $_POST["jumlah"];
            $request->deskripsi = $_POST["deskripsi"];
            $request->waktu_transaksi = $_POST["waktu_transaksi"];

            // cek jika ada error yang mungkin dapat terjadi
            try {
                $this->transactionService->updateTransactionData($request);
                View::redirect("/dashboard");
            } catch (ValidationException $exception) {
                View::renderPage("Feature/update", [
                    "title" => "Edit Data Transaksi",
                    "error" => $exception->getMessage()
                ]);
            }
        }

        public function transactionActivity()
        {
            $request = new TransactionActivityRequest();
            $request->jenis_kategori = $_POST["jenis_kategori"];
            $request->sub_kategori = $_POST["sub_kategori"];

            try {
                $this->transactionService->addTransactionActivity($request);
                View::redirect("/transaction");
            } catch (ValidationException $exception) {
                View::renderPage("Feature/transaction", [
                    "title" => "Tambah Data Transaksi",
                    "error" => $exception->getMessage()
                ]);
            }
        }
    }

}