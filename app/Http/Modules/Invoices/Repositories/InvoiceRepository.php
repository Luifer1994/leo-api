<?php

namespace App\Http\Modules\Invoices\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Invoices\Models\Invoice;
use Illuminate\Support\Str;

class InvoiceRepository extends RepositoryBase
{
    protected  $InvoiceModel;

    public function __construct(Invoice $InvoiceModel)
    {
        parent::__construct($InvoiceModel);
        $this->InvoiceModel = $InvoiceModel;
    }

    /**
     * Get all Invoices.
     *
     * @param int $limit
     * @param string $search
     * @return object
     * @author Luifer Almendrales
     */
    public function getAllInvoices(int $limit, string $search): object
    {
        return $this->InvoiceModel
            ->select('id','code','client_id','user_id')
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    /**
     * Create unique code.
     *
     * @return string
     */
    public function createUniqueCode(): string
    {
        $code = Str::upper(Str::random(8));
        $codeExist = $this->InvoiceModel->where('code', $code)->first();

        if ($codeExist)
            return $this->createUniqueCode();

        return $code;
    }
}
