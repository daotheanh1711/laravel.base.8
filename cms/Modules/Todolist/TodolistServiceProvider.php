<?php

namespace Cms\Modules\Todolist;

use Cms\CmsServiceProvider;
use Illuminate\Routing\Router;

class TodolistServiceProvider extends CmsServiceProvider
{
    public function boot(Router $router)
    {
        parent::boot($router);
    }

	public function register()
	{
	    // Register services and repositories here...
	}
}