@extends('Todolist::layouts.admin')
 
@section('title', 'Page Create Todo')
 
@section('content')
<div class="container" id="app">
    <h1 class="text-center">Create Công Việc</h1>
    <form action="/admin/todolist" method="post" ref="createPostForm">
      @csrf
      <div class="form-group">
        <label for="title">Tên Công Việc<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter tên công việc" require>
      </div>
      <div class="form-group">
        <label for="content">Nội dung công việc <span class="text-danger">*</span></label>
        <textarea name="content" id="content" class="form-control" cols="30" rows="10" placeholder="Enter nội dung" require></textarea>
      </div>
      <div class="form-group">
        <label>Phân công <span class="text-danger">*</span></label>
        <select name="user_id" class="form-control">
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
  </div>
@endsection