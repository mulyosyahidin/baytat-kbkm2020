@extends('layouts.admin')
@section('title', 'Foto')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Foto</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item">Foto</div>
            </div>
        </div>

        <div class="section-body">
            @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Foto</h5>

                            <span class="ml-auto">
                                <a href="{{ route('photos.create') }}"
                                    class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        @if (count($photos) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Album</th>
                                        <th scope="col">Jumlah Foto</th>
                                        <th scope="col">Dibuat pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($photos as $photo)
                                        <tr>
                                            <td>{{ $photo->id }}</td>
                                            <td>
                                                <a href="{{ route('photos.show', $photo->id) }}">{{ $photo->album_name }}</a>
                                            </td>
                                            <td>{{ count($photo->media) }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($photo->created_at)->format('l, d F Y H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $photos->links() }}
                        </div>
                        @else
                        <div class="card-body">
                            <div class="alert alert-info">Tidak ada data</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection