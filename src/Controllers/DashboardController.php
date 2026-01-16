<?php

namespace Controllers;

use Models\UserModel;
use Models\PointsModels;

class DashboardController{
    private $container;
    private $userModel;
    private $pointsModel;
    private $twig;

    public function __construct($container){
        $this->container = $container;
        $this->userMOdel = new UserModel($container->get('db'));
        $this->pointModel = new PointsModel($container->get('db'));
        $this->twig = $container->get('twig');
    }

    public function index(){
        if(!isset($_SESSION['user_id'])){
            header('location: /login');
            exit;
        }
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $balance = $this->pointsModel->getBalance($_SESSION['user_id']);
        echo $this->twig->render('dashboard/index.twig', ['user' => $user, 'balance' => $balance]);

    }
}