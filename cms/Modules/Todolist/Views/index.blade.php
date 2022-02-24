@extends('Todolist::layouts.admin')
 
@section('title', 'Page Todo')
 
@section('content' )

    <div data-listuser="{{ $users }}" data-role="{{ $isAdmin ? 'admin':'user' }}" id="modal-wrapper">
    <!-- Modal -->
    </div>
    <div id="update-complete">
    </div>
    <a href="/admin/todolist/create" class="btn btn-success" >Create</a> 
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Công việc được giao</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Người Làm</th>
            <th scope="col">Công Cụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todolists as $todolist)
            <tr>
            <td>{{ $todolist->id }}</td>
            <td>{{ $todolist->title }}</td>
            <td>{{ $todolist->content }}</td>
            <td>{{ $todolist->user->name }}</td>
            
            <td>
                
                <button data-listid="{{ $todolist->id }}" class="btn btn-primary editId">Edit</button>
                @can('user_delete')
                <form action="/admin/todolist/{{ $todolist->id }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>  
                </form>
                @endcan
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
<script>
   $(".editId").click(function() {
        let listuser = $("#modal-wrapper").data("listuser");
        let listid = $(this).data( "listid" );
        let role = $("#modal-wrapper").attr( "data-role" );
        console.log(role);
        $.ajax({
            url: '/admin/todolist/'+listid,
            method: 'GET',
            success: function (res) {
                var editTodo = res;
                console.log(editTodo);
                var html = `
                <div class="modal fade" id="modalid"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editFrm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập tên" name="title" required value="${editTodo.title}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả <span class="text-danger">*</span></label>
                                <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Nhập mô tả" required >${editTodo.content}</textarea>
                            </div>
                            `;  
                            if (role == 'admin') {   
                                html += `                 
                            <div class="form-group">
                                <label>Người làm<span class="text-danger">*</span></label>
                                <select name="user_id" class="form-control">
                                    `;
                                    
                                    $.each( listuser, function( key, value ) {
                                        if(editTodo.user_id == value.id) {
                                            html += `<option selected value="${value.id}")>${value.name}</option>`;
                                        } else {
                                            html += `<option value="${value.id}")>${value.name}</option>`;
                                        }
                                    });
                                    html += `
                                </select>
                            </div>`;
                            } html += `
                            <button id="btnUpdate" data-listid="${listid}" type="button" class="btn btn-primary">Cập nhật</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                        
                        </div>
                    </div>
                </div>
                `;
                $("#modal-wrapper").html(html);
                $('#modalid').modal('show');
            }
        });
   });

   $(document).on('click', '#btnUpdate', function(){
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let dataform = new FormData($("#editFrm")[0]);
        let listid = $(this).data( "listid" );
        $.ajax({
            url: '/admin/todolist/'+listid,
            method: 'POST',
            data: dataform,
            processData: false,
            contentType: false,
            success: function (res) {     
                var html = `
                <div class="modal fade" id="modalid1"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" role="alert">
                                 Update thành công !!!
                            </div>
                            <button type="button" class="btn btn-secondary" id="update-complete-end" data-dismiss="modal">Done</button>
                        </div>
                        </div>
                    </div>
                </div>
                `;
                $("#update-complete").html(html);
                $('#modalid1').modal('show');
                $('#update-complete-end').click(function() {
                    location.reload();
                });
            }
        });
   });
</script>
@endsection