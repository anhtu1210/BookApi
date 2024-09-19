<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class RoutesCommand extends Command
{
    protected $name = 'route:list';
    protected $description = 'List all registered routes';

    public function handle()
    {
        $routes = app()->router->getRoutes();

        $this->table(['Method', 'URI', 'Name', 'Action'], array_map(function ($route) {
            return [
                $route['method'],
                $route['uri'],
                $route['action']['as'] ?? '-',
                $route['action']['uses'] ?? '-'
            ];
        }, $routes));
    }
}
