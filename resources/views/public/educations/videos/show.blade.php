@extends('layouts.public')
@section('title', $video->title)

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/style.css') }}">

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
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('edu') }}" itemprop='url'
                                title='Edukasi'><span itemprop='title'>Edukasi</span></a></li>
                        <li class="breadcrumb-item" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('edu.videos.index') }}"
                                itemprop='url' title='Video'><span itemprop='title'>Video</span></a></li>
                        <li class="breadcrumb-item active" aria-current="page" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><span class="breadcrumb_last"
                                itemprop='title'><a>{{ $video->title }}</a></span></li>
                    </ol>
                </nav>
                <article class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">{{ $video->title }}</h3>
                        </div>
                        <div class="card-body text-justify">
                            <div class="videoWrapper">
                                <iframe width="560" height="349"
                                    src="http://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="card-footer border-none">
                            {{ $video->description }}
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>
</main>
@endsection

@push('custom_js')
<script>
    var $allVideos = $("iframe[src^='//www.youtube.com']"),
        $fluidEl = $("body");

    $allVideos.each(function () {
        $(this)
            .data('aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');

    });

    $(window).resize(function () {
        var newWidth = $fluidEl.width();
        $allVideos.each(function () {

            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.data('aspectRatio'));

        });
        
    }).resize();

</script>
@endpush
