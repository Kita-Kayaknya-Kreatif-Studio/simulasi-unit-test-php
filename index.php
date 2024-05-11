<?php

require_once 'vendor/autoload.php';

use App\Controller\EmployeeController;

$splitedUri = explode('?', $_SERVER['REQUEST_URI']);
$requestUri = $splitedUri[0];

$method = $_SERVER['REQUEST_METHOD'];
$content = file_get_contents('php://input');

header('Content-Type: application/json');

switch ($requestUri) {
    case '/api/storage-stock':
        switch ($method) {
            case 'POST':
                $controller = new EmployeeController();
                $result = $controller->store($_POST);
                http_response_code($result['status']);
                echo json_encode($result);

                return;
            break;
        }
    break;
}
