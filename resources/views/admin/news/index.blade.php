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
                <a href="{{ url('/dashboard/news/create') }}" class="btn btn-primary">
                    Tambahkan Berita
                </a>
            </p>
            <table class="table table-bordered table-striped" id="news-table" style="width: 100%;">
               <thead>
                  <tr>
                     <th style="width: 5%;">Id</th>
                     <th style="width: 30;">Title</th>
                     <th style="width: 50%">Body</th>
                     <th style="width: 15%;">Action</th>
                  </tr>
               </thead>
            </table>
            <script>
                $(function() {
                    $('#news-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{{ url('dashboard/news/json') }}',
                        columns: [
                            { data: 'id', name: 'id' },
                            { data: 'title', name: 'title' },
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
                                    var delete_btn = '<a data-toggle="confirmation" data-singleton="true" data-popout="true" href="' + data.delete_url + '" class="delete btn btn-danger">Delete</a>';

                                    return '<div class="form-inline">' + edit_btn + delete_btn + '</div>'
                                }
                            }
                        ],
                        "language": {
                            "emptyTable": "Berita tidak tersedia"
                        }
                    });
                });
            </script>
        </div>
    </section>
@endsection
