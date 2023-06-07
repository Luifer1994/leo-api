<?php

namespace App\Console\Commands\Permissions\Categories;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CategoryPermissionsManyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-permission-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Createa all permissions for category module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Creando permisos de categories...');
        try {
            $permisions = [
                [
                    'name'        => 'categories-module',
                    'description' => 'Módulo de categoría',
                    'group'       => 'Categorías'
                ],
                [
                    "name"        => 'categories-create',
                    "description" => 'Crear categoría',
                    "group"       => 'Categorías'
                ],
                [
                    "name"        => 'categories-list',
                    "description" => 'Listar categoría',
                    "group"       => 'Categorías'
                ],
                [
                    "name"        => 'categories-show',
                    "description" => 'Ver categoría',
                    "group"       => 'Categorías'
                ],
                [
                    "name"        => 'categories-update',
                    "description" => 'Actualizar categoría',
                    "group"       => 'Categorías'
                ]
            ];
            $role        = Role::where('name', 'admin')->first();
            foreach ($permisions as  $value) {
                $permission = Permission::firstOrCreate($value);
                $role->givePermissionTo($permission);
            }
            $this->info('Permisos de catgorias creados correctamente');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }

    }
}
