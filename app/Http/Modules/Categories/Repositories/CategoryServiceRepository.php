<?php

namespace App\Http\Modules\Categories\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Categories\Models\CategoryService;

class CategoryServiceRepository extends RepositoryBase
{
    protected  $CategoryServiceModel;

    public function __construct(CategoryService $CategoryServiceModel)
    {
        parent::__construct($CategoryServiceModel);
        $this->CategoryServiceModel = $CategoryServiceModel;
    }

    /**
     * Get all Categories Services.
     *
     * @return object
     * @author Luifer Almendrales
     */
    public function all(): object
    {
        return $this->CategoryServiceModel->select('id', 'name', 'description')->get();
    }
}
