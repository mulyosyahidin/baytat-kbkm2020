@extends('layouts.admin')
@section('title', $photo->album_name)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Album Foto</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item"><a href="{{ route('photos.index') }}">Foto</a></div>
                <div class="breadcrumb-item">{{ $photo->album_name }}</div>
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
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <td>Album</td>
                                    <td>{{ $photo->album_name }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>{{ $photo->description }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-warning btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('photos.destroy', $photo->id) }}"
                                data-toggle="modal" data-target="#delete-modal"
                                class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Daftar Foto</h5>
                        </div>
                        <div class="card-body">
                            @if (count($photo->media) > 0)
                            <div class="owl-carousel">
                                @foreach ($photo->media as $picture)
                                <div class="item">
                                    <img src="{{ $picture->getFullUrl() }}" alt="" class="img-fluid">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="alert alert-info">Tidak ada foto dalam album ini</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/css/owl.theme.css') }}">
@endsection

@section('custom_html')
<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Album Foto?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">

                <div class="modal-body">
                    <div class="txt">Yakin ingin menghapus? Semua foto dalam album ini akan dihapus</div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script src="{{ asset('assets/plugins/owl.carousel/js/owl.carousel.js') }}"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true
    });

</script>
@endpush
