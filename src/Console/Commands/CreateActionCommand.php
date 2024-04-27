<?php

namespace Imanimen\SpeedRoutes\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class CreateActionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "make:action {name} {--method=GET} {--module=}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "create actions";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $action = $this->argument('name');
            $method = strtoupper($this->option('method'));
            $module = $this->option('module');

            if (!in_array($method, ['GET', 'POST', 'DELETE', 'PATCH', 'ANY'])) {
                throw new Exception("Invalid method specified.");
            }

            $modulePath = '';
            if (!empty($module)) {
                $modulePath = ucfirst($module) . '/';
            }

            $dir = base_path() . '/Modules/' . $modulePath . 'Actions/' . ucfirst($action) . 'Action.php';
            $actionDir = base_path() . '/Modules/' . $modulePath . 'Actions/';

            if (!is_dir($actionDir)) {
                mkdir($actionDir, 0755, true);
            }

            if (file_exists($dir)) {
                $this->error('Action Already Exists!');
            } else {
                $stubPath = __DIR__ . '/../../Stubs/ActionRoute.stub';
                $stub = file_get_contents($stubPath);
                $stub = str_replace(['{{action_name}}', '{{method}}'], [$action, $method], $stub);

                $write = base_path() . '/Modules/' . $modulePath . 'Actions/' . ucfirst($action) . 'Action.php';
                file_put_contents($write, $stub);
                $this->info("Action Created. Action Location: " . $write);
            }
        } catch (Exception $e) {
            $this->error("An Error Occurred " . $e->getMessage());
        }
    }
}
