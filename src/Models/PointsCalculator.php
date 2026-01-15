<?php

namespace Models;

class PointsCalculator{
    public function calculate($spent){
        return floor($spent / 100) * 10;
    }
}