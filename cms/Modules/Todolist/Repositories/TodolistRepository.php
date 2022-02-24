<?php

namespace Cms\Modules\Todolist\Repositories;

use Cms\Modules\Todolist\Models\Todolist;
use Cms\Modules\Todolist\Repositories\Contracts\TodolistRepositoryContract;

class TodolistRepository implements TodolistRepositoryContract
{

    protected $model;

    public function __construct(Todolist $todolist)
    {
        $this->model = $todolist;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function allByUserId($id)
    {
        return $this->model->where('user_id', $id)->get();
    }


    public function delete($id)
    {   
        $this->model->destroy($id);
    }

    public function detail($id)
    {   
        $users = $this->model->with('user')->where('id', $id)->get();
        if (count($users) == 0) {
            return null;
        } else {
            return $users[0];
        }
    }

    public function update($id, $data)
    {   
        return $this->model->where('id', $id)->update($data);
    }
    
}
