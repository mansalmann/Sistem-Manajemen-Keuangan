<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;

    // class yang merepresentasikan response data update nama profil dari user yang dikirim oleh service ke controller
    class UserProfileUpdateResponse
    {
        public User $user;
    }
}