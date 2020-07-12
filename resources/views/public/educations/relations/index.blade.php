@extends('layouts.public')
@section('title', 'Sanggar Seni')

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

</style>
@endsection

@section('content')
<main>
    <section class="blogl">
        <div class="container-fluid d-md-flex">
            <div class="d-md-block w-100">
                <div class="col-md-12 p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" itemscope='itemscope'
                                itemtype='http://data-vocabulary.org/Breadcrumb'><a href="{{ route('home') }}"
                                    itemprop='url' title='Beranda'><span itemprop='title'>Beranda</span></a></li>
                            <li class="breadcrumb-item active" aria-current="page" itemscope='itemscope'
                                itemtype='http://data-vocabulary.org/Breadcrumb'><span class="breadcrumb_last"
                                    itemprop='title'><a>Sanggar Seni</a></span></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 p-0">
                    <div class="row carievent">
                        @if (count($relations) > 0)
                        @foreach ($relations as $relation)
                        <article class="col-12 col-sm-6 col-md-4 carilist">
                            <a href="{{ route('relations.show', $relation->id) }}">
                                <div class="card">
                                    <div class="card-tag"></div>
                                    <div class="position-relative">
                                        <div class="w-100 h-100 position-absolute"
                                            style="background:rgba(0,0,0,.2);border-radius:6px 6px 0 0"></div>
                                            <img
                                                class="card-img-top img-fluid" src="{{ $relation->media[0]->getFullUrl() }}"
                                                alt="{{ $relation->name }}" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title border-bottom pb-2 text-truncate">
                                            {{ $relation->name }}
                                        </h5>
                                    </div>
                                    <div class="card-footer border-none">
                                        <p class="small text-muted text-truncate m-0">
                                            {{ \Str::limit($relation->description, 240) }} ...
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </article>
                        @endforeach

                        <div class="col-md-12 d-flex justify-content-center">
                            {{ $relations->links() }}
                        </div>
                        @else
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-center">Tidak Ada Data</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Tidak ada data untuk ditampilkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
