@extends('layouts.admin')
@section('title', 'Tambah Foto Baru')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Album Foto</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item"><a href="{{ route('photos.index') }}">Foto</a></div>
                <div class="breadcrumb-item">Tambah Baru</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif


            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tambah Foto</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Album:</label>
                                    <input type="text" id="name" value="{{ old('album_name') }}" class="form-control @error('album_name') is-invalid @enderror" name="album_name" required="required">
                                
                                @error('album_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label for="desc">Deskripsi:</label>
                                    <textarea name="description" id="desc" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" class="btn btn-primary" value="Buat Album">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Foto</h5>

                                <span class="ml-auto">
                                    <a href="#" class="btn btn-primary btn-sm btn-add"><i class="fa fa-plus"></i></a>
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="file" name="photos[0]" class="form-control" required>
                                </div>

                                @error('photos')
                                    {{ $message }}
                                @enderror

                                <div class="photos-container"></div>
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
    <script>
        let addBtn = document.querySelector('.btn-add');
        let n = 1;
        addBtn.addEventListener('click', (e) => {
            e.preventDefault();

            let container = document.querySelector('.photos-container');

            let div = document.createElement('div');
                div.setAttribute('class', 'form-group');
            let input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('class', 'form-control');
                input.setAttribute('name', `photos[${n}]`)
                input.setAttribute('required', 'required');

            div.append(input);
            container.append(div);

            n++;
        });
    </script>
@endpush
