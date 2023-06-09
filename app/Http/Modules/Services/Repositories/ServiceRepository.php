<?php

namespace App\Http\Modules\Services\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Services\Models\Service;

class ServiceRepository extends RepositoryBase
{
    protected  $modelService;

    public function __construct(Service $modelService)
    {
        parent::__construct($modelService);
        $this->modelService = $modelService;
    }


    /**
     * Get all services.
     *
     * @param  int $limit
     * @param  string $search
     * @return object
     */
    public function getAllServices(int $limit, string $search): object
    {
        return $this->modelService
            ->select('id', 'name', 'description', 'is_active')
            ->where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    /**
     * Get all services is active.
     *
     * @param  string $search
     * @return object
     */
    public function getAllServicesIsActive(string $search): object
    {
        return $this->modelService
            ->select('id', 'name', 'description', 'is_active')
            ->where('is_active', true)
            ->where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * Find a service by id.
     *
     * @param  int $id
     * @return ?Service
     */
    public function findById(int $id): ?Service
    {
        return $this->modelService
            ->select('id', 'name', 'description', 'is_active')
            ->where(['id' => $id])
            ->first();
    }
}
