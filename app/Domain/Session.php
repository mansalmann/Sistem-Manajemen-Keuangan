<?php
namespace ProgrammerSalman\SistemManajemenKeuangan\Domain{
    class Session{

        // class yang merepresentasikan tabel session (untuk menyimpan data user yang sedang login)
        public string $id;
        public string $userId;
    }

}