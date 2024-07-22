<?php

namespace Imanimen\SpeedRoutes\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class GenerateDocumentationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "make:doc {--action=}";

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
// ...

public function handle()
{
    try {
        $action = $this->option('action');
        $acitonPath = app_path('Actions/') . $action . '.php';

        // instance of the action class
        $class_action = 'App\\Actions\\'. $action;
        if (!class_exists($class_action)) {
            return $this->error("Action does not exists!");
        }
        $class = (new $class_action());

        // payload
        $request = [];
        foreach ($class->validation() as $validation => $value) {
            $request[] = $validation;
            $this->info($validation);
        }

        // method 
        $method = $class->method();
        $this->info($method);
        /*
        * begin the swagger documenation instruction
        *
        */




        
    } catch (Exception $e) {
        $this->error("An Error Occurred " . $e->getMessage());
    }
}
}
