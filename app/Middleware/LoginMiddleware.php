<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Middleware {
    use ProgrammerSalman\SistemManajemenKeuangan\App\View;
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\SessionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\UserRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\SessionService;

    class LoginMiddleware implements Middleware
    {

        private SessionService $sessionService;

        public function __construct()
        {

            $sessionRepository = new SessionRepository(DatabaseCall::getDatabaseConnection());
            $userRepository = new UserRepository(DatabaseCall::getDatabaseConnection());
            $this->sessionService = new SessionService($sessionRepository, $userRepository);
        }
        function beforeController(): void
        {
            // cek apakah user belum login
            $user = $this->sessionService->currentSession();
            if ($user == null) {
                View::redirect("/login");
            }
        }
    }
}