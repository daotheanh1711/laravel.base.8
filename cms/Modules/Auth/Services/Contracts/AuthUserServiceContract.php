<?php

namespace Cms\Modules\Auth\Services\Contracts;

use Cms\Modules\Core\Services\Contracts\CoreUserServiceContract;

interface AuthUserServiceContract extends CoreUserServiceContract
{
    public function getUser($id);

    public function getAllUsers();
}
