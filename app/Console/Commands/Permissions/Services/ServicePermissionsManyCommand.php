<?php

namespace App\Console\Commands\Permissions\Services;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ServicePermissionsManyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-permission-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Createa all permissions for services module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Creando permisos de servicios...');
        try {
            $permisions = [
                [
                    'name'        => 'services-module',
                    'description' => 'Módulo de servicios',
                    'group'       => 'Servicios',
                ],
                [
                    "name"        => 'services-create',
                    "description" => 'Crear servicios',
                    "group"       => 'Servicios',
                ],
                [
                    "name"        => 'services-list',
                    "description" => 'Listar servicios',
                    "group"       => 'Servicios',
                ],
                [
                    "name"        => 'services-show',
                    "description" => 'Ver servicios',
                    "group"       => 'Servicios',
                ],
                [
                    "name"        => 'services-destroy',
                    "description" => 'Eliminar servicios',
                    "group"       => 'Servicios',
                ],
                [
                    "name"        => 'services-update',
                    "description" => 'Actualizar servicios',
                    "group"       => 'Servicios',
                ],
                [
                    "name"        => 'services-list-is-active',
                    "description" => 'Listar servicios activos',
                    "group"       => 'Servicios',
                ],
            ];
            $role        = Role::where('name', 'admin')->first();
            foreach ($permisions as  $value) {
                $permission = Permission::firstOrCreate($value);
                $role->givePermissionTo($permission);
            }
            $this->info('Permisos creados correctamente');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
