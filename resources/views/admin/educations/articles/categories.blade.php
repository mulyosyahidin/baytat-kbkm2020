@extends('layouts.admin')
@section('title', 'Kelola Kategori Artikel')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.edu') }}">Edukasi</a></div>
                <div class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></div>
                <div class="breadcrumb-item">Kategori</div>
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
                            <h5 class="card-title">Kategori Artikel</h5>

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
                                        <th scope="col">Nama</th>
                                        <th scope="col">Slug</th>
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
                <h5 class="modal-title">Tambah Kategori Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="add-category-form">
                <div class="modal-body">
                    <div class="error-container"></div>

                    <div class="form-group">
                        <label for="title">Nama:</label>
                        <input type="text" class="form-control add-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug:</label>
                        <input type="text" name="slug" class="form-control add-slug" id="slug">
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

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="edit-category-form">
                <div class="modal-body">
                    <div class="error-container"></div>

                    <div class="form-group">
                        <label for="title">Nama:</label>
                        <input type="text" class="form-control edit-name" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug:</label>
                        <input type="text" name="slug" class="form-control edit-slug" id="slug">
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

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Kategori Artikel</h5>
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
    let addCategoryName = document.querySelector('#add-category-form .add-name');
    addCategoryName.addEventListener('keyup', (e) => {
        let name = addCategoryName.value;
        let slugInput = document.querySelector('#add-category-form .add-slug');

        let slug = name.replace(' ', '-');
            slug = slug.toLowerCase();

        slugInput.value = slug;
    });

    let editCategoryName = document.querySelector('#edit-category-form .edit-name');
    editCategoryName.addEventListener('keyup', (e) => {
        let name = editCategoryName.value;
        let slugInput = document.querySelector('#edit-category-form .edit-slug');

        let slug = name.replace(' ', '-');
            slug = slug.toLowerCase();

        slugInput.value = slug;
    });

    let table = $('#video-table').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": "{{ route('categories.index') }}",
        "columns": [{
                data: "id"
            },
            {
                data: "name"
            },
            {
                data: "slug"
            },
            {
                data: function (data, type, row) {
                    let id = data.id;
                    return `
                        <div class="text-right">
                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="${id}"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="${id}"><i class="fa fa-trash"></i></a>
                        </div>
                    `;
                }
            }
        ]
    });

    let form = document.querySelector('#add-category-form');
    let error = document.querySelector('.error-container');
    let btn = form.querySelector('.btn-add');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        btn.innerHTML = '<i class="fa fa-spin fa-spinner"></i> Menambah...';

        let data = new FormData(form);
        while (error.firstChild) {
            error.removeChild(error.firstChild);
        }

        fetch('{{ route('categories.store') }}', {
                    method: 'POST',
                    body: data
                })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    error.innerHTML =
                        '<div class="alert alert-success">'+ data.message +'</div>';
                    form.reset();

                    btn.innerHTML = '<i class="fa fa-check"></i> Berhasil!';

                    table.ajax.reload();

                    setTimeout(() => {
                        btn.innerHTML = 'Tambah';
                        while (error.firstChild) {
                            error.removeChild(error.firstChild)
                        }
                    }, 3000);
                }
                else if(data.error) {
                    btn.innerHTML = 'Tambah';

                    let errors = data.errors;
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

    let action_id;
    let editForm = document.querySelector('#edit-category-form');
    let btnSave = document.querySelector('.btn-save');

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        action_id = id;

        fetch(`{{ route('categories.show', FALSE) }}/${id}`)
            .then(res => res.json())
            .then(res => {
                let params = ['name', 'slug'];
                params.forEach(field => {
                    editForm.querySelector(`.edit-${field}`).value = res[field];
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
        
        let formData = $('#edit-category-form').serialize();
        $.ajax({
            method: 'PUT',
            url: `{{ route('categories.update', FALSE) }}/${action_id}`,
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
                    let errors = res.errors;

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

        fetch(`{{ route('categories.destroy', FALSE) }}/${action_id}`, {
            method: 'DELETE'
        })
            .then(res => res.json())
            .then(res => {
                deleteBtn.innerHTML = '<i class="fa fa-check"></i> Terhapus!';

                deleteForm.querySelector('.txt')
                    .innerHTML = res.message;

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
