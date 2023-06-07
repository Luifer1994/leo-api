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
            ->select('id', 'name', 'description', 'price', 'category_service_id')
            ->with(['CategoryService' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhereHas('CategoryService', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')
            ->paginate($limit);
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
            ->select('id', 'name', 'description', 'price', 'category_service_id')
            ->with(['CategoryService' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('id', $id)
            ->first();
    }
}
