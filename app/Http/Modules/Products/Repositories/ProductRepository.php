<?php

namespace App\Http\Modules\Products\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Products\Models\Product;

class ProductRepository extends RepositoryBase
{
    protected  $modelProduct;

    public function __construct(Product $modelProduct)
    {
        parent::__construct($modelProduct);
        $this->modelProduct = $modelProduct;
    }


    /**
     * Get all Products.
     *
     * @param  int $limit
     * @param  string $search
     * @return object
     */
    public function getAllProducts(int $limit, string $search): object
    {
        return $this->modelProduct
            ->select('id', 'name', 'description', 'price', 'category_Product_id')
            ->with(['CategoryProduct' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhereHas('CategoryProduct', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    /**
     * Find a Product by id.
     *
     * @param  int $id
     * @return ?Product
     */
    public function findById(int $id): ?Product
    {
        return $this->modelProduct
            ->select('id', 'name', 'description', 'price', 'category_Product_id')
            ->with(['CategoryProduct' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('id', $id)
            ->first();
    }
}
