<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
session_start();

$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$server = $_SERVER['REQUEST_METHOD'];

switch($url) {
    case '':
        $hikesController = new HikesController();
        $hikesController->index();
        break;
    case 'login':
        $login = new AuthController();
        if ($server === 'GET') {
            $login->showLoginForm();
        }
        if ($server === 'POST') {
            $login->login($_POST);
        }
        break;
    case 'register':
        $register = new AuthController();
        if ($server == 'GET') {
            $register->showRegistrationForm();
        }
        if ($server == 'POST') {
            $register->register($_POST);
        }
        break;
    case 'hike':
        $hikesController = new HikesController();
        if($server == 'GET') {
            $hikesController->show($_GET['id']);
        }
        if($server == 'POST') {
            $hikesController->deleteHike($_GET['id']);
        }
        break;
    case 'logout':
        $logout = new AuthController();
        $logout->logout();
        break;
    case 'newhike':
        $hikesController = new HikesController();
        if ($server == 'GET') {
            $hikesController->showNewHike();
        }
        if ($server == 'POST') {
            $hikesController->createNewHike($_POST);
        }
        break;
    case 'edithike':
        $hikesController = new HikesController();
        if($server == 'GET') {
            $hikesController->editHike($_GET['id']);
        }
        if($server == 'POST') {
            $hikesController->updateHike($_POST);
        }
    case 'debug':
        include 'View/includes/header.view.php';
        include 'View/temp.view.php';
        break;
    default:
        include 'View/includes/header.view.php';
        include 'View/404.view.php';
}