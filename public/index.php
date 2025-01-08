<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;  // Importer le contrôleur Auth

// Créer les instances des contrôleurs
$authController = new AuthController();

// Récupérer l'URL demandée
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Gérer les routes
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

    case '/dashboard':
        // Afficher le tableau de bord
        session_start();
        if (isset($_SESSION['user_id'])) {
            require __DIR__ . '/../templates/dashboard.php';
        } else {
            header('Location: /login');
            exit;
        }
        break;

    case '/logout':
        $authController->logout();
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

    default:
        http_response_code(404);
        echo "Page not found";
        break;
}