@extends('adminlte::page')

@section('title', __('crm.companies'))

@section('content_header')
    <h1>{{ __('crm.companies') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('companies.create') }}" class="btn btn-primary">{{ __('crm.create') }}</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="companies-table">
                <thead>
                    <tr>
                        <th>{{ __('crm.name') }}</th>
                        <th>{{ __('crm.email') }}</th>
                        <th>{{ __('crm.website') }}</th>
                        <th>{{ __('crm.actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('js')
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.1/js/dataTables.fixedColumns.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.1/js/fixedColumns.dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.5/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.5/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        $(function() {
            $('#companies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('companies.index') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'website', name: 'website' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        $(document).on('click', '.btn-delete', function () {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Reload DataTable to reflect the changes
                            $('#companies-table').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while trying to delete the item.',
                                'error'
                                );
                        }
                    });
                }
            });
        });
        

    </script>
@stop