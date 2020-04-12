@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Berita</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <p>
                <a href="{{ url('/dashboard/about/create') }}" class="btn btn-primary">
                    Tambahkan About Page
                </a>
            </p>
            <table class="table table-bordered table-striped" id="about-table" style="width: 100%;">
               <thead>
                  <tr>
                     <th style="width: 5%;">Id</th>
                     <th style="width: 30;">Type</th>
                     <th style="width: 45%">Body</th>
                     <th style="width: 20%;">Action</th>
                  </tr>
               </thead>
            </table>
        </div>
    </section>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Hapus Data ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete-modal-btn" data-dismiss="modal">Delete</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#about-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                ajax: '{{ url('dashboard/about/json') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'type', name: 'type' },
                    {
                        data: 'body',
                        name: 'body',
                        render: function(data, type, row) {
                            return type === 'display' && data.length > 50 ? stripHtml(data.substr(0, 50)) + '...' : stripHtml(data);
                        }
                    },
                    {
                        data: null,
                        name: 'action',
                        render: function(data) {
                            var edit_btn = '<a href="' + data.edit_url + '" class="btn btn-primary mr-2 mb-1" role="button" aria-pressed="true">Edit</a>';
                            var delete_btn = '<button class="btn btn-delete btn-danger mb-1" data-remote="'+ data.delete_url +'" data-toggle="modal" data-target="#deleteModal">Delete</button>';

                            return '<div class="form-inline">' + edit_btn + delete_btn + '</div>'
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                "language": {
                    "emptyTable": "Tidak ada about page. Buat about page baru"
                }
            });

            $('#about-table').DataTable().on('click', '.btn-delete[data-remote]' ,function (e) {
                e.preventDefault();
                var url = $(this).data('remote');
                $('.delete-modal-btn').on('click',function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            method: '_DELETE'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).always(function (data) {
                        $('#about-table').DataTable().draw(false);
                    });
                });
            });
        });
    </script>
@endsection
