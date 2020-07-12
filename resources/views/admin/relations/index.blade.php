@extends('layouts.admin')
@section('title', 'Kelola Sanggar')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Kelola Sanggar</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('relations.index') }}">Sanggar</a></div>
          <div class="breadcrumb-item">Kelola Sanggar</div>
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
                    <h5 class="card-title">Data Sangar</h5>
                </div>
                @if (count($relations) > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($relations as $relation)
                                <tr>
                                    <th scope="row">{{ $relation->id }}</th>
                                    <td>
                                        <a href="{{ route('relations.show', $relation->id) }}">{{ $relation->name }}</a>
                                    </td>
                                    <td>{{ $relation->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card-body">
                    div
                </div>
                @endif
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection