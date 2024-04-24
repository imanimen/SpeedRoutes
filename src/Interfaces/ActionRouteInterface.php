<?php

namespace Imanimen\SpeedRoutes\src\Interfaces;

interface ActionRouteInterface
{
    public function run();

    public function method();

    public function validation();
}