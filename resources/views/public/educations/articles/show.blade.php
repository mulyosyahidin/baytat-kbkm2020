@extends('layouts.public')
@section('title', $article->title)

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
                            itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('edu.articles.index') }}"
                                itemprop='url' title='Artikel'><span itemprop='title'>Artikel</span></a></li>
                        <li class="breadcrumb-item active" aria-current="page" itemscope='itemscope'
                            itemtype='http://data-vocabulary.org/Breadcrumb'><span class="breadcrumb_last"
                                itemprop='title'><a>{{ $article->title }}</a></span></li>
                    </ol>
                </nav>
                <article class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">{{ $article->title }}</h3>
                        </div>
                        <div class="card-body text-justify">
                            <div class="images-grid">
                                <div class="grid-container">
                                    <div class="text-center">
                                        <img src="{{ $article->media[0]->getFullUrl() }}" alt="{{ $article->title }}"
                                            class="img-fluid grid-item">
                                    </div>
                                </div>
                            </div>

                            {!! $article->content !!}
                        </div>
                        <div class="card-footer border-none">
                            Dipublikasikan {{ \Carbon\Carbon::parse($article->created_at)->format('l, d F Y H:i') }}
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>
</main>
@endsection
