@extends('layouts.admin')
@section('title', 'Kelola Sosial Media')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Sosial Media</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Pengaturan</a></div>
        <div class="breadcrumb-item">Sosial Media</div>
      </div>
    </div>

    <div class="section-body">
      @if (Session::has('success'))
      <h2 class="section-title">
        {{ Session::get('success') }}
      </h2>
      @endif

      <form action="{{ route('admin.settings.socials.store') }}" method="POST">
        @csrf

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Link Sosial Media</h5>

                <span class="ml-auto">
                  <a href="#" class="btn btn-sm btn-primary btn-add"><i class="fa fa-plus"></i></a>
                </span>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-striped" id="social-data">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Link</th>
                      <th scope="col">Icon FontAwesome</th>
                      <th scope="col">Urutan ke</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($socials) > 0)
                    @foreach ($socials as $social)
                    <tr>
                      <td>
                        <input type="checkbox" name="delete[{{ $social->id }}]" value="1">
                      </td>
                      <td>
                        <input type="text" value="{{ $social->title }}" name="update[{{ $social->id }}][title]" class="form-control">
                      </td>
                      <td>
                        <input type="text" value="{{ $social->link }}" name="update[{{ $social->id }}][link]" class="form-control">
                      </td>
                      <td>
                        <input type="text" value="{{ $social->fa_icon }}" name="update[{{ $social->id }}][fa_icon]" class="form-control">
                      </td>
                      <td>
                        <input type="text" value="{{ $social->num_order }}" name="update[{{ $social->id }}][num_order]" class="form-control">
                      </td>
                    </tr>
                    @endforeach
                    <tr>
                      <td>
                        <i class="fa fa-plus"></i>
                      </td>
                      <td>
                        <input type="text" name="link[0][title]" class="form-control">
                      </td>
                      <td>
                        <input type="text" name="link[0][link]" class="form-control">
                      </td>
                      <td>
                        <input type="text" name="link[0][fa_icon]" class="form-control">
                      </td>
                      <td>
                        <input type="text" name="link[0][num_order]" class="form-control">
                      </td>
                    </tr>
                    @else
                    <tr>
                      <td>
                        #
                      </td>
                      <td>
                        <input type="text" name="link[0][title]" class="form-control" required>
                      </td>
                      <td>
                        <input type="text" name="link[0][link]" class="form-control" required>
                      </td>
                      <td>
                        <input type="text" name="link[0][fa_icon]" class="form-control" required>
                      </td>
                      <td>
                        <input type="text" name="link[0][num_order]" class="form-control">
                      </td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                @if (count($socials) > 0)
                <input type="submit" name="do_delete" value="Hapus yang ditandai" class="btn btn-danger">
                <input type="submit" value="Simpan" class="btn btn-primary">
                @else
                <div class="text-right">
                  <input type="submit" value="Tambah" class="btn btn-primary">
                </div>
                @endif
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
  let n = 1;
      let addBtn = document.querySelector('.btn-add');
      let table = document.querySelector('#social-data')
        .getElementsByTagName('tbody')[0];

      addBtn.addEventListener('click', (e) => {
        e.preventDefault();

        let row = table.insertRow();

        let idCell = row.insertCell(0);
        let titleCell = row.insertCell(1);
        let linkCell = row.insertCell(2);
        let iconCell = row.insertCell(3);
        let numCell = row.insertCell(4);

        idCell.innerHTML = '<i class="fa fa-plus"></i>';
        titleCell.innerHTML = `<input type="text" name="link[${n}][title]" class="form-control">`;
        linkCell.innerHTML = `<input type="text" name="link[${n}][link]" class="form-control">`;
        iconCell.innerHTML = `<input type="text" name="link[${n}][fa_icon]" class="form-control">`;
        numCell.innerHTML = `<input type="text" name="link[${n}][num_order]" class="form-control">`;

        n++;
      });
</script>
@endpush