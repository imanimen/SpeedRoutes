<?php

namespace Imanimen\SpeedRoutes\Interfaces;

interface BehaviorInterface
{
    public function check() : bool;
    public function getError() : string;
}