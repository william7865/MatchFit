<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

$authController = new AuthController();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {
    case '/':
        $authController->index();
        break;

    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->loginForm();
        }
        break;

    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->registerForm();
        }
        break;

    case '/logout':
        $authController->logout();
        break;

    case '/coach':
        $authController->showCoaches();
        break;

    case (preg_match('/^\/coach\/profile\/(\d+)$/', $path, $matches) ? true : false):
        $coachId = $matches[1];
        $authController->showCoachProfile($coachId);
        break;

    case '/coach/profile':
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'coach') {
            require __DIR__ . '/../templates/profiles/coachProfile.php';
        } else {
            header('Location: /login');
            exit;
        }
        break;

    case '/user/profile':
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
            require __DIR__ . '/../templates/profiles/userProfile.php';
        } else {
            header('Location: /login');
            exit;
        }
        break;

    case '/updateProfile':
        $authController->updateProfile();
        break;

    case '/free-courses':
        require __DIR__ . '/../templates/freeCourses.php';
        break;

    case '/profile':
        session_start();
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] === 'coach') {
                require __DIR__ . '/../templates/profiles/coachProfile.php';
            } else {
                require __DIR__ . '/../templates/profiles/userProfile.php';
            }
        } else {
            header('Location: /login');
        }
        break;

    default:
        http_response_code(404);
        echo "Page not found";
        break;
}