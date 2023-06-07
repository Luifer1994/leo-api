<?php

namespace App\Http\Modules\Categories\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Categories\Repositories\CategoryServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryServiceController extends Controller
{
    protected $CategoryServiceRepository;

    public function __construct(CategoryServiceRepository $CategoryServiceRepository)
    {
        $this->CategoryServiceRepository = $CategoryServiceRepository;
    }

    /**
     * Get all categories services.
     *
     * @param  Request $request
     * @return JsonResponse
     * @author Luifer Almendrales
     */
    public function all(): JsonResponse
    {
        try {

            return $this->successResponse($this->CategoryServiceRepository->all(), 'Ciudades listadas con exito!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Error al listar ciudades', Response::HTTP_BAD_REQUEST);
        }
    }
}
