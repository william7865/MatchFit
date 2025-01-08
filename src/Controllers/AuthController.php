<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {

    public function index() {
        require __DIR__ . '/../../templates/index.php';
    }

    public function loginForm() {
        require __DIR__ . '/../../templates/login.php';
    }

    public function registerForm() {
        require __DIR__ . '/../../templates/register.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (User::findByEmail($email)) {
                $error = 'Cet email est déjà utilisé.';
                require __DIR__ . '/../../templates/register.php';
                return;
            }

            User::create($name, $email, $password, $role);

            if ($role === 'coach') {
                User::createCoachProfile($email);
            }

            header('Location: /login');
            exit;
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::authenticate($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                header('Location: dashboard');
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect.';
                require __DIR__ . '/../../templates/login.php';
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}
