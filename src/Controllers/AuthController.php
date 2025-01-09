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
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];

                if ($user['role'] === 'coach') {
                    header('Location: /coach/profile');
                } else {
                    header('Location: /user/profile');
                }
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect.';
                require __DIR__ . '/../../templates/login.php';
            }
        }
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }

            $userId = $_SESSION['user_id'];
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? null;
            $bio = $_POST['bio'] ?? '';
            $video_url = $_POST['video_url'] ?? '';

            \App\Models\User::update($userId, $name, $email, $password);

            if ($_SESSION['role'] === 'coach') {
                \App\Models\User::updateCoachProfile($userId, $bio, $video_url);
                header('Location: /coach/profile');
            } else {
                header('Location: /user/profile');
            }
            exit;
        }
    }

    public function showCoachProfile($coachId) {
        $coach = \App\Models\User::findById($coachId);
        if (!$coach || $coach['role'] !== 'coach') {
            echo "Erreur : coach non trouvé.";
            exit;
        }

        require __DIR__ . '/../../templates/profiles/coachAccount.php';
    }

    public function showCoaches() {
        $coaches = User::getAllCoaches();
        require __DIR__ . '/../../templates/coach.php';
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}