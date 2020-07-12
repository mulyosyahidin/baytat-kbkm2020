@extends('layouts.admin')
@section('title', 'Pengaturan Situs')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Situs</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan Situs</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Pengaturan Situs</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama situs:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" required="required" name="name"
                                        value="{{ old('name', getSiteName()) }}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
                                <h5 class="card-title">Logo</h5>
                            </div>
                            <div class="card-body">
                                @if (isset($setting->media[0]))
                                <img src="{{ $setting->media[0]->getFullUrl() }}" alt="Logo situs"
                                    class="img-fluid">
                                @else
                                    <p class="text-muted">Belum ada logo yang diunggah</p>
                                @endif

                                <div class="form-group">
                                    <label for="picture">Logo:</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="picture" name="logo">

                                    @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection