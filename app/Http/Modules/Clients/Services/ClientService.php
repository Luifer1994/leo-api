<?php

namespace App\Http\Modules\Clients\Services;

use App\Http\Modules\Clients\Repositories\ClientRepository;
use Illuminate\Http\Response;

class ClientService
{

    private $ClientRepository;

    public function __construct(ClientRepository $ClientRepository)
    {
        $this->ClientRepository = $ClientRepository;
    }
}
