<?php

namespace App\Http\Modules\RolesAndPermissions\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    protected $model;
    function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * Funtion to get all roles.
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->model->select('id', 'name', 'description')
            ->withCount('permissions')
            ->get();
    }

    /**
     * Funtion to get a role by id.
     *
     * @param int $id
     * @return Collection
     */
    public function getById(int $id)
    {
        return $this->model->select('id', 'name', 'description', 'guard_name')->findOrFail($id);
    }

    /**
     * Funtion to get a roles by names.
     *
     * @param int $id
     * @return collection
     */
    public function getRolesByNames(string $name): Collection
    {
        return $this->model->select('*')
            ->where('name', $name)
            ->get();
    }

    /**
     * Funtion created new role.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Funtion to update a role.
     *
     * @param array $data
     * @param int $id
     */
    public function update(array $data)
    {
        return $this->model->update($data);
    }
}
