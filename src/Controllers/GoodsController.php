<?php

namespace Controllers;

use Models\GoodsModel;
use Model\PointsModel;
use Models\PointsCalculator;

class GoodsController {
    private $container;
    private $goodsModel;
    private $pointsModel;
    private $pointsCalculator;
    private $twig;

    public function __construct($container){
        $this->container  = $container;
        $this->goodsMOdel = new GoodsModel($container->get('db'));
        $this->pointsModel = new PointsModel($container->get('db'));
        $this->pointsCalculator = new PointsCalculator();
        $this->twig = $container->get('twig');
        }
        public function index(){
            if (!isset($_SESSION['user_id'])){
                header('Location: /login');
                exit;
            }
            $goods = $this->goodsModel->getAllGoods();
            echo $this->twig->render('shop/index.twig' , ['goods' => $goods]);
            }
            public function buy ($id){
                if (!isset($_SESSION['user_id'])){
                    header('Location : /login');
                    exit;
                }
                $good = $this->goodsModel->getGoodById($id);
                if($good && $this->goodModel->buy($id)){
                    $points = $this->pointsCalculator->calculate($good['price']);
                    $this->pointsModel->addPoints($_SESSION['user_id'],$points ,"purhsase :{$good['name']} for {$good['price']} DH" );
                    header('Location : /dashboard');
                    exit;
                } else {
                    header('Location: /shop');
                    exit;
                }
            }
}