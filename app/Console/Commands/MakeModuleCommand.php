<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleCommand extends Command
{
    protected $signature = 'wue:make-module {module}';

    protected $description = 'Create a new module directory with subdirectories';

    protected $subDirectories = [
        'Database' => ['Migrations', 'Seeders'],
        'Http' => ['Controllers', 'Middleware'],
        'Models',
        'Providers',
        'Resources' => ['js/Pages'],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $moduleName = $this->argument('module');
        $modulePath = base_path('modules/'.$moduleName);

        // Check if the module directory already exists
        if (file_exists($modulePath)) {
            return $this->error('The module directory already exists.');
        }

        // Create the module directory
        if (!mkdir($modulePath, 0755, true)) {
            return $this->error('Failed to create the module directory.');
        }

        // Create subdirectories
        foreach ($this->subDirectories as $directory => $subDirs) {
            // If subDirs is an array, create subdirectories
            if (is_array($subDirs)) {
                foreach ($subDirs as $subDir) {
                    $this->createDirectory($modulePath.'/'.$directory.'/'.$subDir);
                }
            } else { // If subDirs is a string, create a single subdirectory
                $this->createDirectory($modulePath.'/'.$subDirs);
            }
        }

        // Create routes.php file
        File::put($modulePath.'/routes.php', '<?php

// Routes for '.$moduleName.' module

');

        // Create Index.vue file under Resources/js/Pages
        $indexVuePath = $modulePath.'/Resources/js/Pages/Index.vue';
        File::put($indexVuePath, $this->getIndexVueTemplate());

        $this->info('Module directory, subdirectories, routes.php file, and Index.vue file created successfully.');
    }

    protected function createDirectory($path)
    {
        if (!mkdir($path, 0755, true)) {
            return $this->error('Failed to create the directory: '.$path);
        }
    }

    protected function getIndexVueTemplate()
    {
        return <<<EOF
<template>
  <div>
    <!-- Your HTML content here -->
  </div>
</template>

<script>
export default {
  // Your Vue component logic here
}
</script>

<style scoped>
/* Your component styles here */
</style>
EOF;
    }
}
