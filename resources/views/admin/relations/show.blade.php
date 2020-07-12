@extends('layouts.admin')
@section('title', $relation->name)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $relation->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('relations.index') }}">Sanggar</a></div>
                <div class="breadcrumb-item">{{ $relation->name }}</div>
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
                            <h5 class="card-title">Data Sanggar</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $relation->name }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $relation->address }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>{{ $relation->description }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('relations.edit', $relation->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#"
                                data-toggle="modal" data-target="#delete-modal"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (count($relation->prestations) > 0)
                            <div class="owl-carousel owl-theme">
                                @foreach ($relation->media as $media)
                                <div class="item">
                                    <img src="{{ $media->getFullUrl() }}" alt="" class="img img-fluid">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="alert alert-info">
                                Tidak ada foto
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Prestasi Sanggar</h5>
                        </div>
                        @if (count($relation->prestations) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Event</th>
                                        <th scope="col">Penyelenggara</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($relation->prestations as $prestation)
                                    <tr>
                                        <th scope="row">{{ $prestation->id }}</th>
                                        <td>{{ $prestation->event_name }}</td>
                                        <td>{{ $prestation->organizer }}</td>
                                        <td>{{ $prestation->year }}</td>
                                        <td>{{ $prestation->description }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="card-body">
                            <div class="alert alert-info">Tidak ada data prestasi</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('custom_html')
<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Sanggar Relasi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('relations.destroy', $relation->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">

                <div class="modal-body">
                    <div class="txt">Yakin ingin menghapus? Semua data lain seperti prestasi dan foto juga akan dihapus</div>
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

@section('custom_head')
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/css/owl.theme.css') }}">
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
