@extends('layouts.public')
@section('title', 'Donasi')

@section('custom_head')
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/themes/public/css/slick-theme.css') }}">

<style>
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
<header id="header-home">
    <div class="headerback"></div>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1 class="text-center">Berbagi Melalui Donasi</h1>
                <p class="lead text-center">Bantu sanggar-sanggar seni dan kebudayaan dengan berdonasi kepada mereka</p>
            </div>
        </div>
    </div>
</header>

<main>
    <section class="corecb">
        <div class="container">
            <div class="row">
                @foreach ($relations as $relation)
                <div class="col-12 col-md-4 col-6 pl-2 pr-2">
                    <div class="card mb-3 p-3 align-items-center carilokasi">
                        <a
                            href="{{ route('donation.show', ['relation' => $relation->id, 'slug' => $relation->slug]) }}">
                            <div class="mb-3">
                                <img style="width: 340px; height: 172px;" src="{{ $relation->media[0]->getFullUrl() }}"
                                    alt="{{ $relation->name }}" class="img-fluid rounded">
                            </div>
                            <h2>{{ $relation->name }}</h2>
                        </a>
                        <a style="border-radius: 20px;"
                            href="{{ route('donation.show', ['relation' => $relation->id, 'slug' => $relation->slug]) }}"
                            class="btn btn-primary">Donasi</a>
                    </div>
                </div>
                @endforeach
            </div>
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
