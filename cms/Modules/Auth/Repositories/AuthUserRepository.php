<?php

namespace Cms\Modules\Auth\Repositories;

use Cms\Modules\Core\Models\User;
use Cms\Modules\Auth\Repositories\Contracts\AuthUserRepositoryContract;
use Cms\Modules\Core\Repositories\CoreUserRepository;

class AuthUserRepository extends CoreUserRepository implements AuthUserRepositoryContract
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    
    public function getUser($id)
    {
        
        
    }

    public function getAllUsers()
    {   
        return $this->model->role('user')->get();
    }
}
