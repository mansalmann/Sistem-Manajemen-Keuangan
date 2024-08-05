<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

    use ProgrammerSalman\SistemManajemenKeuangan\Config\DatabaseCall;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\TransactionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Services\TransactionService;

    $queryParam = $_GET["transaksi"];
    
    $repository = new TransactionRepository(DatabaseCall::getDatabaseConnection("production"));
    $service = new TransactionService($repository);
    $dataSubKategori = $service->showAllCategories($queryParam);

    
    
    header('Content-Type: application/json');
    echo json_encode($dataSubKategori); // data dalam bentuk array




