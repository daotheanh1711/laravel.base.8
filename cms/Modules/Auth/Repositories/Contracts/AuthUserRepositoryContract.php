<?php

namespace Cms\Modules\Auth\Repositories\Contracts;

use Cms\Modules\Core\Repositories\Contracts\CoreUserRepositoryContract;

interface AuthUserRepositoryContract extends CoreUserRepositoryContract
{
    public function getUser($id);

    public function getAllUsers();
}
