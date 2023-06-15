<?php

/**
 * Created by Reliese Model.
 */

namespace App\Http\Modules\Products\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryService
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Service[] $Products
 *
 * @package App\Models
 */
class CategoryProduct extends Model
{
	protected $table = 'category_products';

	protected $fillable = [
		'name',
		'description'
	];

	public function Products()
	{
		return $this->hasMany(Service::class);
	}
}
