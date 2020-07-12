@extends('layouts.public')
@section('title', $relation->name)

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/css/owl.theme.css') }}">

<style>
    .breadcrumb {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0.75rem 1rem;
        margin: 10px 0;
        list-style: none;
        background-color: #fff;
        border-radius: 0.25rem;
        font-size: 12px;
        border-left: 6px solid #00afef;
    }

    .breadcrumb-item+.breadcrumb-item {
        padding-left: 0.5rem;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        display: inline-block;
        padding-right: 0.5rem;
        color: #6c757d;
        content: "/";
    }

    .breadcrumb-item+.breadcrumb-item:hover::before {
        text-decoration: underline;
    }

    .breadcrumb-item+.breadcrumb-item:hover::before {
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    .videoWrapper {
        position: relative;
        padding-bottom: 56.25%;
        /* 16:9 */
        height: 0;
        padding-bottom: calc(var(--aspect-ratio, .5625) * 100%);
    }

    .videoWrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

</style>
@endsection

@section('content')
<main>
    <section>
        <div class="container">
            <div class="row">
                <nav class="col-md-12" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('home') }}"
                                itemprop='url' title='Home'><span itemprop='title'>Beranda</span></a></li>
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('relation.index') }}"
                                itemprop='url' title='Sanggar Seni'><span itemprop='title'>Sanggar Seni</span></a></li>
                        <li class="breadcrumb-item active" aria-current="page" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><span class="breadcrumb_last"
                                itemprop='title'><a>{{ $relation->name }}</a></span></li>
                    </ol>
                </nav>
                <article class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">{{ $relation->name }}</h3>
                        </div>
                        <div class="card-body text-justify">
                            @if (count($relation->media) > 0)
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
                        <div class="card-footer border-none">
                            {{ $relation->description }}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Prestasi</h3>
                        </div>
                        @if (count($relation->prestations) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Event</th>
                                        <th scope="col">Prestasi</th>
                                        <th scope="col">Penyelenggara</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($relation->prestations as $prestation)
                                    <tr>
                                        <th scope="row">{{ $prestation->event_name }}</th>
                                        <td>{{ $prestation->rank }}</td>
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
                            <div class="alert alert-info">Tidak ada data untuk ditampilkan</div>
                        </div>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Alamat dan Kontak</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td>Alamat</td>
                                    <td><b>{{ $relation->address }}</b></td>
                                </tr>
                                <tr>
                                    <td>Kontak</td>
                                    <td><b>{{ $relation->contact }}</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>
</main>
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
