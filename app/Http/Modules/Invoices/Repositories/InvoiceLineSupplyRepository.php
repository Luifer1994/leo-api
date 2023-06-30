<?php

namespace App\Http\Modules\Invoices\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Invoices\Models\InvoiceLineSupply;

class InvoiceLineSupplyRepository extends RepositoryBase
{
    protected  $InvoiceLineSupplyModel;

    public function __construct(InvoiceLineSupply $InvoiceLineSupplyModel)
    {
        parent::__construct($InvoiceLineSupplyModel);
        $this->InvoiceLineSupplyModel = $InvoiceLineSupplyModel;
    }
}
