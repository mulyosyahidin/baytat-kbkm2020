@extends('layouts.admin')
@section('title', 'Pengaturan Profil')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Profil</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Pengaturan</a></div>
          <div class="breadcrumb-item">Profil</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <form action="{{ route('admin.settings.profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Profil</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" value="{{ old('name', Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required="required">
                            
                                @error ('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" required="required">
                            
                                @error ('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" id="password">

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <span class="text-muted">Kosongkan jika tidak ingin mengganti password</span>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input type="submit" value="Simpan" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Foto</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                @if (isset(Auth::user()->media[0]))
                                    <img src="{{ Auth::user()->media[0]->getFullUrl() }}"
                                        class="img-fluid">
                                @else
                                    <div class="alert alert-info">Belum ada foto. Silahkan unggah baru</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control @error('picture') is-invalid @enderror" name="picture">
                            
                                @error('picture')
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