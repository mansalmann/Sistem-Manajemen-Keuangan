<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Services {
    use ProgrammerSalman\SistemManajemenKeuangan\App\View;
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\Transaction;
    use ProgrammerSalman\SistemManajemenKeuangan\Exception\ValidationException;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionActivityRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\TransactionResponse;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\TransactionRepository;

    class TransactionService
    {

        private TransactionRepository $transactionRepository;
        public function __construct(TransactionRepository $repository)
        {
            $this->transactionRepository = $repository;
        }

        // untuk melakukan save data transaksi ke database
        public function save(TransactionRequest $request): TransactionResponse
        {
            $this->validateTransactionRequest($request);

            try {
                DatabaseCall::beginTransaction();
                // masukkan data transaction
                $transaction = new Transaction();
                $transaction->jenis_kategori = $request->jenis_kategori;
                $transaction->sub_kategori = $request->sub_kategori;
                $transaction->jumlah = $request->jumlah;
                $transaction->deskripsi = $request->deskripsi;

                $this->transactionRepository->save($transaction);

                $response = new TransactionResponse();
                $response->transaction = $transaction;

                DatabaseCall::commitTransaction();
            } catch (ValidationException $exception) {

                DatabaseCall::rollBackTransaction();
                throw $exception;
            }
            return $response;
        }

        // validasi data form 
        private function validateTransactionRequest(TransactionRequest $request)
        {
            if ($request->jenis_kategori == null || trim($request->jenis_kategori) == "" || $request->sub_kategori == null || trim($request->sub_kategori) == "" || $request->jumlah == null || trim($request->jumlah) == "") {
                throw new ValidationException("Data isian selain deskripsi tidak boleh kosong");
            }
        }

        public function showAllCategories(string $categoryType): array
        {

            // validasi data nya dulu
            $this->validationTransactionOptions($categoryType);
            $data = "";
            try {
                DatabaseCall::beginTransaction();
                $data = $this->transactionRepository->showAllCategories($categoryType);
                DatabaseCall::commitTransaction();
            } catch (ValidationException $exception) {
                DatabaseCall::rollBackTransaction();
                throw $exception;
            }

            return $data;
        }

        private function validationTransactionOptions(string $categoryType)
        {
            if ($categoryType == null || trim($categoryType) == "") {
                throw new ValidationException("Jenis kategori transaksi salah");
            }
        }

        public function showAll(): array
        {
            return $this->transactionRepository->showAll();
        }

        public function deleteByDateTime(string $datetime)
        {
            $this->transactionRepository->deleteByDateTime($datetime);
        }

        public function updateTransactionData(TransactionRequest $request): TransactionResponse
        {
            // validasi data dulu
            $this->validateUpdateTransactionRequest($request);

            try {
                DatabaseCall::beginTransaction();
                // masukkan data transaction
                $transaction = new Transaction();
                $transaction->jenis_kategori = $request->jenis_kategori;
                $transaction->sub_kategori = $request->sub_kategori;
                $transaction->jumlah = $request->jumlah;
                $transaction->deskripsi = $request->deskripsi;
                $transaction->waktu_transaksi = $request->waktu_transaksi;

                $this->transactionRepository->updateTransactionData($transaction);

                $response = new TransactionResponse();
                $response->transaction = $transaction;

                DatabaseCall::commitTransaction();
            } catch (ValidationException $exception) {

                DatabaseCall::rollBackTransaction();
                throw $exception;
            }
            return $response;

        }

        private function validateUpdateTransactionRequest(TransactionRequest $request)
        {
            if ($request->jenis_kategori == null || trim($request->jenis_kategori) == "" || $request->sub_kategori == null || trim($request->sub_kategori) == "" || $request->jumlah == null || trim($request->jumlah) == "" || $request->waktu_transaksi == null || trim($request->waktu_transaksi) == "") {
                throw new ValidationException("Terdapat data yang salah. Mohon untuk diperbaiki.");
            }
        }

        public function addTransactionActivity(TransactionActivityRequest $request)
        {
            $this->validateAddTransactionActivity($request);
            DatabaseCall::beginTransaction();
            $this->transactionRepository->addTransactionActivity($request);
            DatabaseCall::commitTransaction();

        }

        public function validateAddTransactionActivity(TransactionActivityRequest $request)
        {
            if ($request->jenis_kategori == null || trim($request->jenis_kategori) == "") {
                // throw new ValidationException("Terdapat kesalahan dalam menambahkan data aktivitas transaksi");
                View::redirect("/transaction");
                exit();
            }
        }

    }
}