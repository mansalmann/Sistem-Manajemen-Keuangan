<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;

    // class yang merepresentasikan hasil response data login dari user yang dikirim oleh service ke controller
    class UserLoginResponse
    {
        public User $user;
    }
}