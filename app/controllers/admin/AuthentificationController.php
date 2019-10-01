<?php

namespace controllers\admin;


class AuthentificationController extends \framework\Controller
{
    protected $errorMessage = " Votre identifiant ou  mot de passe, sont incorrect.";

    public function formLogin()
    {
        $name = $this->form->input("text", "userName", "", "form-control", true);
        $nameLabel = $this->form->label("userName", "User");
        $pass = $this->form->input("password", "userPass", "", "form-control", true);
        $passLabel = $this->form->label("userPass", "Password");
        $submit = $this->form->submit("submit", "btn btn-info");
        $errorMessage = null;
        if (isset($_SESSION['POST_AUTH']) && !$_SESSION['POST_AUTH']) {
            $errorMessage = '<div class="alert alert-danger" role="alert">' . $this->errorMessage . '</div>';
        }
        require '../app/view/admin/login/login.php';
    }

    public function authValidator()
    {
        if (!isset($_POST['userName']) || !isset($_POST['userPass'])) {
            throw new \Exception("You need to field the gap to be able to access the admin Manager");
        }
        $userName = $_POST['userName'];
        $userPass = $_POST['userPass'];

        $adminUser = $this->app->getManager('users');
        $adminUser = $adminUser->getAdminUser();


        $isPasswordCorrect = password_verify($userPass, $adminUser[0]->password);
        if ($isPasswordCorrect && $userName === $adminUser[0]->username) {
            $_SESSION['admin'] = $adminUser[0]->username;
        } else {
            $_SESSION['POST_AUTH'] = false;
        }

        $this->access('');
    }

    public function access()
    {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['POST_AUTH']);
            header("Location: dashboard");
            exit();
        } else {
            header("Location: login");
            exit();
        }
    }

    public function deconnexion()
    {
        $_SESSION = [];
        session_destroy();
        return $this->access();
    }
}