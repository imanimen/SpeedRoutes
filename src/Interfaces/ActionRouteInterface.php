<?php

namespace imanimen\SpeedRoutes\Interfaces;

interface ActionRouteInterface
{
    public function run();

    public function method();

    public function validation();
}