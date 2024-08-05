<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Controller {
    use ProgrammerSalman\SistemManajemenKeuangan\App\View;
    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Helper\Helper;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\TransactionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\SessionService;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\TransactionService;

    // controller untuk home
    class HomeController
    {
        private TransactionService $transactionService;

        private SessionService $sessionService;

        public function __construct()
        {
            $transactionRepository = new TransactionRepository(DatabaseCall::getDatabaseConnection());
            $this->transactionService = new TransactionService($transactionRepository);
        }

        public function home()
        {
            View::renderPage("User/index", [
                "title" => "Halaman Awal"
            ]);
        }

        public function dashboard()
        {
            $user_real_name = new Helper();
            $data = $this->transactionService->showAll();
            View::renderPage("Homepage/dashboard", [
                "title" => "Dashboard",
                "results" => $data,
                "name" => ucfirst($user_real_name->showUserName()->name)
            ]);
        }
    }

}