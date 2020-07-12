@extends('layouts.admin')
@section('title', 'Kelola Sliders')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Sliders</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Pengaturan</a></div>
          <div class="breadcrumb-item">Sliders</div>
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
                      <h5 class="card-title">Kelola Sliders</h5>

                      <span class="ml-auto">
                        <a href="#" class="btn btn-sm btn-primary"
                          data-toggle="modal"
                          data-target="#add-modal"
                          data-backdrop="static"
                          data-keyboard="false"><i class="fa fa-plus"></i></a>
                      </span>
                  </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="sliders-data">
                            <thead class="thead-light">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Judul</th>
                                  <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
              </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection

@section('custom_head')
    <link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}">
@endsection

@section('custom_html')
<div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Tambah Slider</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="#" method="POST" enctype="multipart/form-data" id="add-slider-form">
      <div class="modal-body">
        <div class="error-container"></div>

        <div class="form-group">
          <label for="title">Judul:</label>
          <input type="text" class="form-control add-title" name="title" required="required">
        </div>

        <div class="form-group">
          <label for="link">Link:</label>
          <input type="url" name="link" class="form-control add-link" id="link">
        </div>

        <div class="form-group">
          <label for="desc">Deskripsi:</label>
          <textarea name="description" id="desc" cols="30" rows="10" class="form-control add-description"></textarea>
        </div>

        <div class="form-group">
          <label for="picture">Foto:</label>
          <input type="file" class="form-control add-picture" required="required" id="picture" name="picture" required>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-add">Tambah Baru</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="view-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="image"><img class="img-fluid"></div>
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <tr>
              <td>Judul</td>
              <td><span class="title-data font-weight-bold"></span></td>
            </tr>
            <tr>
              <td>Link</td>
              <td><span class="link-data font-weight-bold"></span></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td><span class="description-data font-weight-bold"></span></td>
            </tr>
          </table>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Slider?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info del-success">Yakin ingin menghapus?</div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Batal</button>
        <button type="button" class="btn btn-danger do-delete-btn">Hapus</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="POST" enctype="multipart/form-data" id="edit-slider-form">
        <div class="modal-body edit-slider">
          <div class="error-container"></div>
  
          <div class="form-group">
            <label for="title">Judul:</label>
            <input type="text" class="form-control add-title" name="title" required="required">
          </div>
  
          <div class="form-group">
            <label for="link">Link:</label>
            <input type="url" name="link" class="form-control add-link" id="link">
          </div>
  
          <div class="form-group">
            <label for="desc">Deskripsi:</label>
            <textarea name="description" id="desc" cols="30" rows="10" class="form-control add-description"></textarea>
          </div>
  
          <div class="form-group">
            <label for="picture">Foto:</label>
            <input type="file" class="form-control add-picture" id="picture" name="picture">

            <span class="text-muted">Pilih foto baru jika ingin mengganti yang lama. Kosongkan jika tidak</span>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-save">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  </div>
@endsection

@push('custom_js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script>
      let table = $('#sliders-data').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": "{{ url('api/sliders') }}",
        "columns": [
          {data: "id"},
          {data: "title"},
          {data: function(data, type, row) {
            let id = data.id;
            return `
            <div class="text-right">
              <a href="#" class="btn btn-info btn-sm btn-view" data-id="${id}"><i class="fa fa-eye"></i></a>
              <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="${id}"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="${id}"><i class="fa fa-trash"></i></a>
            </div>
            `;
          }}
        ]
      });

      let form = document.querySelector('#add-slider-form');
      let error = document.querySelector('.error-container');
      let btn = form.querySelector('.btn-add');

      form.addEventListener('submit', (e) => {
        e.preventDefault();

        btn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menambah...';

        let data = new FormData(form);
        
        fetch('{{ url('api/sliders') }}', {
          method: 'POST',
          body: data
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              error.innerHTML = '<div class="alert alert-success">Data berhasil ditambahkan</div>';
              form.reset();

              btn.innerHTML = '<i class="fa fa-check"></i> Berhasil!';

              table.ajax.reload();
            }
            else {
              btn.innerHTML = 'Tambah';

              let errors = data.responses;
              let ul = document.createElement('ul');
                  ul.setAttribute('class', 'alert alert-danger');

              for (err in errors) {
                let li = document.createElement('li');
                    li.append(errors[err]);

                ul.append(li);
              }

              error.append(ul);
            }
          })
          .catch(errors => {
            error.innerHTML = errors;
          });
      });

      $('#add-modal').on('hide.bs.modal', function (e) {
        while (error.firstChild) {
          error.removeChild(error.firstChild);
        }

        btn.innerHTML = 'Tambah';
      });

      $('#delete-modal').on('hide.bs.modal', function (e) {
        document.querySelector('.del-success').innerHTML = 'Yakin ingin menghapus?';
      })

      $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();

        let id = $(this).attr('data-id')
        fetch(`{{ url('api/sliders') }}/${id}`)
          .then(response => {
            if (response.status == 200) {
              response
                .json()
                .then(data => {
                  let modal = document.querySelector('#view-modal');
                    modal.querySelector('.title-data').innerHTML = data.title;
                    modal.querySelector('.link-data').innerHTML = data.link;
                    modal.querySelector('.description-data').innerHTML = data.description;
                    modal.querySelector('.image')
                      .getElementsByTagName('img')[0]
                      .setAttribute('src', data.picture_url);

                  $('#view-modal').modal('show');
                })
            }
          })
          .catch(errors => {
            console.log(errors);
          })
      });

      let action_id;
      $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        action_id = id;

        $('#delete-modal').modal('show');
      })

      let doDelete = document.querySelector('.do-delete-btn');
      doDelete.addEventListener('click', (e) => {
        e.preventDefault();

        doDelete.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menghapus...';

        fetch(`{{ url('api/sliders') }}/${action_id}`, {
          method: 'DELETE'
        })
          .then(res => res.json())
          .then(res => {
            if (res.success) {
              doDelete.innerHTML = 'Hapus';
              document.querySelector('.del-success').innerHTML = 'Berhasil menghapus data';

              table.ajax.reload();
            }
          })
          .catch(errors => {
            console.log(errors);
          })
      })

      $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        action_id = id;

        fetch(`{{ url('api/sliders') }}/${id}`)
          .then(response => {
            if (response.status == 200) {
              response
                .json()
                .then(data => {
                  let params = ['title', 'link', 'description'];
                  params.forEach(param => {
                    document.querySelector(`.edit-slider .add-${param}`).value = data[param];
                  })
                  $('#edit-modal').modal('show');
                })
            }
          })
          .catch(errors => {
            console.log(errors);
          })
      })

      let editForm = document.querySelector('#edit-slider-form');
      let saveBtn = editForm.querySelector('.btn-save');

      $('#edit-slider-form').submit(function(e) {
        e.preventDefault();

        let data = $(this).serialize();

        saveBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menyimpan...';

        $.ajax({
          method: 'PUT',
          url: `{{ url('api/sliders') }}/${action_id}`,
          data: data,
          success: function (res) {
            if (res.success) {
              saveBtn.innerHTML = '<i class="fa fa-check"></i> Tersimpan!';
              table.ajax.reload();

              let msg = document.querySelector('.edit-slider .error-container');
              msg.innerHTML = '<div class="alert alert-success">Berhasil menyimpan data</div>';
            }
          }
        })
      })
    </script>
@endpush