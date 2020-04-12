@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Informasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard/information') }}">
                                Informasi
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Edit Informasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ url('dashboard/information/update/' . $info->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="type" value="info">

                <div class="form-group">
                    <div class="col-md-12">
                            <textarea name="body" class="form-control my-editor mx-auto" style="min-height: 512px">
                                {{ $info->body }}
                            </textarea>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Simpan">
                </div>
            </form>
        </div>
    </section>
@endsection
