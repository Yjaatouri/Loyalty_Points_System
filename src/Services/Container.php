<?php
// container 
class Container {
    private $services = [];

    public function set($name, $service) {
        $this->services[$name] = $service;
    }

    public function get($name) {
        if (!isset($this->services[$name])) {
            throw new Exception("Service $name not found");
        }
        return $this->services[$name];
    }
}