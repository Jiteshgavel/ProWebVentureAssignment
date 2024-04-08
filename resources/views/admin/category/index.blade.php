@extends('layout.admin')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12">
                     <a class="btn btn-secondary  my-3" href="{{ route('exportCategories') }}" >Export Categories</a>
                    <a class="btn btn-success float-right my-3" href="javascript:void(0)" id="createNewCategory"> Create New Category</a>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="categoryForm" name="categoryForm" class="form-horizontal">
                                <input type="hidden" name="category_id" id="category_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="" maxlength="50" required="">
                                             <span class="error text-danger d-none"></span>
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                        changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('add-js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {

            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createNewCategory').click(function() {
                $('#saveBtn').val("create-category");
                $('#category_id').val('');
                 $('#saveBtn').html('Save Changes');
                $('#categoryForm').trigger("reset");
                $('#modelHeading').html("Create New Category");
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editCategory', function() {
                var category_id = $(this).data('id');
                $.get("{{ route('category.index') }}" + '/' + category_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Category");
                    $('#saveBtn').val("edit-user");
                     $('#saveBtn').html('Save Changes');
                    $('#ajaxModel').modal('show');
                    $('#category_id').val(data.id);
                    $('#name').val(data.name);
                    $('#detail').val(data.detail);
                })
            });

            /*------------------------------------------
            --------------------------------------------
            Create  Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#categoryForm').serialize(),
                    url: "{{ route('category.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#categoryForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                          $.each(data.responseJSON.errors, function (key, value) {
                            $("#" + key).addClass('is-invalid');
                            $("#" + key).next().html(value[0]);
                            $("#" + key).next().removeClass('d-none');
                        });
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            Delete  Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteCategory', function() {

                var category_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('category.store') }}" + '/' + category_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });

        $('#ajaxModel').on('hidden.bs.modal', function () {
            $('.error').text('');
            $('.form-control').removeClass('is-invalid');
            $('#saveBtn').html('Save Changes');
        });
    </script>
@endpush
