<?php

namespace Imanimen\SpeedRoutes;

use Illuminate\Support\ServiceProvider;

class SpeedRoutesServiceProvider extends ServiceProvider
{
	public function boot()
	{
	}

	public function register()
	{
		$this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
	}
}