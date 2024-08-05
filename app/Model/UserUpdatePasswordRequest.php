<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Model {

    // class yang merepresentasikan request data update password user yang dikirim oleh controller ke service
    class UserUpdatePasswordRequest
    {
        public ?string $id = null;
        public ?string $oldPassword = null;
        public ?string $newPassword = null;
    }
}