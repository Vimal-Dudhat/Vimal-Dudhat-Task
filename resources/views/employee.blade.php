@extends('layouts.dashboard')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    <div class="x_title row">
                        <div class="col-sm-10">
                            <h2>Employee List</h2>
                        </div>
                        <div class="col-sm-2 align_right">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-employee-modal">Add Employee</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-striped employees-table">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Create Employee Modal -->
    <div id="create-employee-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal form-label-left" method="POST" id="store-employee-form">
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" name="emp_id" hidden>
                                <input type="text" id="first-name" class="form-control" name="first_name">
                                <span id="first_name_error" class="error"></span>
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" id="last-name" name="last_name" class="form-control">
                                <span id="last_name_error" class="error"></span>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="email" id="email" name="email" class="form-control">
                                <span id="email_error" class="error"></span>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="phone" class="col-form-label col-md-3 col-sm-3 label-align">Mobile No.</label>
                            <div class="col-md-9 col-sm-9">
                                <input id="phone" class="form-control" type="number" name="phone">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="company">Company</label>
                            <div class="col-md-9 col-sm-9">
                                <select name="company_id" id="company" class="form-control">

                                    @foreach ( $companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 offset-md-12 align_right">
                            <button class="btn btn-success create-employee">Submit</button>
                            {{-- <input type="submit" class="btn btn-success" value="Submit"> --}}
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection


@push('scripts')
@include("scripts")
    <script>
        
        var columns = [
                    {data: 'id',name: 'id'},
                    {data: 'first_name',name: 'first_name'},
                    {data: 'last_name',name: 'last_name'},
                    {data: 'email',name: 'email'},
                    {data: 'company',name: 'company'},
                    {data: 'phone',name: 'phone'},
                    {data: 'action',name: 'action',orderable: true,searchable: true},
                ];

        deleteData('.delete_employee',"{{ route('employee.delete') }}");

        dataTable('.employees-table',"{{ route('employee.list') }}",columns);

        $(document).on('click','.create-employee',function(e){
            e.preventDefault();
            var formData = $("#store-employee-form").serialize();
            $.ajax({
    
                type:'POST',
                url: "{{ route('employee.store')}}",
                data: formData,
                error: function (data) {

                    var first_name_error = data.responseJSON.errors.first_name ? data.responseJSON.errors.first_name[0] : "";
                    var last_name_error = data.responseJSON.errors.last_name ? data.responseJSON.errors.last_name[0] : "";
                    var email_error = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : "";

                    $("#first_name_error").text(first_name_error);
                    $("#last_name_error").text(last_name_error);
                    $("#email_error").text(email_error);

                    $('#create-employee-modal').modal('show');
                },
                success:function( response ){

                    toastr.success("Employee created successfully.")
                    var employee = response.employee;
                    var html = '<tr role="row" class="odd">'+
                        '<td class="sorting_1">'+employee.id+'</td>'+
                        '<td>'+employee.first_name+'</td>'+
                        '<td>'+employee.last_name+'</td>'+
                        '<td>'+employee.email+'</td>'+
                        '<td>'+response.company+'</td>'+
                        '<td>'+employee.phone+'</td>'+
                        '<td><a class="edit btn btn-primary btn-sm" data-edit_id="'+employee.id+'">Edit</a>'+
                            '<a href="delete/" class="edit btn btn-primary btn-sm" data-delete_id="'+employee.id+'">Delete</a></td>'+
                        '</tr>';
                    
                    $('#create-employee-modal').modal('hide');
                    $(".employees-table").append(html);
                },
            });
        });

        $(document).on('click','.edit_employee',function(){
            var edit_id = $(this).data('edit_id');
            $.ajax({
                type: 'get',
                url: "{{route('employee.edit')}}",
                data: {edit_id: edit_id},
                success: function(response) {
                    var employee = response.employee;
                    var modal = $('#create-employee-modal')
                    modal.modal('show');
                    modal.find('input[name="emp_id"]').val(employee.id);
                    modal.find('input[name="first_name"]').val(employee.first_name);
                    modal.find('input[name="last_name"]').val(employee.last_name);
                    modal.find('input[name="email"]').val(employee.email);
                    modal.find('input[name="phone"]').val(employee.phone);
                    modal.find('#company').val(employee.company_id).attr('selcted','selected');
                    
                    modal.find('.modal-title').text("Update Employee");
                    modal.find('.create-employee').removeClass('create-employee').addClass('update-employee');
                }
            });
        });

        $(document).on('click','.update-employee',function(e){
            e.preventDefault();
            var formData = $("#store-employee-form").serialize();
            $.ajax({
    
                type:'POST',
                url: "{{ route('employee.update')}}",
                data: formData,
                error: function (data) {

                    var first_name_error = data.responseJSON.errors.first_name ? data.responseJSON.errors.first_name[0] : "";
                    var last_name_error = data.responseJSON.errors.last_name ? data.responseJSON.errors.last_name[0] : "";
                    var email_error = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : "";

                    $("#first_name_error").text(first_name_error);
                    $("#last_name_error").text(last_name_error);
                    $("#email_error").text(email_error);

                    $('#create-employee-modal').modal('show');
                },
                success:function( response ){

                    toastr.success("Employee updated successfully.")
                    var employee = response.employee;
                    var tr = $(".employees-table").find("a[data-delete_id='"+employee.id+"']").parents('tr');
                   
                    $('#create-employee-modal').modal('hide');
                    tr.find('td:nth-child(2)').text(employee.first_name);
                    tr.find('td:nth-child(3)').text(employee.last_name);
                    tr.find('td:nth-child(4)').text(employee.email);
                    tr.find('td:nth-child(5)').text(response.company);
                    tr.find('td:nth-child(6)').text(employee.phone);
                },
            });
        });
    </script>
@endpush
