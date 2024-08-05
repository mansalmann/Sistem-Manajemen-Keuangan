<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Middleware {
    use ProgrammerSalman\SistemManajemenKeuangan\App\View;
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\SessionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\UserRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\SessionService;

    class NotLoginMiddleware implements Middleware
    {

        private SessionService $sessionService;
        // private SessionRepository $sessionRepository;
        // private UserRepository $userRepository;

        public function __construct()
        {

            $sessionRepository = new SessionRepository(DatabaseCall::getDatabaseConnection());
            $userRepository = new UserRepository(DatabaseCall::getDatabaseConnection());
            $this->sessionService = new SessionService($sessionRepository, $userRepository);
        }
        function beforeController(): void
        {
            // cek user sudah login apa belum
            $user = $this->sessionService->currentSession();
            if ($user != null) {
                View::redirect("/dashboard");
            }
        }
    }
}