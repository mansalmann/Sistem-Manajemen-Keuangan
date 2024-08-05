<?php
require_once __DIR__ . "/../vendor/autoload.php";
use ProgrammerSalman\SistemManajemenKeuangan\App\Router;
use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
use ProgrammerSalman\SistemManajemenKeuangan\Controller\HomeController;
use ProgrammerSalman\SistemManajemenKeuangan\Controller\TransactionController;
use ProgrammerSalman\SistemManajemenKeuangan\Controller\UserController;
use ProgrammerSalman\SistemManajemenKeuangan\Middleware\LoginMiddleware;
use ProgrammerSalman\SistemManajemenKeuangan\Middleware\NotLoginMiddleware;

// Database env production
DatabaseCall::getDatabaseConnection("production");

// Home Controller
Router::add("GET", "/", HomeController::class, "home", [NotLoginMiddleware::class]); // halaman antarmuka
Router::add("GET", "/dashboard", HomeController::class, "dashboard", [LoginMiddleware::class]);

// User Controller
Router::add("GET", "/register", UserController::class, "register", [NotLoginMiddleware::class]);
Router::add("POST", "/register", UserController::class, "postRegister", [NotLoginMiddleware::class]);
Router::add("GET", "/login", UserController::class, "login", [NotLoginMiddleware::class]);
Router::add("POST", "/login", UserController::class, "postLogin", [NotLoginMiddleware::class]);
Router::add("GET", "/logout", UserController::class, "logout", [LoginMiddleware::class]);
Router::add("GET", "/profile", UserController::class, "updateProfile", [LoginMiddleware::class]);
Router::add("POST", "/profile", UserController::class, "postUpdateProfile", [LoginMiddleware::class]);
Router::add("GET", "/password", UserController::class, "updatePassword", [LoginMiddleware::class]);
Router::add("POST", "/password", UserController::class, "postUpdatePassword", [LoginMiddleware::class]);
Router::add("GET", "/logout", UserController::class, "logout", [LoginMiddleware::class]);

// Transaction Controller
Router::add("GET", "/transaction", TransactionController::class, "transactionPage", [LoginMiddleware::class]);
Router::add("POST", "/transaction", TransactionController::class, "postTransaction", [LoginMiddleware::class]);
Router::add("POST", "/delete", TransactionController::class, "deleteTransaction", [LoginMiddleware::class]);
Router::add("POST", "/updates", TransactionController::class, "updateTransactionPage", [LoginMiddleware::class]);
Router::add("POST", "/update", TransactionController::class, "postUpdateTransaction", [LoginMiddleware::class]);
Router::add("POST", "/activity", TransactionController::class, "transactionActivity", [LoginMiddleware::class]);

// menjalankan routing
Router::run();

