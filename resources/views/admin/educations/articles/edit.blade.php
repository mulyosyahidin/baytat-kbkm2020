@extends('layouts.admin')
@section('title', 'Edit Artikel')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></div>
                <div class="breadcrumb-item"><a
                        href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Edit Artikel</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Judul:</label>
                                    <input type="text" value="{{ old('title', $article->title) }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        name="title" required="required">

                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug:</label>
                                    <input type="text" value="{{ old('slug', $article->slug) }}"
                                        class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                        required="required">

                                    @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Isi Artikel:</label>
                                    <textarea id="content" name="content">{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" class="btn btn-primary" value="Simpan">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Foto</h5>
                            </div>
                            <div class="card-body">
                                @if (isset($article->media[0]))
                                <img src="{{ $article->media[0]->getFullUrl() }}" class="img-fluid">
                                @else
                                <div class="alert alert-info">
                                    Artikel ini tidak memiliki foto. Silahkan nggah baru.
                                </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <label for="picture">Foto:</label>
                                    <input type="file" class="form-control @error('picture') is-invalid @enderror"
                                        id="picture" name="picture">

                                    @error('picture')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <span class="text-muted">
                                        @if (isset($article->media[0]))
                                            Pilih foto baru untuk mengganti yang lama, kosongkan jika tidak ingin mengganti
                                        @else
                                            Pilih foto baru yang akan diunggah
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Kategori</h5>
                            </div>
                            <div class="card-body">
                                @if (count($categories) > 0)
                                <div class="form-group">
                                    <div class="selectgroup selectgroup-pills">
                                        @foreach ($categories as $category)
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                                class="selectgroup-input" @if (in_array($category->id,
                                            $articleCategories)) checked @endif>
                                            <span class="selectgroup-button">{{ $category->name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                <div class="alert alert-info">
                                    Tidak ada data kategori
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </section>
</div>
@endsection

@push('custom_js')
<script src="{{ asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#content',
        setup: (editor) => {
            editor.on('init', (e) => {
                @if (old('content'))
                let content = `{!! old('content') !!}`;
                @else
                let content = `{!! $article->content !!}`;
                @endif
                editor.setContent(content)
            })
        }
    });
</script>
@endpush
