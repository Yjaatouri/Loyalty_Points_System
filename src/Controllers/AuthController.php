<?php
namespace Controllers;
use Models\UserModel;
class AuthController {

    private $container;
    private $userModel;
    private $twig;

    public function __construct($container){
        $this->container = $container;
        $this->userModel = new UserModel($container->get('db'));
        $this->twig = $container->get('twig');
    }

    public function sowRegister(){
        echo $this->twig->render('auth/register.twig');
    }

    public function register(){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $name = $_POST['name'] ?? '';
        if ($this->userModel-register($email,$password,$name)){
            header('Location: /login');
            exit;
        }else{
            echo $this->twig->render('auth/register.twig',['error'=>'Registration failled']);
        }
    }
    public function login(){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->login($email , $password);
        if($user){
            $_SESSION['user_id'] = $user['id'];
            header('Location: /dashboard');
            exit;
        }else{
            echo $this->twig->render('auth/login.twig',['error' => 'Invalide credentials']);
        }
    }

    public function logout(){
        session_destroy();
        header('Location: /login');
        exit;
    }
}