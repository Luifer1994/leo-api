<?php

namespace App\Http\Modules\Users\Repositories;

use App\Http\Modules\Bases\RepositoryBase;
use App\Http\Modules\Users\Models\User;

use function PHPSTORM_META\map;

class UserRepository extends RepositoryBase
{
    protected  $userModel;

    public function __construct(User $userModel)
    {
        parent::__construct($userModel);
        $this->userModel = $userModel;
    }

    /**
     * Get all users
     *
     * @param  Object $request
     * @return Object
     * @author Luifer Almendrales
     */
    public function getAllUsers(array $request): Object
    {
        return $this->userModel->select([
            'users.id', 'users.name', 'users.last_name', 'users.email',
            'users.is_active', 'users.document', 'users.phone', 'users.cell_phone',
            'users.gender', 'users.address'
        ])
            ->when(isset($request['searchQuery']), function ($filter) use ($request) {
                $filter->where('users.name', 'like', '%' . $request['searchQuery'] . '%')
                    ->orWhere('users.document', 'like', '%' . $request['searchQuery'] . '%')
                    ->orWhere('users.email', 'like', '%' . $request['searchQuery'] . '%');
            })
            ->orderBy('users.created_at', 'desc')
            ->paginate(5);
    }
}
