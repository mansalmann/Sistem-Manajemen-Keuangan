<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Controller {
    use ProgrammerSalman\SistemManajemenKeuangan\App\View;
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Exception\ValidationException;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserLoginRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserProfileUpdateRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserRegisterRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Model\UserUpdatePasswordRequest;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\SessionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\UserRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\SessionService;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\UserService;

    // controller untuk menerima request dari user dan mengirim request tsb ke service
    class UserController
    {

        private UserService $UserService;
        private SessionService $sessionService;

        public function __construct()
        {
            $UserRepository = new UserRepository(DatabaseCall::getDatabaseConnection());
            $this->UserService = new UserService($UserRepository);

            $sessionRepository = new SessionRepository(DatabaseCall::getDatabaseConnection());
            $this->sessionService = new SessionService($sessionRepository, $UserRepository);
        }

        // menampilkan halaman register user
        public function register()
        {
            View::renderPage("User/register", [
                "title" => "Halaman Registrasi"
            ]);
        }

        // sebagai handler ketika terjadi aktivitas register dari user
        public function postRegister()
        {
            $request = new UserRegisterRequest();
            $request->id = $_POST["id"]; // ambil data dari form
            $request->name = $_POST["name"];
            $request->password = $_POST["password"];

            // cek jika ada eror yang dapat terjadi
            try {
                $this->UserService->register($request);
                // jika register sukses maka redirect ke halaman login
                View::redirect("/login");
            } catch (ValidationException $exception) {
                // jika ada register gagal maka tetap di halaman register
                View::renderPage("User/register", [
                    "title" => "Halaman Registrasi",
                    "error" => $exception->getMessage()
                ]);
            }
        }

        // menampilkan halaman login user
        public function login()
        {
            View::renderPage("User/login", [
                "title" => "Halaman Login"
            ]);
        }

        // sebagai handler ketika terjadi aktivitas login dari user
        public function postLogin()
        {
            $request = new UserLoginRequest();
            $request->id = $_POST["id"]; // kirim data dari form
            $request->password = $_POST["password"];

            try {
                $response = $this->UserService->login($request);

                // jika login sukses maka buat cookie nya menggunakan session
                $this->sessionService->createSession($response->user->id);
                View::redirect("/dashboard"); // halaman dashboard
            } catch (ValidationException $exception) {
                // jika login gagal maka tetap berada di halaman login
                View::renderPage("User/login", [
                    "title" => "Halaman login",
                    "error" => $exception->getMessage()
                ]);
            }
        }

        // sebagai handler ketika terjadi aktivitas logout dari user
        public function logout()
        {
            $this->sessionService->destroySession();
            View::redirect("/");
        }

        // menampilkan halaman update profile
        public function updateProfile()
        {
            // cek session saat ini
            $user = $this->sessionService->currentSession();

            View::renderPage("User/profile", [
                "title" => "Halaman Edit Profil",
                "user" => [
                    "id" => $user->id,
                    "name" => $user->name
                ]
            ]);
        }

        // sebagai handler ketika terjadi aktivitas perubahan nama profil dari user
        public function postUpdateProfile()
        {
            // cek data session user saat ini
            $user = $this->sessionService->currentSession();
            $request = new UserProfileUpdateRequest();
            $request->id = $user->id;
            $request->name = $_POST["name"]; // ambil data dari form

            try {
                $this->UserService->updateProfile($request);
                View::redirect("/assets/Homepage/dashboard");
            } catch (ValidationException $exception) {
                View::renderPage("User/profile", [
                    "title" => "Halaman Edit Profil",
                    "error" => $exception->getMessage(),
                    "user" => [
                        "id" => $user->id,
                        "name" => $_POST["name"]
                    ]
                ]);
            }
        }

        // menampilkan halaman update password user
        public function updatePassword()
        {
            $user = $this->sessionService->currentSession();
            View::renderPage("User/password", [
                "title" => "Halaman Perbarui Password",
                "user" => [
                    "id" => $user->id
                ]
            ]);
        }

        // sebagai handler ketika terjadi aktivitas perubahan password akun dari user
        public function postUpdatePassword()
        {
            // cek session user saat ini
            $user = $this->sessionService->currentSession();
            $request = new UserUpdatePasswordRequest();
            $request->id = $user->id;
            $request->oldPassword = $_POST["oldPassword"];
            $request->newPassword = $_POST["newPassword"];

            try {
                $this->UserService->updatePassword($request);
                View::redirect("/assets/Homepage/dashboard");
            } catch (ValidationException $exception) {
                View::renderPage("User/password", [
                    "title" => "Halaman Perbarui Password",
                    "error" => $exception->getMessage(),
                    "user" => [
                        "id" => $user->id
                    ]
                ]);
            }
        }
    }
}
