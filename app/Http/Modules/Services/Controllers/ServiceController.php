<?php

namespace App\Http\Modules\Services\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Bases\PaginateBaseRequest;
use App\Http\Modules\Services\Models\Service;
use App\Http\Modules\Services\Repositories\ServiceRepository;
use App\Http\Modules\Services\Requests\CreateOrUpdateServiceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Get all services.
     *
     * @param  PaginateBaseRequest $request
     * @return JsonResponse
     */
    public function index(PaginateBaseRequest $request): JsonResponse
    {
        try {
            $limit    = $request->limit ?? 10;
            $search   = $request->search ?? '';
            $services = $this->serviceRepository->getAllServices($limit, $search);
            return $this->successResponse($services, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get service by id.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $service = $this->serviceRepository->findById($id);
            return $this->successResponse($service, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a new service.
     *
     * @param  CreateOrUpdateServiceRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrUpdateServiceRequest $request): JsonResponse
    {
        try {
            $newService = new Service($request->all());
            $service    = $this->serviceRepository->save($newService);
            return $this->successResponse($service, 'Servicio registrado con éxito', Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update service by id.
     *
     * @param  CreateOrUpdateServiceRequest $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(CreateOrUpdateServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = $this->serviceRepository->findById($id);
            if (!$service)
                return $this->errorResponse('¡El servicio no existe!', Response::HTTP_NOT_FOUND);

            $service->fill($request->all());
            $service = $this->serviceRepository->save($service);
            return $this->successResponse($service, 'Servicio actualizado con éxito', Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
