<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Services {
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;
    use ProgrammerSalman\SistemManajemenKeuangan\Exception\ValidationException;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserLoginRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserLoginResponse;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserProfileUpdateRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserProfileUpdateResponse;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserRegisterRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserRegisterResponse;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserUpdatePasswordRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\UserRepository;

    // layer user service untuk menghandle logic program untuk akses user ke halaman web
    class UserService
    {

        private UserRepository $UserRepository;

        public function __construct(UserRepository $UserRepository)
        {
            $this->UserRepository = $UserRepository;
        }

        // untuk melakukan registrasi user baru
        public function register(UserRegisterRequest $request): UserRegisterResponse
        {
            $this->validateUserRegistrationRequest($request);

            try {
                // memulai transaction database
                DatabaseCall::beginTransaction();
                // langkah pertama, cek ada tidaknya data id user yang sudah terdaftar di database
                $userData = $this->UserRepository->findById($request->id);
                if ($userData !== null) {
                    throw new ValidationException("User ID sudah terdaftar");
                }

                // memasukkan data user ke database
                $user = new User();
                $user->id = $request->id;
                $user->name = $request->name;
                $user->password = password_hash($request->password, PASSWORD_BCRYPT); // hashing password

                $this->UserRepository->save($user);

                $response = new UserRegisterResponse();
                $response->user = $user;

                // commit transaction di database
                DatabaseCall::commitTransaction();
            } catch (\Exception $exception) {
                // jika proses di atas gagal maka lakukan rollback transaction dan kirim exception
                DatabaseCall::rollbackTransaction();
                throw $exception;
            }
            // kembalikan request data register user dalam bentuk User
            return $response;
        }

        // validasi request data register dari user
        private function validateUserRegistrationRequest(UserRegisterRequest $request)
        {
            if ($request->id == null || $request->name == null || $request->password == null || trim($request->id) == "" || trim($request->name) == "" || trim($request->password) == "") {
                throw new ValidationException("ID, Nama, dan Password Tidak Boleh kosong");
            }
        }

        // untuk menghandle login user yang sudah ada
        public function login(UserLoginRequest $request): UserLoginResponse
        {
            // validasi dulu inputan dari user
            $this->validateUserLoginRequest($request);

            // langkah pertama, cek dulu ada tidaknya data id user di database
            $user = $this->UserRepository->findById($request->id);
            if ($user == null) {
                // jangan dikasih tau di pesan error apakah id yang salah atau password yang salah
                throw new ValidationException("Id atau password salah");
            }

            // langkah kedua, cek password nya
            if (password_verify($request->password, $user->password)) {
                $response = new UserLoginResponse();
                $response->user = $user;
                return $response;
            } else {
                throw new ValidationException("Id atau password salah");
            }
        }

        // validasi data login dari user
        private function validateUserLoginRequest(UserLoginRequest $request)
        {
            if ($request->id == null || $request->password == null || trim($request->id) == "" || trim($request->password) == "") {
                throw new ValidationException("ID dan Password Tidak Boleh Kosong");
            }
        }

        // untuk menghandle profil update user
        public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
        {
            // validasi data inputan dari user
            $this->validateUserProfileUpdateRequest($request);

            try {
                DatabaseCall::beginTransaction();
                $user = $this->UserRepository->findById($request->id);
                if ($user == null) {
                    throw new ValidationException("Pengguna tidak ditemukan");
                }

                // ubah nama user
                $user->name = $request->name;
                $this->UserRepository->update($user);

                DatabaseCall::commitTransaction();

                $response = new UserProfileUpdateResponse();
                $response->user = $user;
                return $response;
            } catch (\Exception $exception) {
                DatabaseCall::rollbackTransaction();
                throw $exception;
            }
        }

        // validasi profile update dari user
        private function validateUserProfileUpdateRequest(UserProfileUpdateRequest $request)
        {
            if ($request->id == null || trim($request->id) == "" || $request->name == null || trim($request->name) == "") {
                throw new ValidationException("ID dan Nama Tidak Boleh Kosong");
            }
        }

        // untuk menghandle request data update password dari user
        public function updatePassword(UserUpdatePasswordRequest $request): UserProfileUpdateResponse
        {
            // validasi data dulu
            $this->validateUpdateUserPasswordRequest($request);

            try {
                DatabaseCall::beginTransaction();

                // cari data id user di database
                $user = $this->UserRepository->findById($request->id);
                if ($user == null) {
                    throw new ValidationException("Pengguna tidak ditemukan");
                }

                // cek kondisi password lama dengan password yang dimasukkan oleh user
                if (!password_verify($request->oldPassword, $user->password)) {
                    throw new ValidationException("Password lama salah");
                }

                // ubah password user
                $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
                $this->UserRepository->update($user);

                DatabaseCall::commitTransaction();

                $response = new UserProfileUpdateResponse();
                $response->user = $user;
                return $response;
            } catch (\Exception $exception) {
                DatabaseCall::rollbackTransaction();
                throw $exception;
            }
        }

        // validasi inputan password dari user
        private function validateUpdateUserPasswordRequest(UserUpdatePasswordRequest $request)
        {
            if ($request->oldPassword == null || trim($request->oldPassword) == "" || $request->newPassword == null || trim($request->newPassword) == "" || $request->id == null || trim($request->id) == "") {
                throw new ValidationException("Password Lama dan Password Baru Tidak Boleh Kosong");
            }
        }
    }
}