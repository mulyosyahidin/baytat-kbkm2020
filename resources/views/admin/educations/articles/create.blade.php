@extends('layouts.admin')
@section('title', 'Buat Artikel Baru')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Buat Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></div>
                <div class="breadcrumb-item">Buat Artikel</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tulis Artikel Baru</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Judul:</label>
                                    <input type="text" value="{{ old('title') }}"
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
                                    <label for="content">Isi Artikel:</label>
                                    <textarea id="content" name="content">{{ old('content') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Kategori</h5>
                            </div>
                            <div class="card-body">
                                @if (count($categories) > 0)
                                <div class="form-group">
                                    @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input name="category_id[]" value="{{ $category->id }}" class="form-check-input"
                                            type="checkbox" id="category-{{ $category->id }}">
                                        <label class="form-check-label" for="category-{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="alert alert-info">
                                    Tidak ada data kategori
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="picture">Foto Thumbnail:</label>
                                    <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture">

                                    @error('picture')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="Terbitkan">
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
        selector: '#content'
    });
</script>
@endpush