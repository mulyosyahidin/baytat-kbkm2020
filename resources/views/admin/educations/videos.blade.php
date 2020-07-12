@extends('layouts.admin')
@section('title', 'Kelola Video')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Video</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item">Video</div>
            </div>
        </div>

        <div class="section-body">
            @if(Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edukasi Video</h5>

                            <span class="ml-auto">
                                <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                    data-target="#add-modal" data-backdrop="static" data-keyboard="false"><i
                                        class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="video-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Link</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
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
                <h5 class="modal-title">Tambah Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="add-video-form">
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
                        <textarea name="description" id="desc" cols="30" rows="10"
                            class="form-control add-description"></textarea>
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
                <h5 class="modal-title">Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body video-data">
                <div class="video"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <td>Judul</td>
                            <td><span class="video-title"></span></td>
                        </tr>
                        <tr>
                            <td>Link</td>
                            <td><span class="video-link"></span></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td><span class="video-description"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="edit-video-form">
                <div class="modal-body">
                    <div class="error-container"></div>

                    <div class="form-group">
                        <label for="title">Judul:</label>
                        <input type="text" class="form-control edit-title" name="title" required="required">
                    </div>

                    <div class="form-group">
                        <label for="link">Link:</label>
                        <input type="url" name="video_id" class="form-control edit-video_id" id="link">
                    </div>

                    <div class="form-group">
                        <label for="desc">Deskripsi:</label>
                        <textarea name="description" id="desc" cols="30" rows="10"
                            class="form-control edit-description"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-save">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="delete-video-form">
                <div class="modal-body">
                    <div class="txt">Yakin ingin menghapus?</div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-delete-video">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    let table = $('#video-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": "{{ url('api/educations/videos') }}",
        "columns": [{
                data: "id"
            },
            {
                data: "title"
            },
            {
                data: function (data, type, row) {
                    return `https://www.youtube.com/watch?v=${data.video_id}`;
                }
            },
            {
                data: function (data, type, row) {
                    let id = data.id;
                    return `
                        <div class="text-right">
                            <a href="#" class="btn btn-info btn-sm btn-view" data-id="${id}"><i class="fa fa-eye"></i></a>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="${id}"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="${id}"><i class="fa fa-trash"></i></a>
                        </div>
                    `;
                }
            }
        ]
    });

    let form = document.querySelector('#add-video-form');
    let error = document.querySelector('.error-container');
    let btn = form.querySelector('.btn-add');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        btn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menambah...';

        let data = new FormData(form);

        fetch('{{ url('api/educations/videos ') }}', {
                    method: 'POST',
                    body: data
                })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    error.innerHTML =
                        '<div class="alert alert-success">Data berhasil ditambahkan</div>';
                    form.reset();

                    btn.innerHTML = '<i class="fa fa-check"></i> Berhasil!';

                    table.ajax.reload();
                } else {
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

    $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        fetch(`{{ url('api/educations/videos') }}/${id}`)
            .then(res => res.json())
            .then(res => {
                document.querySelector('.video-data .video-title')
                    .innerHTML = res.title;
                document.querySelector('.video-data .video-link')
                    .innerHTML = `https://www.youtube.com/watch?v=${res.video_id}`
                document.querySelector('.video-data .video-description')
                    .innerHTML = res.description;
                document.querySelector('.video-data .video')
                    .innerHTML = `<embed src="https://www.youtube.com/embed/${res.video_id}">`;

                $('#view-modal').modal('show');
            })
            .catch(errors => {
                console.log(errors);
            })
    });

    let action_id;
    let editForm = document.querySelector('#edit-video-form');
    let btnSave = document.querySelector('.btn-save');

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        action_id = id;

        fetch(`{{ url('api/educations/videos') }}/${id}`)
            .then(res => res.json())
            .then(res => {
                let params = ['title', 'video_id', 'description'];
                params.forEach(field => {
                    editForm.querySelector(`.edit-${field}`).value = res[field];

                    if (field == 'video_id') {
                        editForm.querySelector('.edit-video_id').value = `https:/www.youtube.com/watch?v=${res.video_id}`;
                    }
                });

                $('#edit-modal').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });
            })
            .catch(errors => {
                console.log(errors);
            })
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();
        
        let formData = $('#edit-video-form').serialize();
        $.ajax({
            method: 'PUT',
            url: `{{ url('api/educations/videos') }}/${action_id}`,
            data: formData,
            success: function (res) {
                let error = editForm.querySelector('.error-container');
                error.innerHTML = '<div class="alert alert-info">Berhasil menyimpan data</div>';

                if (res.success) {
                    btnSave.innerHTML = '<i class="fa fa-check"></i> Tersimpan!';
                    table.ajax.reload();
                }
                else if (res.errors) {
                    btnSave.innerHTML = 'Simpan Data';
                    let errors = res.responses;

                    let ul = document.createElement('ul');
                    ul.setAttribute('class', 'alert alert-danger');

                    for (err in errors) {
                        let li = document.createElement('li');
                        li.append(errors[err]);

                        ul.append(li);
                    }

                    error.append(ul);
                }
            }
        })
    })

    $('#edit-modal').on('hide.bs.modal', function (e) {
        let error = editForm.querySelector('.error-container');

        while (error.firstChild) {
            error.removeChild(error.firstChild);
        }

        btnSave.innerHTML = 'Simpan Data';
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        action_id = id;

        $('#delete-modal').modal('show');
    });

    let deleteForm = document.querySelector('#delete-video-form');
    let deleteBtn = deleteForm.querySelector('.btn-delete-video');

    deleteForm.addEventListener('submit', function (e) {
        e.preventDefault();

        deleteBtn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menghapus...';

        fetch(`{{ url('api/educations/videos') }}/${action_id}`, {
            method: 'DELETE'
        })
            .then(res => res.json())
            .then(res => {
                deleteBtn.innerHTML = '<i class="fa fa-check"></i> Terhapus!';

                deleteForm.querySelector('.txt')
                    .innerHTML = 'Berhasil menghapus data';

                table.ajax.reload();
                setTimeout(() => {
                    deleteBtn.innerHTML = 'Hapus';
                    $('#delete-modal').modal('hide');
                }, 2500);
            })
            .catch(errors => {
                console.log(errors);
            })
    });

</script>
@endpush
