<?php

namespace imanimen\SpeedRoutes\Console\Commands;

use Exception;
use Illuminate\Console\Command;


class CreateActionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "make:action {name}";

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
           $dir    = base_path() . '/' . 'app/Actions/' . ucfirst($action) . 'Action.php';
           if (file_exists($dir))
           {
             $this->error('Action Already Exists!');
           }
           else
	   {
            $stubPath  = base_path() . '/' . '../../Stubs/ActionRoute.stub';
            $stub      = file_get_contents($stubPath);
            $stub      = str_replace('{{action_name}}', $action, $stub);

            $write     = base_path() . '/' . 'app/Actions/' . ucfirst($action) . 'Action.php';
            file_put_contents($write, $stub);
            $this->info("Action Created. Action Location: ". $write);
           }
        } catch (Exception $e) {
            $this->error("An Error Occurred");
        }
    }
}