@extends('layout.app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <a href="{{ route('file.index') }}" class="btn btn-sm btn-danger"><i class="bi bi-arrow-left"></i>
                                Kembali</a>
                        </div>
                        <h5 class="card-title">Data {{ $title }}</h5>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nama File:</div>
                            <div class="col-md-8">{{ $file->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Kategori:</div>
                            <div class="col-md-8">{{ $file->category->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Pengirim (From):</div>
                            <div class="col-md-8">{{ $file->from }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Penerima (To):</div>
                            <div class="col-md-8">{{ $file->to }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Unggah:</div>
                            <div class="col-md-8">{{ $file->created_at->format('d F Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Aksi:</div>
                            <div class="col-md-8">
                                @if (substr($file->path, -5) != '.docx')
                                    <button type="button" class="btn btn-primary btn-sm show-file-btn"
                                        {{ $file->path == null ? 'disabled' : '' }} data-modal="{{ json_encode($file) }}"
                                        data-bs-toggle="modal" data-bs-target="#modalId">
                                        Lihat File
                                    </button>
                                @endif
                                <a href="{{ asset('storage/' . $file->path) }}" class="btn btn-success btn-sm" download>
                                    <i class="bi bi-download"></i> Download File
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
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
