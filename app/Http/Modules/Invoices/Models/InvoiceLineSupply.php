<?php

namespace App\Http\Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

/**
 * Class InvoiceLineSupply
 *
 * @property int $id
 * @property string $description
 * @property float $price
 * @property float $percentage_tax
 * @property int $quantity
 * @property int $invoice_line_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property InvoiceLine $InvoiceLine
 */
class InvoiceLineSupply extends Model implements AuditableContract
{
    use Auditable, HasFactory;

    protected $table = 'invoice_line_supplies';

	protected $casts = [
		'price' => 'float',
		'percentage_tax' => 'float',
		'quantity' => 'int',
		'invoice_line_id' => 'int'
	];

	protected $fillable = [
		'description',
		'price',
		'percentage_tax',
		'quantity',
		'invoice_line_id'
	];

    /**
     * Relation to InvoiceLine.
     *
     * @return BelongsTo
     */
	public function InvoiceLine():BelongsTo
	{
		return $this->belongsTo(InvoiceLine::class);
	}
}
