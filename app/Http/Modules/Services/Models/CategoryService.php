<?php

/**
 * Created by Reliese Model.
 */

namespace App\Http\Modules\Services\Models;

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
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class CategoryService extends Model
{
	protected $table = 'category_services';

	protected $fillable = [
		'name',
		'description'
	];

	public function services()
	{
		return $this->hasMany(Service::class);
	}
}
