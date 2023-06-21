<?php

/**
 * Created by Reliese Model.
 */

 namespace App\Http\Modules\Products\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string|null $description
 * @property float $price
 * @property int $category_Product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CategoryProduct $category_Product
 *
 * @package App\Models
 */
class Product extends Model implements AuditableContract
{
    use Auditable;
	protected $table = 'products';

	protected $casts = [
		'is_active' => 'bool',
	];

	protected $fillable = [
		'name',
		'is_active',
		'description',
	];
}
