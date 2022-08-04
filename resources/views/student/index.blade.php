@extends('student.layouts')
@section('content')
<!-- add student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul id="saveFormErrorList"></ul>
        <div class="form-group mb-3">
            <lable for="first_name">First Name:</lable>
            <input class="first_name form-control" name = "first_name" type="text"/>
        </div>
        <div class="form-group mb-3">
            <lable for="last_name">Last Name:</lable>
            <input class="last_name form-control" name = "last_name" type="text"/>
        </div>
        <div class="form-group mb-3">
            <lable for="email">Email:</lable>
            <input class="email form-control" type="email"/>
        </div>
        <div class="form-group mb-3">
            <lable for="course">Course:</lable>
            <input class="course form-control" name = "course" type="text"/>
        </div>
        <div class="form-group mb-3">
            <lable for="phone">Phone:</lable>
            <input class="phone form-control" name = "phone" type="text"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_student">Save </button>
      </div>
    </div>
  </div>
</div>
<!-- End of add student -->

<!-- Edit student modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit and Update Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul id="updateform_errorlist"></ul>
        <input type="hidden" id="edit_stud_id" />
        <div class="form-group mb-3">
            <lable for="first_name">First Name:</lable>
            <input class="first_name form-control" id = "edit_first_name" type="text"/>
        </div>
        <div class="form-group mb-3">
            <lable for="last_name">Last Name:</lable>
            <input class="last_name form-control" id = "edit_last_name" type="text"/>
        </div>
        <div class="form-group mb-3">
            <lable for="email">Email:</lable>
            <input class="email form-control" type="email" id="edit_email"/>
        </div>
        <div class="form-group mb-3">
            <lable for="course">Course:</lable>
            <input class="course form-control" id = "edit_course" type="text"/>
        </div>
        <div class="form-group mb-3">
            <lable for="phone">Phone:</lable>
            <input class="phone form-control" id = "edit_phone" type="text"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_student">Update </button>
      </div>
    </div>
  </div>
</div>
<!-- End of edit student modal -->

<!-- Delete student modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="delete_stud_id" />
       <h4>Are you sure want to delete data?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary delete_student_btn">Yes Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End delete student model -->

<div class="container py-5">
    <div class="row">
        <div class="col md-12">
            <div id="successMessage"></div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        student Data 
                        <a class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add new</a>
                    </h4>
                </div>
                <div class="card-body">
                <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                           
                        
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>


    $(document).ready(function(){

        fetchstudent();

        function fetchstudent()
        {
            $.ajax({
                type: 'get',
                url: 'fetch-students',
                dataType: 'json',
                success: function(response){
                    // console.log(response.students);
                    $('tbody').html("");
                    $.each(response.students, function(key, student){
                        $('tbody').append('<tr>\
                            <td>'+student.id+'</td>\
                            <td>'+student.fname+' '+student.lname+'</td>\
                            <td>'+student.email+'</td>\
                            <td>'+student.phone+'</td>\
                            <td>'+student.course+'</td>\
                            <td><button type="button" value="'+student.id+'" class="edit_student btn btn-primary btn-sm">Edit</button></td>\
                            <td><button type="button" value="'+student.id+'" class="delet_student btn btn-danger btn-sm">Delete</button></td>\
                            </tr>');
                    });
                }
            });
        }

        $(document).on('click', '.delet_student', function(e){
            e.preventDefault();
            var stud_id = $(this).val();
            $('#delete_stud_id').val(stud_id);
            $('#deleteStudentModal').modal('show');
        });
        
        $(document).on('click', '.delete_student_btn', function(e){
            e.preventDefault();
            var stud_id = $('#delete_stud_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({    
                type: 'DELETE',
                url: '/delete-students/'+stud_id,
                success: function(response){
                    // console.log(response);
                    $('#successMessage').addClass('alert alert-success');
                    $('#successMessage').text(response.message);
                    $('#deleteStudentModal').modal('hide');
                    fetchstudent();

                }
            });

        });

        $(document).on('click', '.edit_student', function(e){
            e.preventDefault();
            var stud_id = $(this).val();
            // console.log(stud_id);
            $('#editStudentModal').modal('show');
            $.ajax({    
                type: 'get',
                url: '/edit-students/'+stud_id,
                success: function(response){
                    // console.log(response);
                    if(response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }else{
                        $('#edit_first_name').val(response.student.fname);
                        $('#edit_last_name').val(response.student.lname);
                        $('#edit_email').val(response.student.email);
                        $('#edit_phone').val(response.student.phone);
                        $('#edit_course').val(response.student.course);
                        $('#edit_stud_id').val(stud_id);
                    }
                }
                });
        });

        $(document).on('click', '.update_student', function(e){
            e.preventDefault();
            var stud_id = $('#edit_stud_id').val();
            var data = {    
                'first_name' : $('#edit_first_name').val(),
                'last_name' : $('#edit_last_name').val(),
                'email' : $('#edit_email').val(),
                'phone' : $('#edit_phone').val(),
                'course' : $('#edit_course').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: '/update-student/'+ stud_id,
                data: data,
                dataType: 'json',
                success: function(response){
                    // console.log(response);
                    if(response.status == 400){
                        $('#updateform_errorlist').html("");
                        $('#updateform_errorlist').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values){
                        $('#updateform_errorlist').append('<li>'+err_values+'</li>');
                        });
                    }else if(response.status == 404){
                        $('#updateform_errorlist').html("");
                        $('#successMessage').addClass('alert alert-success');
                        $('#successMessage').text(response.message);

                    }else{
                        $('#updateform_errorlist').html("");
                        $('#successMessage').html("");
                        $('#successMessage').addClass('alert alert-success');
                        $('#successMessage').text(response.message);
                        $('#editStudentModal').modal('hide');
                         fetchstudent();
                    }
                }
            });

        });
        $(document).on('click', '.add_student',function(e){
            e.preventDefault();
            var data = {
                'first_name': $('.first_name').val(),
                'last_name': $('.last_name').val(),
                'email': $('.email').val(),
                'phone': $('.phone').val(),
                'course': $('.course').val()
            }
            // console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/students',
                data: data,
                dataType: 'json',
                success: function(response){
                    // console.log(response);
                    if(response.status == 400){
                        $('#saveFormErrorList').html("");
                        $('#saveFormErrorList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values){
                        $('#saveFormErrorList').append('<li>'+err_values+'</li>');
                        });
                    }else{
                        $('#saveFormErrorList').html("");
                        $('#successMessage').addClass('alert alert-success');
                        $('#successMessage').text(response.message);
                        $('#addStudentModal').modal('hide');
                        $('#addStudentModal').find('input').val("");
                        fetchstudent();
                    }
                }

            });
        });
    });
</script>

@endsection