<?php

namespace App\Http\Modules\Categories\Models;

use App\Http\Modules\Services\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

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
class CategoryService extends Model implements AuditableContract
{
    use Auditable;
    protected $table = 'category_services';

    protected $fillable = [
        'name',
        'description'
    ];

    public function services():HasMany
    {
        return $this->hasMany(Service::class);
    }
}
