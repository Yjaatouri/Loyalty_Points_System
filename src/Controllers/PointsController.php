<?php

use Models\PointsModel;

class PointsController{
    private $container;
    private $pointsModel;
    private $twig;

    public function __construct($container){
        $this->container = $container;
        $this->pointsModel = new PointsModel($container->get('db'));
        $this->twig = $container->get('twig');
    }

    public function history(){
        if(!isset($_SESSION['user_id'])){
            header('location: /login');
            exit;
        }
        $history = $this->pointsModel->getHistory($_SESSION['user_id']);
        echo $this->twig->render('points/history.twig',['history' => $history]);
        
    }
}