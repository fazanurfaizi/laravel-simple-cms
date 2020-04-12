@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Fitur</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard/features') }}">
                                Fitur
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Edit Fitur</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container-fluid">
            <form class="col-lg-12" action="{{ url('/dashboard/features/update/' . $features->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" value="{{ $features->title }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <input type="text" name="slug" class="form-control" value="{{ $features->slug }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                                <textarea name="body" class="form-control my-editor mx-auto" style="min-height: 512px">
                                    {{ $features->body }}
                                </textarea>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <div class="row justify-content-center">
                        <label for="image" class="col-md-3">Gambar</label>
                        <div class="col-md-6">
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">{{ $features->image }}</label>
                            </div>
                            @if ($features->image)
                                <div class="col-md-9">
                                    <img src="{{ asset('storage/images/features/' . $features->image) }}" alt="{{ $features->title }}" style="width: 256px; height: 256px">
                                </div>
                                <div class="clearfix"></div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-9 mt-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection
