<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;

    class UserRegisterResponse
    {

        // class yang merepresentasikan response data register user yang dikirim oleh service ke controller
        public User $user;
    }
}