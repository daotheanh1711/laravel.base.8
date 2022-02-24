<?php

namespace Cms\Modules\Todolist\Controllers;
use Cms\Modules\Core\Models\Role;
use Cms\Modules\Core\Models\Permission;
use Cms\Modules\Auth\Repositories\Contracts\AuthUserRepositoryContract;
use App\Http\Controllers\Controller;
use Cms\Modules\Todolist\Requests\TodolistRequestRequest;
use Cms\Modules\Todolist\Repositories\TodolistRepository;

use Illuminate\Http\Request;

class TodolistController extends Controller
{   
    
  

    public function index(TodolistRepository $todolistRepository,AuthUserRepositoryContract $authUserReponsitoryContract)
    {   
        $isAdmin = auth()->user()->hasRole('admin');
        $users = null;
        if ($isAdmin) {
            $todolists = $todolistRepository->all();
            $users = $authUserReponsitoryContract->getAllUsers();
        } else {
            $todolists = $todolistRepository->allByUserId(auth()->user()->id);
        }

        return view('Todolist::index', ['todolists' => $todolists , 'users' => $users ,'isAdmin' => $isAdmin]);
    }

    public function create(AuthUserRepositoryContract $authUserReponsitoryContract)
    {
        $users = $authUserReponsitoryContract->getAllUsers();
        return view('Todolist::create' , ['users' => $users]);
    }

    public function save(TodolistRequestRequest $request, TodolistRepository $todolistRepository , AuthUserRepositoryContract $authUserReponsitoryContract)
    {
        $validatedData = $request->validated();
        $todolistRepository->store($validatedData);
        return redirect()->route('todolist.index');
    }

    public function delete(TodolistRepository $todolistRepository ,$id)
    {   
        $todolistRepository->delete($id);
        return redirect()->route('todolist.index');
    }

    public function detail(TodolistRepository $todolistRepository ,$id)
    {
        $todolist = $todolistRepository->detail($id);
        if($todolist){
            return $todolist;
        }
        abort(404);
    }

    public function update(TodolistRequestRequest $request, TodolistRepository $todolistRepository ,$id)
    {
        $validatedData = $request->validated();
        $result = $todolistRepository->update($id, $validatedData);
        return $result;
    }
    
    
    public function indexTest(TodolistRepository $todolistRepository,AuthUserRepositoryContract $authUserReponsitoryContract)
    {   
        
        $users = $authUserReponsitoryContract->getAllUsers();
        $todolists = $todolistRepository->all();
        return view('Todolist::index', ['todolists' => $todolists , 'users' => $users ]);
    }
    
}