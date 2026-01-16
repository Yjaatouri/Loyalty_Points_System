<?php

namespace Controllers;

use Models\RewardsModel;
use Models\PointsModel;

class RewardsController {
    private $container;
    private $rewardsModel;
    private $pointsModel;
    private $twig;

    public function __construct($container) {
        $this->container = $container;
        $this->rewardsModel = new RewardsModel($container->get('db'));
        $this->pointsModel = new PointsModel($container->get('db'));
        $this->twig = $container->get('twig');
    }

    public function browse() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $rewards = $this->rewardsModel->getAvailableRewards();
        echo $this->twig->render('rewards/browse.twig', ['rewards' => $rewards]);
    }

    public function redeem($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $reward = $this->rewardsModel->getRewardById($id);
        if ($reward && $this->pointsModel->deductPoints($_SESSION['user_id'], $reward['points_required'], "Redeemed: {$reward['name']}") && $this->rewardsModel->redeem($id)) {
            echo $this->twig->render('rewards/redeem.twig', ['reward' => $reward, 'success' => true]);
        } else {
            echo $this->twig->render('rewards/redeem.twig', ['success' => false]);
        }
    }
}