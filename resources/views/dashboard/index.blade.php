@extends('layout.app')
@push('style')
@endpush

@section('content')
    <section class="section dashboard">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show fade-in" role="alert" id="alertMessage">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var alert = document.getElementById('alertMessage');

                    // Animasi fade-in saat pertama kali muncul
                    if (alert) {
                        alert.classList.add('fade-in');
                    }

                    // Menghilangkan alert setelah 2.5 detik dengan animasi fade-out
                    setTimeout(function() {
                        if (alert) {
                            alert.classList.remove('fade-in');
                            alert.classList.add('fade-out');

                            // Menghapus elemen dari DOM setelah animasi selesai (misal, durasi 0.5 detik)
                            setTimeout(function() {
                                alert.remove();
                            }, 500);
                        }
                    }, 2500);
                });
            </script>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Berkas</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-earmark"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $countFile ?? 0 }} Buah</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
