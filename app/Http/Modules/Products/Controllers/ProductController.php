<?php

namespace App\Http\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Bases\PaginateBaseRequest;
use App\Http\Modules\Products\Models\Product;
use App\Http\Modules\Products\Repositories\ProductRepository;
use App\Http\Modules\Products\Requests\CreateOrUpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    /**
     * Get all Products.
     *
     * @param  PaginateBaseRequest $request
     * @return JsonResponse
     */
    public function index(PaginateBaseRequest $request): JsonResponse
    {
        try {
            $limit    = $request->limit ?? 10;
            $search   = $request->search ?? '';
            $Products = $this->ProductRepository->getAllProducts($limit, $search);
            return $this->successResponse($Products, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Product by id.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $Product = $this->ProductRepository->findById($id);
            return $this->successResponse($Product, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a new Product.
     *
     * @param  CreateOrUpdateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrUpdateProductRequest $request): JsonResponse
    {
        try {
            $newProduct = new Product($request->all());
            $Product    = $this->ProductRepository->save($newProduct);
            return $this->successResponse($Product, 'Servicio registrado con éxito', Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Product by id.
     *
     * @param  CreateOrUpdateProductRequest $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(CreateOrUpdateProductRequest $request, int $id): JsonResponse
    {
        try {
            $Product = $this->ProductRepository->findById($id);
            if (!$Product)
                return $this->errorResponse('¡El servicio no existe!', Response::HTTP_NOT_FOUND);

            $Product->fill($request->all());
            $Product = $this->ProductRepository->save($Product);
            return $this->successResponse($Product, 'Servicio actualizado con éxito', Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
