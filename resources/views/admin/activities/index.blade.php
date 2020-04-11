@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Aktivitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Aktivitas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <p>
                <a href="{{ url('/dashboard/activities/activities') }}" class="btn btn-primary">
                    Tambahkan Berita
                </a>
            </p>
            <table class="table table-bordered table-striped" id="activities-table" style="width: 100%;">
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
                    $('#activities-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{{ url('dashboard/activities/json') }}',
                        columns: [
                            { data: 'id', name: 'id' },
                            { data: 'title', name: 'title' },
                            {
                                data: 'body',
                                name: 'body',
                                render: function(data, type, row) {
                                    return type === 'display' && data.length > 50 ? data.substr(0, 50) + '...' : data;
                                }
                            },
                            {
                                data: null,
                                render: function(data) {
                                    var edit_btn = '<a href="' + data.edit_url + '" class="btn btn-primary mr-2 mb-1" role="button" aria-pressed="true">Edit</a>';
                                    var delete_btn = '<form class="form-inline mb-1" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Delete</button>';

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
