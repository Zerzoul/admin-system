<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 26/08/2019
 * Time: 22:48
 */

namespace controllers\home;


use framework\Controller;

class RegisterController extends Controller
{

    protected $error_name = null;
    protected $error_mail = null;
    protected $error_pass = null;
    protected $error_confirm = null;

    public function registerForm()
    {

        $name = $this->form->input("text", "userName", "", "auth_input", true);
        $nameLabel = $this->form->label("Nom d'utilisateur *", "User");
        $mail = $this->form->input("email", "Email", "", "auth_input", true);
        $mailLabel = $this->form->label("Email *", "email");
        $pass = $this->form->input("password", "password", "", "auth_input", true);
        $passLabel = $this->form->label("Mot de Passe *", "Password");
        $passConfirm = $this->form->input("password", "passwordConfirm", "", "auth_input", true);
        $passConfirmLabel = $this->form->label("Mot de Passe Confirmation *", "Password");
        $submit = $this->form->submit("S'inscrire", "");

        $this->isError();

        $error_name = $this->error_name;
        $error_mail = $this->error_mail;
        $error_pass = $this->error_pass;
        $error_confirm = $this->error_confirm;

        require 'app/view/home/Connexion/register.php';
    }

    public function isError()
    {
        if (isset($_SESSION['invalid-name'])) {
            $this->error_name = '<span class="error_form">' . $_SESSION['invalid-name'] . '</span>';
        }
        if (isset($_SESSION['invalid-pass'])) {
            $this->error_pass = '<span class="error_form">' . $_SESSION['invalid-pass'] . '</span>';
        }
        if (isset($_SESSION['invalid-confirmation'])) {
            $this->error_confirm = '<span class="error_form">' . $_SESSION['invalid-confirmation'] . '</span>';
        }
        if (isset($_SESSION['invalid-mail'])) {
            $this->error_mail = '<span class="error_form">' . $_SESSION['invalid-mail'] . '</span>';
        }
        if (isset($_SESSION['pseudo-Exist'])) {
            $this->error_name = '<span class="error_form">' . $_SESSION['pseudo-Exist'] . '</span>';
        }

    }

    public function registerValidation()
    {
        $name = $_POST['userName'];
        $email = $_POST['Email'];
        $pass = $_POST['password'];
        $passConfirm = $_POST['password'];

        $checkName = $this->userNameCheck($name);
        $checkEmail = $this->emailCheck($email, $name);
        $checkPass = $this->passwordCheck($pass, $passConfirm);

        if ($checkPass && $checkEmail && $checkName) {
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $users = $this->app->getManager('Users');

            $action = 'addRealUsers';
            if ($_SESSION['anonyme']) {
                $action = 'updateUsers';
                $updateCom = $this->app->getManager('comments');
                $updateCom->updateAuthorComment($_SESSION['anonymeName'], $name);
            }
            $users->$action($name, $passHash, $email);
            unset($_SESSION['anonyme']);
            unset($_SESSION['invalid-name']);
            unset($_SESSION['invalid-pass']);
            unset($_SESSION['invalid-confirmation']);
            unset($_SESSION['invalid-mail']);
            unset($_SESSION['pseudo-Exist']);

            $_SESSION['successRegister'] = true;
            header('Location: connexion');
            exit();
        }
        header('Location: inscription');
    }

    public function userNameCheck($name)
    {
        if (isset($name)) {
            if (is_string($name) && strlen($name) < 50) {
                return true;
            }
            $_SESSION['invalid-name'] = 'Nom d\'utilisateur doit d\'être de moins de 50 caractères ';
            return false;
        }
        $_SESSION['invalid-name'] = 'Nom d\'utilisateur invalid';
        return false;
    }

    public function emailCheck($email)
    {
        if (isset($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $users = $this->app->getController('users', 'home', null);
                $user = $users->isTheEmailExist($email);
                $anonyme = explode('0', $user);
                if (is_null($user)) {
                    return true;
                } elseif ($anonyme[0] === 'Anonyme') {
                    $_SESSION['anonyme'] = true;
                    $_SESSION['anonymeName'] = $user;
                    return true;
                }
                $_SESSION['pseudo-Exist'] = 'Ce nom d\'utilisateur est déjà rattaché à un email.';
                return false;
            }
        }
        $_SESSION['invalid-mail'] = 'Email invalid';
        return false;
    }

    public function passwordCheck($pass, $passConfirm)
    {
        if (isset($pass) && isset($passConfirm)) {
            if ($pass === $passConfirm) {
                if (strlen($pass) >= 8) {
                    return true;
                }
                $_SESSION['invalid-pass'] = 'Mot de passe trop court';
                return false;
            }
            $_SESSION['invalid-confirmation'] = 'Pas le même mot de passe';
            return false;
        }
        $_SESSION['invalid-pass'] = 'Mot de passe invalid';
        return false;
    }
}