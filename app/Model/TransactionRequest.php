<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model{

    class TransactionRequest {

        
        public ?string $jenis_kategori = null;
        public ?string $sub_kategori = null;
        public ?string $jumlah = null;
        public ?string $deskripsi = null;
        public ?string $waktu_transaksi = null;
    }
}