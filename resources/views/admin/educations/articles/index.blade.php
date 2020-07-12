@extends('layouts.admin')
@section('title', 'Kelola Artikel')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item">Artikel</div>
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
                            <h5 class="card-title">Kelola Artikel</h5>
                            <span class="ml-auto">
                                <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i></a>
                                <a href="{{ route('article-categories.index') }}" class="btn btn-info btn-sm">Kelola
                                    Kategori</a>
                            </span>
                        </div>
                        @if (count($articles) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($articles as $article)
                                  <tr>
                                    <th scope="row">{{ $article->id }}</th>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($article->created_at)->format('l, d F Y H:i') }}</td>
                                    <td>
                                      <a href="{{ route('articles.show', $article->id) }}"
                                        class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                      <a href="{{ route('articles.edit', $article->id) }}"
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $articles->links() }}
                        </div>
                        @else
                        <div class="card-body">
                            <div class="alert alert-info">Tidak ada data untuk ditampilkan</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
