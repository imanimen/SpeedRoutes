<?php

namespace imanimen\SpeedRoutes\src\IInterfaces;

interface ActionRouteInterface
{
    public function run();

    public function method();

    public function validation();
}