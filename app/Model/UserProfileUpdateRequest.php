<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {

    // class yang merepresentasikan request data update nama profil dari user yang dikirim oleh controller ke service
    class UserProfileUpdateRequest
    {
        public ?string $id = null;
        public ?string $name = null;
    }
}