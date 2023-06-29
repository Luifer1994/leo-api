<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

/**
 * Class InvoiceLine
 *
 * @property int $id
 * @property float $price
 * @property float $percentage
 * @property int $quantity
 * @property int $invoice_id
 * @property int $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Invoice $Invoice
 * @property Service $Service
 * @property Collection|InvoiceLineSupply[] $InvoiceLineSupply
 *
 * @package App\Models
 */
class InvoiceLine extends Model implements AuditableContract
{
    use Auditable, HasFactory;

    protected $table = 'invoice_lines';

	protected $casts = [
		'price' => 'float',
		'percentage' => 'float',
		'quantity' => 'int',
		'invoice_id' => 'int',
		'service_id' => 'int'
	];

	protected $fillable = [
		'price',
		'percentage',
		'quantity',
		'invoice_id',
		'service_id'
	];

    /**
     * Relation to Invoice.
     *
     * @return BelongsTo
     */
	public function Invoice():BelongsTo
	{
		return $this->belongsTo(Invoice::class);
	}

    /**
     * Relation to Service.
     *
     * @return BelongsTo
     */
	public function Service():BelongsTo
	{
		return $this->belongsTo(Service::class);
	}

    /**
     * Relation to InvoiceLineSupply.
     *
     * @return HasMany
     */
	public function InvoiceLineSupplies():HasMany
	{
		return $this->hasMany(InvoiceLineSupply::class);
	}
}
