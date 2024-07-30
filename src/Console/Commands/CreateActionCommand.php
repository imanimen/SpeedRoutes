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
    protected $description = "Create actions";

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
            $actionDir = '';
            $namespace = 'App\\Actions';

            if (!empty($module)) {
                $modulePath = 'Modules/' . ucfirst($module) . '/';
                $actionDir = base_path($modulePath . 'Actions/');
                $namespace = 'Modules\\' . ucfirst($module) . '\\Actions';
            } else {
                $actionDir = app_path('Actions/');
            }

            if (!is_dir($actionDir)) {
                mkdir($actionDir, 0755, true);
            }

            $dir = $actionDir . ucfirst($action) . 'Action.php';

            if (file_exists($dir)) {
                $this->error('Action Already Exists!');
            } else {
                $stubPath = __DIR__ . '/../../Stubs/ActionRoute.stub';
                $stub = file_get_contents($stubPath);
                $stub = str_replace(
                    ['{{namespace}}', '{{action_name}}', '{{method}}'],
                    [$namespace, $action, $method],
                    $stub
                );

                $write = $actionDir . ucfirst($action) . 'Action.php';
                file_put_contents($write, $stub);
                $this->info("Action Created. Action Location: " . $write);
            }
        } catch (Exception $e) {
            $this->error("An Error Occurred: " . $e->getMessage());
        }
    }
}
