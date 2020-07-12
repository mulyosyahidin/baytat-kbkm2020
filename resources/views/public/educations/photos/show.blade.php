@extends('layouts.public')
@section('title', $photo->album_name)

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/PhotoSwipe/dist/photoswipe.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/PhotoSwipe/dist/default-skin/default-skin.css') }}">

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
    <section>
        <div class="container">
            <div class="row">
                <nav class="col-md-12" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('home') }}"
                                itemprop='url' title='Home'><span itemprop='title'>Beranda</span></a></li>
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('edu') }}" itemprop='url'
                                title='Edukasi'><span itemprop='title'>Edukasi</span></a></li>
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('edu.photos.index') }}"
                                itemprop='url' title='Foto'><span itemprop='title'>Foto</span></a></li>
                        <li class="breadcrumb-item active" aria-current="page" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><span class="breadcrumb_last"
                                itemprop='title'><a>{{ $photo->album_name }}</a></span></li>
                    </ol>
                </nav>
                <article class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">{{ $photo->album_name }}</h3>
                        </div>
                        <div class="card-body text-justify">
                            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="pswp__bg"></div>
                                <div class="pswp__scroll-wrap">
                                    <div class="pswp__container">
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                    </div>
                                    <div class="pswp__ui pswp__ui--hidden">
                                        <div class="pswp__top-bar">
                                            <div class="pswp__counter"></div>

                                            <button class="pswp__button pswp__button--close"
                                                title="Close (Esc)"></button>

                                            <button class="pswp__button pswp__button--share" title="Share"></button>

                                            <button class="pswp__button pswp__button--fs"
                                                title="Toggle fullscreen"></button>

                                            <button class="pswp__button pswp__button--zoom"
                                                title="Zoom in/out"></button>

                                            <div class="pswp__preloader">
                                                <div class="pswp__preloader__icn">
                                                    <div class="pswp__preloader__cut">
                                                        <div class="pswp__preloader__donut"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                            <div class="pswp__share-tooltip"></div>
                                        </div>

                                        <button class="pswp__button pswp__button--arrow--left"
                                            title="Previous (arrow left)">
                                        </button>

                                        <button class="pswp__button pswp__button--arrow--right"
                                            title="Next (arrow right)">
                                        </button>

                                        <div class="pswp__caption">
                                            <div class="pswp__caption__center"></div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="images-grid">
                                <div class="grid-container">
                                    @php ($n = 1)
                                    @foreach ($photo->media as $media)
                                    <div>
                                        <img src="{{ $media->getFullUrl() }}" alt="{{ $photo->album_name }}"
                                            class="img-fluid grid-item grid-item-{{ $n }}">
                                        <p>{{ $photo->album_name }}</p>
                                    </div>
                                    @php ($n++)
                                    @endforeach
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-info btn-view">Lihat Galeri</button>
                            </div>
                        </div>
                        <div class="card-footer border-none">
                            {{ $photo->description }}
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>
</main>
@endsection

@push('custom_js')
<script src="{{ asset('assets/plugins/PhotoSwipe/dist/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/plugins/PhotoSwipe/dist/photoswipe-ui-default.min.js') }}"></script>

<script>
    var pswpElement = document.querySelectorAll('.pswp')[0];

    // build items array
    var items = [
        @foreach($photo->media as $media) {
            src: '{{ $media->getFullUrl() }}',
            w: 0,
            h: 0,
            title: '{{ $photo->album_name }}'
        },
        @endforeach
    ];

    // define options (if needed)
    var options = {
        // optionName: 'option value'
        // for example:
        index: 0 // start at first slide
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.listen('gettingData', function (index, item) {
        if (item.w < 1 || item.h < 1) { // unknown size
            var img = new Image();
            img.onload = function () { // will get size after load
                item.w = this.width; // set image width
                item.h = this.height; // set image height
                gallery.invalidateCurrItems(); // reinit Items
                gallery.updateSize(true); // reinit Items
            }
            img.src = item.src; // let's download image
        }
    });
    gallery.init();

    $('.btn-view').click(function () {
        var lightBox = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, items, options);
        lightBox.init();
    })

</script>
@endpush
