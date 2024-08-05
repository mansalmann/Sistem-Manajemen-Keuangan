<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Domain {

    class Transaction
    {

        // class yang merepresentasikan tabel manajemen_keuangan (tabel yang berisi daftar transaksi yang terjadi)
        public string $jenis_kategori;
        public string $sub_kategori;
        public string $jumlah;
        public ?string $deskripsi = null;
        public string $waktu_transaksi;
    }
}