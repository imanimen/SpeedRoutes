<?php

namespace Imanimen\SpeedRoutes\Interfaces;

interface BehaviorInterface
{
    public function check() : bool;
    public function errorMessage() : string;
    public function errorCode() : int;
}