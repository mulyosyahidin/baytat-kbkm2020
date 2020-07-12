@extends('layouts.public')
@section('title', 'Konten Edukasi')

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/slick-theme.css') }}">

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

    .images-grid {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: sans-serif;
    }

    .grid-container {
        columns: 5 200px;
        column-gap: 1.5rem;
        width: 90%;
        margin: 0 auto;
    }

    .grid-container div {
        width: 150px;
        margin: 0 1.5rem 1.5rem 0;
        display: inline-block;
        width: 100%;
        border: solid 2px black;
        padding: 5px;
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
        border-radius: 5px;
        transition: all 0.25s ease-in-out;
    }

    .grid-container div:hover img {
        filter: grayscale(0);
    }

    .grid-container div:hover {
        border-color: coral;
    }

    .grid-container div img {
        width: 100%;
        filter: grayscale(60%);
        border-radius: 5px;
        transition: all 0.25s ease-in-out;
    }

    .grid-container div p {
        margin: 5px 0;
        padding: 0;
        text-align: center;
        font-style: italic;
    }

</style>
@endsection

@section('content')
<main>
    <section class="blogl">
        <div class="container">
            <div class="row">
                <nav class="col-md-12" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('home') }}"
                                itemprop='url' title='Home'><span itemprop='title'>Beranda</span></a></li>
                        <li class="breadcrumb-item active" aria-current="page" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><span class="breadcrumb_last"
                                itemprop='title'><a>Edukasi</a></span></li>
                    </ol>
                </nav>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Video Edukasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="images-grid">
                                <div class="grid-container">
                                    @php ($n = 1)
                                    @foreach ($videos as $video)
                                    <div>
                                        <a href="{{ route('edu.videos.show', $video->id) }}">
                                            <iframe src="https://www/youtube.com/embed/{{ $video->video_id }}"
                                                frameborder="0" class="img-fluid grid-item grid-item-{{ $n }}"></iframe>
                                            <p>{{ $video->title }}</p>
                                        </a>
                                    </div>
                                    @php ($n++)
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blogl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Foto</h3>
                        </div>
                        <div class="card-body">
                            <div class="images-grid">
                                <div class="grid-container">
                                    @foreach ($photos as $photo)
                                    @php ($n = 1)
                                    @foreach ($photo->media as $media)
                                    <div>
                                        <a href="{{ route('edu.photos.show', $photo->id) }}">
                                            <img src="{{ $media->getFullUrl() }}" alt="{{ $photo->album_name }}"
                                                class="img-fluid grid-item grid-item-{{ $n }}">
                                            <p>{{ $photo->album_name }}</p>
                                        </a>
                                    </div>
                                    @php ($n++)
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blogl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Artikel</h3>
                        </div>
                        @if (!count($articles) > 0)
                        <div class="card-body">
                            <div class="alert alert-info">Tidak ada data untuk ditampilkan</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @if (count($articles) > 0)
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><a
                                    href="{{ route('edu.articles.show', ['article' => $article->id, 'slug' => $article->slug]) }}">{{ $article->title }}</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="float-left mr-3">
                                <img style="width: 80px; height: 80px;" src="{{ $article->media[0]->getFullUrl() }}"
                                    alt="{{ $article->title }} class=" img-fluid">
                            </div>

                            {{ strip_tags(\Str::limit($article->content, 300)) }}
                        </div>
                        <div class="card-footer text-right">
                            <a
                                href="{{ route('edu.articles.show', ['article' => $article->id, 'slug' => $article->slug]) }}">
                                Baca Selengkapnya &raquo;
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
</main>
@endsection

@push('custom_js')
<script>
    $('.blogp').slick({
        infinite: !0,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: !0,
        autoplaySpeed: 2000,
        responsive: [{
            breakpoint: 762,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: !0,
                dots: !0
            }
        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });

</script>
@endpush
