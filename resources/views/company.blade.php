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
                            <h2>Company List</h2>
                        </div>
                        <div class="col-sm-2 align_right">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-company-modal">Add Company</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-striped companies-table">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Logo</th>
                                <th>Contact</th>
                                <th>Address</th>
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

    <!--Create company Modal -->
    <div id="create-company-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create company</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal form-label-left" method="POST" id="store-company-form">
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" name="company_id" hidden>
                                <input type="text" id="name" class="form-control" name="name">
                                <span id="name_error" class="error"></span>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="email" id="email" name="email" class="form-control">
                                <span id="email_error" class="error"></span>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Website</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" id="website" name="website" class="form-control">
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Logo</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="file" id="logo" name="logo" class="form-control">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label for="contact" class="col-form-label col-md-3 col-sm-3 label-align">Contact</label>
                            <div class="col-md-9 col-sm-9">
                                <input id="contact" class="form-control" type="number" name="contact">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="address" class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
                            <div class="col-md-9 col-sm-9">
                                <input id="address" class="form-control" type="text" name="address">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 offset-md-12 align_right">
                            <button class="btn btn-success create-company">Submit</button>
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
                    {data: 'name',name: 'name'},
                    {data: 'email',name: 'email'},
                    {data: 'website',name: 'website'},
                    {data: 'logo',name: 'logo'},
                    {data: 'contact',name: 'contact'},
                    {data: 'address',name: 'address'},
                    {data: 'action',name: 'action',orderable: true,searchable: true},
                ];

        deleteData('.delete_company',"{{ url('api/company/delete') }}");

        dataTable('.companies-table',"{{ url('api/company/list') }}",columns);

        $(document).on('click','.create-company',function(e){
            e.preventDefault();
            var formData = $("#store-company-form").serialize();
            $.ajax({
    
                type:'POST',
                url: "{{ url('api/company/store')}}",
                data: formData,
                
                // cache:false,
                // contentType: false,
                // processData: false,
                error: function (data) {

                    console.log(data.responseJSON);
                    var name_error = data.responseJSON.errors.name ? data.responseJSON.errors.name[0] : "";
                    var email_error = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : "";

                    $("#name_error").text(name_error);
                    $("#email_error").text(email_error);

                    $('#create-company-modal').modal('show');
                },
                success:function( response ){

                    toastr.success("company created successfully.")
                    var company = response.company;
                    var html = '<tr role="row" class="odd">'+
                        '<td class="sorting_1">'+company.id+'</td>'+
                        '<td>'+company.name+'</td>'+
                        '<td>'+company.website+'</td>'+
                        '<td>'+company.email+'</td>'+
                        '<td>'+company.contact+'</td>'+
                        '<td>'+company.address+'</td>'+
                        '<td><a class="edit btn btn-primary btn-sm" data-edit_id="'+company.id+'">Edit</a>'+
                            '<a href="delete/" class="edit btn btn-primary btn-sm" data-delete_id="'+company.id+'">Delete</a></td>'+
                        '</tr>';
                    
                    $('#create-company-modal').modal('hide');
                    $(".companies-table").append(html);
                },
            });
        });

        $(document).on('click','.edit_company',function(){
            var edit_id = $(this).data('edit_id');
            $.ajax({
                type: 'get',
                url: "{{url('api/company/edit')}}",
                data: {edit_id: edit_id},
                success: function(response) {
                    var company = response.company;
                    var modal = $('#create-company-modal')
                    modal.modal('show');
                    modal.find('input[name="company_id"]').val(company.id);
                    modal.find('input[name="name"]').val(company.name);
                    modal.find('input[name="email"]').val(company.email);
                    modal.find('input[name="website"]').val(company.website);
                    modal.find('input[name="contact"]').val(company.contact);
                    modal.find('input[name="address"]').val(company.address);
                    
                    modal.find('.modal-title').text("Update company");
                    modal.find('.create-company').removeClass('create-company').addClass('update-company');
                }
            });
        });

        $(document).on('click','.update-company',function(e){
            e.preventDefault();
            var formData = $("#store-company-form").serialize();
            $.ajax({
    
                type:'POST',
                url: "{{ url('api/company/update')}}",
                data: formData,
                error: function (data) {

                    var name_error = data.responseJSON.errors.name ? data.responseJSON.errors.name[0] : "";
                    var email_error = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : "";

                    $("#name_error").text(name_error);
                    $("#email_error").text(email_error);

                    $('#create-company-modal').modal('show');
                },
                success:function( response ){

                    toastr.success("company updated successfully.")
                    var company = response.company;
                    var tr = $(".companies-table").find("a[data-delete_id='"+company.id+"']").parents('tr');
                   
                    $('#create-company-modal').modal('hide');
                    tr.find('td:nth-child(2)').text(company.name);
                    tr.find('td:nth-child(3)').text(company.email);
                    tr.find('td:nth-child(4)').text(company.website);
                    tr.find('td:nth-child(5)').text(response.company);
                    tr.find('td:nth-child(6)').text(company.contact);
                    tr.find('td:nth-child(7)').text(company.address);
                },
            });
        });
    </script>
@endpush
