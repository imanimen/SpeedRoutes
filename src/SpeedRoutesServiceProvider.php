<?php

namespace Imanimen\SpeedRoutes;

use Illuminate\Support\ServiceProvider;
use Imanimen\SpeedRoutes\Console\Commands\CreateActionCommand;
use Imanimen\SpeedRoutes\Console\Commands\GenerateDocumentationCommand;

class SpeedRoutesServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				CreateActionCommand::class,
				GenerateDocumentationCommand::class
			]);
		}
	}

	public function register(): void
	{
		$this->mergeConfigFrom(__DIR__ . './../config/speed-routes.php', 'speed-routes');

		$this->loadRoutesFrom(__DIR__ . './../routes/web.php')
	}
}
