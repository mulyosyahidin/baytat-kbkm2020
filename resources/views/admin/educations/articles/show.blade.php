@extends('layouts.admin')
@section('title', $article->title)

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Artikel</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
          <div class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></div>
          <div class="breadcrumb-item">{{ $article->title }}</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <div class="row">
          <div class="col-12 col-md-8">
              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">{{ $article->title }}</h5>
                  </div>
                  <div class="card-body">
                      {!! $article->content !!}
                  </div>
              </div>
          </div>
          <div class="col-12 col-md-4">
              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Foto</h5>
                  </div>
                  <div class="card-body">
                      @if (isset($article->media[0]))
                        <img src="{{ $article->media[0]->getFullUrl() }}" class="img-fluid">
                      @else
                        <div class="alert alert-info">
                            Tidak ada foto
                        </div>
                      @endif
                  </div>
              </div>

              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Kategori</h5>
                  </div>
                  <div class="card-body">
                      @if (count($article->article_category()->get()) > 0)
                      <div class="selectgroup selectgroup-pills">
                        @foreach ($article->article_category()->get() as $category)
                        <label class="selectgroup-item">
                            <input type="checkbox" value="{{ $category->name }}" class="selectgroup-input" checked disabled>
                            <span class="selectgroup-button">{{ $category->name }}</span>
                          </label>
                        @endforeach
                      </div>
                      @else
                      <div class="alert alert-info">
                          Artikel ini tidak memiliki kategori
                      </div>
                      @endif
                  </div>
              </div>

              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Posting</h5>
                  </div>
                  <div class="card-body">
                      <p>Diterbitkan pada <b>{{ \Carbon\Carbon::parse($article->created_at)->format('l, d F Y H:i') }}</b></p>
                  </div>
                  <div class="card-footer text-center">
                      <a href="{{ route('articles.edit', $article->id) }}"
                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                      <a href="#"
                        class="btn btn-danger btn-sm"
                        data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash"></i></a>
                  </div>
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
                <h5 class="modal-title">Hapus Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" id="delete-video-form">
                @csrf

                <input type="hidden" name="_method" value="DELETE">
                <div class="modal-body">
                    <div class="txt">Yakin ingin menghapus? Foto dan data terkait juga akan dihapus</div>
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