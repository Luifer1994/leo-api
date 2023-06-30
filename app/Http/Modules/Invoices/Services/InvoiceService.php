<?php

namespace App\Http\Modules\Invoices\Services;

use App\Http\Modules\Invoices\Models\Invoice;
use App\Http\Modules\Invoices\Models\InvoiceLine;
use App\Http\Modules\Invoices\Models\InvoiceLineSupply;
use App\Http\Modules\Invoices\Repositories\InvoiceLineRepository;
use App\Http\Modules\Invoices\Repositories\InvoiceLineSupplyRepository;
use App\Http\Modules\Invoices\Repositories\InvoiceRepository;
use App\Http\Modules\Invoices\Requests\CreateOrUpdateInvoiceRequest;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    protected $InvoiceRepository;
    protected $InvoiceLineRepository;
    protected $InvoiceLineSupplyRepository;

    public function __construct(InvoiceRepository $InvoiceRepository, InvoiceLineRepository $InvoiceLineRepository, InvoiceLineSupplyRepository $InvoiceLineSupplyRepository)
    {
        $this->InvoiceRepository           = $InvoiceRepository;
        $this->InvoiceLineRepository       = $InvoiceLineRepository;
        $this->InvoiceLineSupplyRepository = $InvoiceLineSupplyRepository;
    }

    /**
     * Create new invoices.
     *
     * @param CreateOrUpdateInvoiceRequest $request
     * @return object
     */
    function CreateInvoice(CreateOrUpdateInvoiceRequest $request): object
    {
        try {
            DB::beginTransaction();

            $requestData = [
                'code' => $this->InvoiceRepository->createUniqueCode(),
                'user_id' => auth()->user()->id,
                'client_id' => $request->client_id,
            ];

            $invoice = $this->InvoiceRepository->save(new Invoice($requestData));

            foreach ($request->invoice_lines as $invoiceLineData) {
                $invoiceLine = new InvoiceLine($invoiceLineData);
                $invoiceLine->invoice_id = $invoice->id;
                $invoiceLine->percentage_tax = (float) env('PORCENTAGE_TAX');
                $invoiceLine = $this->InvoiceLineRepository->save($invoiceLine);

                if (isset($invoiceLineData['invoice_line_supplies'])) {
                    foreach ($invoiceLineData['invoice_line_supplies'] as $invoiceLineSupplyData) {
                        $invoiceLineSupply = new InvoiceLineSupply($invoiceLineSupplyData);
                        $invoiceLineSupply->invoice_line_id = $invoiceLine->id;
                        $invoiceLineSupply->percentage_tax = (float) env('PORCENTAGE_TAX');
                        $this->InvoiceLineSupplyRepository->save($invoiceLineSupply);
                    }
                }
            }

            DB::commit();

            return (object) [
                'status' => true,
                'message' => 'Factura creada con éxito',
                'data' => $invoice
            ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return (object) [
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ];
        }

    }
}
