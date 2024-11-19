@extends('layout.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah {{ $title }}</h5>
                        <form class="row g-3" action="{{ route('file.update', $file->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="From" required value="{{ $file->name }}">
                                    <label for="name">Nama File</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $file->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="category_id">Kategori</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="from" id="from"
                                                placeholder="From" required value="{{ $file->from }}">
                                            <label for="from">Pengirim</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="to" id="to"
                                                placeholder="To" required value="{{ $file->to }}">
                                            <label for="to">Penerima</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="file">Upload File</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="file" id="file" required>
                                    <button type="button" class="btn btn-primary btn-sm show-file-btn"
                                        {{ $file->path == null ? 'disabled' : '' }} data-modal="{{ json_encode($file) }}"
                                        data-bs-toggle="modal" data-bs-target="#modalId">
                                        Lihat File
                                    </button>
                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                <button type="reset" class="btn btn-sm btn-warning text-white">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skuModalTitle">
                        Detail File
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ratio ratio-1x1">
                    <iframe id="framePdf" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var base = "{{ asset('storage') }}/"; // Menggunakan storage untuk public disk

            // Event listener untuk tombol 'show-file-btn'
            $('.show-file-btn').on('click', function() {
                var file = $(this).data('modal');


                if (file && file.path) {
                    var filePath = base + file.path;
                    console.log(filePath);


                    // Menambahkan filePath ke iframe src
                    $('#framePdf').attr('src', filePath);
                } else {
                    $('#framePdf').attr('src', '');
                }
            });

            // Reset modal ketika ditutup
            $('#modalId').on('hidden.bs.modal', function() {
                $('#framePdf').attr('src', ''); // Membersihkan iframe setelah modal ditutup
            });
        });
    </script>
@endpush
