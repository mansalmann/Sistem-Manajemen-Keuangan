<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {

    // class yang merepresentasikan request data login dari user yang dikirim oleh controller ke service
    class UserLoginRequest
    {
        public ?string $id = null;
        public ?string $password = null;
    }
}