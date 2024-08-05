<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Helper {
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\SessionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\UserRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\SessionService;

    class Helper
    {
        private SessionService $sessionService;

        public function __construct()
        {
            $userRepository = new UserRepository(DatabaseCall::getDatabaseConnection());
            $sessionRepository = new SessionRepository(DatabaseCall::getDatabaseConnection());
            $this->sessionService = new SessionService($sessionRepository, $userRepository);
        }

        public function showUserName()
        {
            $user_real_name = $this->sessionService->currentSession();
            return $user_real_name;
        }

    }
}