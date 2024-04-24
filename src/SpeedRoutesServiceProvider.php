<?php

namespace Imanimen\SpeedRoutes;

use Illuminate\Support\ServiceProvider;
use Imanimen\SpeedRoutes\Console\Commands\CreateActionCommand;

class SpeedRoutesServiceProvider extends ServiceProvider
{
	public function boot()
	{
		if ( $this->app->runningInConsole() )
        {
            $this->commands( [
                                 CreateActionCommand::class ,
                             ] );
        }
	}

	public function register()
	{
		$this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
	}
}