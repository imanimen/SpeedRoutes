<?php

namespace imanimen\SpeedRoutes\src\Providers;

use Illuminate\Support\ServiceProvider;

class ActionRouteServiceProvider extends ServiceProvider
{
	public function boot()
	{
	}

	public function register()
	{
		$this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
	}
}