<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {

    // Afficher la page d'accueil avec le formulaire de connexion et d'inscription
    public function index() {
        require __DIR__ . '/../../templates/index.php';
    }

    // Afficher le formulaire de connexion
    public function loginForm() {
        require __DIR__ . '/../../templates/login.php';
    }

    // Afficher le formulaire d'inscription
    public function registerForm() {
        require __DIR__ . '/../../templates/register.php';
    }

    // Gérer l'inscription de l'utilisateur
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifier si l'email existe déjà
            if (User::findByEmail($email)) {
                $error = 'Cet email est déjà utilisé.';
                require __DIR__ . '/../../templates/register.php';
                return;
            }

            // Créer l'utilisateur
            User::create($name, $email, $password);

            // Rediriger vers la page de connexion après inscription
            header('Location: login.php');
            exit;
        }
    }

    // Gérer la connexion de l'utilisateur
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Authentifier l'utilisateur
            $user = User::authenticate($email, $password);

            if ($user) {
                // Démarrer la session et stocker les informations de l'utilisateur
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Rediriger vers le tableau de bord
                header('Location: dashboard');
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect.';
                require __DIR__ . '/../../templates/login.php';
            }
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}
