@extends('layouts.admin')
@section('title', 'Edit '. $relation->name)

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{ $relation->name }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('relation.index') }}">Sanggar</a></div>
          <div class="breadcrumb-item"><a href="{{ route('relations.show', $relation->id) }}">{{ $relation->name }}</a></div>
          <div class="breadcrumb-item">Edit</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <form action="{{ route('relations.update', $relation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Sanggar</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Sanggar:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $relation->name) }}" required>
                            
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat:</label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('address', $relation->address) }}</textarea>
                            
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi:</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description', $relation->description) }}</textarea>
                            
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contact">Kontak:</label>
                                <textarea name="contact" id="contact" cols="30" rows="10" class="form-control @error('contact') is-invalid @enderror">{{ old('contact', $relation->contact) }}</textarea>
                            
                                @error('contact')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Foto</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" class="form-control @error('picture') is-invalid @enderror" name="picture">
                                <span class="text-muted">PIlih foto baru jika ingin mengganti yang lama, kosongkan jika tidak</span>
                                @error('picture')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Prestasi Sanggar</h5>

                            <span class="ml-auto">
                                <a href="#" class="btn btn-sm btn-primary btn-add-row"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="prestation">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Hapus</th>
                                        <th scope="col">Nama Event</th>
                                        <th scope="col">Penyelenggara</th>
                                        <th scope="col">Peringkat</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($relation->prestations) > 0)
                                        @foreach ($relation->prestations as $prestation)
                                        <tr>
                                            <th scope="row">
                                                <input type="checkbox" name="delete[{{ $prestation->id }}]" value="1">
                                            </th>
                                            <td>
                                                <input type="text" class="form-control" name="edit[{{ $prestation->id }}][event_name]" value="{{ $prestation->event_name }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="edit[{{ $prestation->id }}][organizer]" value="{{ $prestation->organizer }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="edit[{{ $prestation->id }}][rank]" value="{{ $prestation->rank }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="edit[{{ $prestation->id }}][year]" value="{{ $prestation->year }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="edit[{{ $prestation->id }}][description]" value="{{ $prestation->description }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control" name="prestation[0][event_name]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="prestation[0][organizer]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="prestation[0][rank]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="prestation[0][year]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="prestation[0][description]">
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="do_delete" value="Hapus yang ditandai" class="btn btn-danger">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </div>
                </div>
            </div>

        </form>
      </div>
    </section>
</div>
@endsection

@push('custom_js')
    <script>
        let addRow = document.querySelector('.btn-add-row');
        let n = 1;

        addRow.addEventListener('click', function(e) {
            e.preventDefault();

            let tableContainer = document.querySelector('#prestation')
                .getElementsByTagName('tbody')[0];

            let newRow = tableContainer.insertRow();

            let deleteCell = newRow.insertCell(0);
            let eventCell = newRow.insertCell(1);
            let organizerCell = newRow.insertCell(2);
            let rankCell = newRow.insertCell(3);
            let yearCell = newRow.insertCell(4);
            let descCell = newRow.insertCell(4);

            deleteCell.innerHTML = '';
            eventCell.innerHTML = `<input type="text" name="prestation[${n}][event_name]" class="form-control">`;
            organizerCell.innerHTML = `<input type="text" name="prestation[${n}][organizer]" class="form-control">`;
            rankCell.innerHTML = `<input type="text" name="prestation[${n}][rank]" class="form-control">`;
            yearCell.innerHTML = `<input type="text" name="prestation[${n}][year]" class="form-control">`;
            descCell.innerHTML = `<input type="text" name="prestation[${n}][description]" class="form-control">`;

            n++;
        });
    </script>
@endpush