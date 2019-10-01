<?php

namespace controllers\home;


use framework\Controller;

class AuthentificationController extends Controller
{
    protected $errorMessage = " Votre identifiant ou  mot de passe, sont incorrects.";

    public function authForm()
    {

        $name = $this->form->input("text", "user", "", "auth_input", true);
        $nameLabel = $this->form->label("Utilisateur", "User");
        $pass = $this->form->input("password", "pass", "", "auth_input", true);
        $passLabel = $this->form->label("Mot de Passe", "Password");
        $submit = $this->form->submit("Se Connecter", "btn btn-info");
        $errorMessage = null;
        if (isset($_SESSION['POST_AUTH']) && !$_SESSION['POST_AUTH']) {
            $errorMessage = '<div class="error_form" >' . $this->errorMessage . '</div>';
        }
        require 'app/view/home/Connexion/connect.php';
    }

    public function authValidator()
    {
        unset($_SESSION['POST_AUTH']);

        $userName = htmlspecialchars($_POST['user']);
        $userPass = htmlspecialchars($_POST['pass']);

        $isNotAnonyme = explode('0', $userName);
        if ($isNotAnonyme[0] === 'Anonyme') {
            $_SESSION['POST_AUTH'] = false;
            header('Location: connexion ');
        }

        $user = $this->app->getManager('users');
        $user = $user->getUser($userName);
        if ($user) {
            $isPasswordCorrect = password_verify($userPass, $user->password);
            var_dump($isPasswordCorrect, $userName, $userPass);
            if ($isPasswordCorrect && $userName === $user->pseudo) {
                $this->defineUser($userName, $user->email);
                header('Location: /Billet-Simple-Pour-Alaska/ ');
            } else {
                $_SESSION['POST_AUTH'] = false;
                header('Location: connexion ');
            }
        }

    }

    public function defineUser($name, $mail)
    {
        $_SESSION['userName'] = $name;
        $_SESSION['userMail'] = $mail;
    }

    public function deconnexion()
    {
        unset($_SESSION['userName']);
        unset($_SESSION['userMail']);
        header('Location: connexion ');
    }


}