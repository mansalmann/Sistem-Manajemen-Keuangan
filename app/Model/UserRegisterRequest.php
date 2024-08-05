<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {
    class UserRegisterRequest
    {

        // class yang merepresentasikan request data register user yang dikirim oleh controller ke service
        public ?string $id = null;
        public ?string $name = null;
        public ?string $password = null;
    }
}
