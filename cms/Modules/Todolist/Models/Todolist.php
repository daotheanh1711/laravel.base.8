<?php

namespace Cms\Modules\Todolist\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cms\Modules\Core\Models\User;

class Todolist extends Model
{
    protected $fillable = ['title', 'content' ,'user_id'];

    public function user() {

        return $this->belongsTo(User::class);
    }
}

