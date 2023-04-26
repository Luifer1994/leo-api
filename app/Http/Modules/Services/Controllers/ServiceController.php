<?php

namespace App\Http\Modules\Services\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Bases\PaginateBaseRequest;
use App\Http\Modules\Services\Repositories\ServiceRepository;
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
}
