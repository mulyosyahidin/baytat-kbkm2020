@extends('layouts.admin')
@section('title', 'Tambah Sanggar Baru')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tambah Sanggar Baru</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('relations.index') }}">Sanggar</a></div>
          <div class="breadcrumb-item">Tambah Sanggar Baru</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <form action="{{ route('relations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Sanggar</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Sanggar:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat:</label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi:</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contact">Kontak:</label>
                                <textarea name="contact" id="contact" cols="30" rows="10" class="form-control @error('contact') is-invalid @enderror">{{ old('contact') }}</textarea>
                            
                                @error('contact')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Foto</h5>

                            <span class="ml-auto">
                                <a href="#" class="btn btn-primary btn-sm add-picture-btn"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" class="form-control" name="pictures[0]">
                            </div>

                            <div class="add-picture-container"></div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Pilih foto JPG atau PNG dengan ukuran maksimal 5MB</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
                                        <th scope="col">Nama Event</th>
                                        <th scope="col">Penyelenggara</th>
                                        <th scope="col">Peringkat</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary btn-block" value="Tambah Data Sanggar">
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
        let addPictureBtn = document.querySelector('.add-picture-btn');
        let nPic = 1;

        addPictureBtn.addEventListener('click', (e) => {
            e.preventDefault();

            let pictureContainer = document.querySelector('.add-picture-container');

            let newCol = document.createElement('div');
                newCol.setAttribute('class', 'form-group');
            let input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('class', 'form-control');
                input.setAttribute('name', `pictures[${nPic}]`)

            newCol.append(input);
            pictureContainer.append(newCol);

            nPic++;
        })

        let addRow = document.querySelector('.btn-add-row');
        let n = 1;

        addRow.addEventListener('click', function(e) {
            e.preventDefault();

            let tableContainer = document.querySelector('#prestation')
                .getElementsByTagName('tbody')[0];

            let newRow = tableContainer.insertRow();

            let eventCell = newRow.insertCell(0);
            let organizerCell = newRow.insertCell(1);
            let rankCell = newRow.insertCell(2);
            let yearCell = newRow.insertCell(3);
            let descCell = newRow.insertCell(4);

            eventCell.innerHTML = `<input type="text" name="prestation[${n}][event_name]" class="form-control">`;
            organizerCell.innerHTML = `<input type="text" name="prestation[${n}][organizer]" class="form-control">`;
            rankCell.innerHTML = `<input type="text" name="prestation[${n}][rank]" class="form-control">`;
            yearCell.innerHTML = `<input type="text" name="prestation[${n}][year]" class="form-control">`;
            descCell.innerHTML = `<input type="text" name="prestation[${n}][description]" class="form-control">`;

            n++;
        });
    </script>
@endpush