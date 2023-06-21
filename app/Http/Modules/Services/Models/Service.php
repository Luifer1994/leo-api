<?php

/**
 * Created by Reliese Model.
 */

 namespace App\Http\Modules\Services\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

/**
 * Class Service
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string|null $description
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CategoryService $category_service
 *
 * @package App\Models
 */
class Service extends Model implements AuditableContract
{
    use Auditable;
	protected $table = 'services';

	protected $casts = [
		'is_active' => 'bool',
	];

	protected $fillable = [
		'name',
		'is_active',
		'description'
	];
}
