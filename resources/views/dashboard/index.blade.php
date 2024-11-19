@extends('layout.app')
@push('style')
@endpush

@section('content')
    <section class="section dashboard">
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
                                <h6>{{ $fileCount ?? 0 }} Buah</h6>
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
