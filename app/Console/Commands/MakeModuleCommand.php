<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    private $basePath;

    public function __construct(
        protected Filesystem $filesystem,
    ){
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->name = $this->argument('name');
        $modelName = explode('/' , $this->name);
        $modelName = end($modelName);

        $this->basePath = $this->getBasePath();

        $this->createModuleFiles();

        $this->RunMakeCommands(ucfirst($modelName));
    }

    private function createModuleFiles()
    {
        $folders = [
            'Database' => [
                'Factories' => null,
                'Migrations' => null,
                'Seeders' => null,
                'Repositories' => [
                    'Contracts' => null,
                    'Repos' => null,
                ],
            ],
            'Http' => [
                'Controllers' => null,
                'Requests' => null,
                'Resources' => null,
            ],
            'Models' => null,
            'Providers' => null,
            'Routes' => null,
            'Services' => null,
            'policies' => null
        ];

        $this->createFolders($folders , $this->basePath);
        $this->createRouteFile();
    }
    private function createFolders(array $folders , $path)
    {
        foreach ($folders as $folder => $subs)
        {
            if (is_null($subs))
            {
                if (!$this->filesystem->exists($path . '/' . $folder))
                    $this->filesystem->makeDirectory($path . '/' . $folder, 0755, true);
            }
            else
            {
                $this->createFolders($subs , $path . '/' . $folder);
            }
        }
    }

    private function getBasePath()
    {
        $path = 'Modules/';

        if ($this->option('path'))
            $path = $path . $this->option('path') . '/';

        return base_path($path . $this->name);
    }

    private function makeNameSpace($modelName , $after)
    {
        $before = 'Modules\\';

        if ($this->option('path'))
            $before = $before . $this->option('path') . '\\';

        return 'namespace '.$before.$modelName.$after.';';
    }

    private function createRouteFile()
    {
        $routeFilePath = $this->getBasePath() . '/Routes/api.php';
        $this->filesystem->put($routeFilePath, "<?php\n\n// Define your routes here\n");
    }

    private function RunMakeCommands($modelName)
    {
        // Run the make:model command
        Artisan::call('make:model', [
            'name' => $modelName,
            '--migration' => true,
            '--controller' => true,
            '--seed' => true,
            '--factory' => true,
            '--policy' => true,
        ]);

//        Artisan::call('make:provider' , [
//            'name' => $modelName."ServiceProvider",
//        ]);
//        Artisan::call('make:provider' , [
//            'name' => $modelName."RepositoryServiceProvider",
//        ]);

        $this->moveFiles($modelName);
    }

    private function moveFiles($modelName)
    {
        $this->moveModel($modelName);
        $this->moveSeeder($modelName);
        $this->moveFactory($modelName);
        $this->moveController($modelName);
        $this->moveMigration($modelName);
//        $this->moveProviders($modelName);
    }

    private function moveModel($modelName):void
    {
        // Get the path of the created file
        $modelPath = app_path('Models/' . $modelName . '.php');

        // Check if the file exists and return the path
        if (file_exists($modelPath)) {

            $finalPath = $this->getBasePath() . '/Models/'. $modelName . '.php';

            $this->filesystem->move($modelPath , $finalPath);

            $this->updateNamespace($finalPath , 'namespace App\Models;' , $this->makeNameSpace($modelName,'\Models'));

            echo "Model Created \n";
        }
    }

    private function moveSeeder($modelName) :void
    {
        $seederName = Str::studly(class_basename($modelName)) . "Seeder";

        $seederPath = base_path('database/seeders/' . $seederName . '.php');

        // Check if the file exists and return the path
        if (file_exists($seederPath)) {

            $finalPath = $this->getBasePath() . '/Database/Seeders/'. $seederName . '.php';
            $this->filesystem->move($seederPath , $finalPath);
            $this->updateNamespace($finalPath , 'namespace Database\Seeders;' , $this->makeNameSpace($modelName,'\Database\Seeders'));

            echo "Seeder Created \n";
        }
    }
    private function moveFactory($modelName) :void
    {
        $factoryName = Str::studly(class_basename($modelName)) . "Factory";

        $factoryPath = base_path('database/factories/' . $factoryName . '.php');

        // Check if the file exists and return the path
        if (file_exists($factoryPath)) {

            $finalPath = $this->getBasePath() . '/Database/Factories/'. $factoryName . '.php';
            $this->filesystem->move($factoryPath , $finalPath);

            $this->updateNamespace($finalPath , 'namespace Database\Factories;' , $this->makeNameSpace($modelName,'\Database\Factories'));

            echo "Factory Created \n";
        }
    }
    private function moveController($modelName) :void
    {
        $controllerName = Str::studly(class_basename($modelName)) . "Controller";

        $controllerPath = app_path('Http/Controllers/' . $controllerName . '.php');

        // Check if the file exists and return the path
        if (file_exists($controllerPath)) {

            $finalPath = $this->getBasePath() . '/Http/Controllers/'. $controllerName . '.php';
            $this->filesystem->move($controllerPath , $finalPath);

            $this->updateNamespace($finalPath , 'namespace App\Http\Controllers;' , $this->makeNameSpace($modelName,'\Http\Controllers'));
            $this->addUseStatement($finalPath , 'use Illuminate\Http\Request;' , 'use App\Http\Controllers\Controller;');

            echo "Controller Created \n";
        }
    }
    private function moveMigration($modelName) :void
    {
        $tableName = "create_" . Str::snake(Str::pluralStudly(class_basename($modelName))) . "_table";

        // Get the path of the migrations directory
        $migrationPath = base_path('database/migrations');

        // Scan the directory for files matching the pattern
        $files = $this->filesystem->files($migrationPath);


        foreach ($files as $file) {
            if (Str::contains($file->getFilename(), $tableName)) {
                // Move the file to the module's Migrations directory
                $this->filesystem->move(
                    $migrationPath . '/' . $file->getFilename(),
                    $this->getBasePath() . '/Database/Migrations/' . $file->getFilename()
                );

                echo "Migration Created \n";
            }
        }
    }

    private function moveProviders($modelName)
    {
        $files = [$modelName."RepositoryServiceProvider.php" , $modelName."ServiceProvider.php"];

        foreach ($files as $file)
        {
            $providerPath = app_path('Providers/' . $file);
            $finalPath = $this->getBasePath() . '/Providers/'. $file;

            if (file_exists($providerPath)) {

                $this->filesystem->move($providerPath , $finalPath);

                $this->updateNamespace($finalPath , 'namespace App\Providers;' , 'namespace Modules\\'.$modelName.'\Providers;');

                echo "Provider Created \n";
            }
        }
    }

    private function updateNamespace($filePath, $oldNamespace, $newNamespace) :void
    {
        // Read the content of the file
        $content = file_get_contents($filePath);

        // Replace the old namespace with the new one
        $content = str_replace($oldNamespace, $newNamespace, $content);

        // Write the updated content back to the file
        file_put_contents($filePath, $content);
    }

    private function addUseStatement($filePath , $search , $add)
    {
        // Read the content of the file
        $content = file_get_contents($filePath);

        // Check if the 'use Illuminate\Http\Request;' exists
        if (str_contains($content, $search)) {

            // Check if 'use App\Http\Controllers\Controller;' is already in the file
            if (!str_contains($content, $add)) {

                // Find the position of 'use Illuminate\Http\Request;'
                $requestUsePos = strpos($content, $search);

                // Find the position of the semicolon after 'use Illuminate\Http\Request;'
                $semicolonPos = strpos($content, ';', $requestUsePos);

                // Insert 'use App\Http\Controllers\Controller;' after the 'use Illuminate\Http\Request;' statement
                $content = substr_replace($content, "\n" . $add, $semicolonPos + 1, 0);

                // Write the updated content back to the file
                file_put_contents($filePath, $content);
            }
        }
    }

}
