@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard/news') }}">
                                Berita
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Edit berita</li>
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
            <form class="col-lg-12" action="{{ url('/dashboard/news/update/' . $news->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" value="{{ $news->title }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                                <textarea name="body" class="form-control my-editor mx-auto" style="min-height: 512px">
                                    {{ $news->body }}
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
                                <label class="custom-file-label" for="image">{{ $news->image }}</label>
                            </div>
                            @if ($news->image)
                                <div class="col-md-9">
                                    <img src="{{ asset('storage/images/news/' . $news->image) }}" alt="{{ $news->title }}" style="width: 256px; height: 256px">
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
