<?php

namespace imanimen\SpeedRoutes;

interface ActionRouteInterface
{
    public function run();

    public function method();

    public function validation();
}