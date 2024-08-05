<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;

    // class yang merepresentasikan response data update password user yang dikirim oleh service ke controller
    class UserUpdatePasswordResponse
    {
        public User $user;
    }
}
