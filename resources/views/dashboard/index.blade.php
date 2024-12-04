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
            <div class="col-12">
                <!-- Reports -->
                <div class="card">

                    {{-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div> --}}

                    <div class="card-body">
                        <h5 class="card-title">Rekapan Jumlah Surat <span>/Tahun</span></h5>

                        <!-- Line Chart -->
                        <div id="reportsChart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#reportsChart"), {
                                    series: [{
                                        name: 'Jumlah Dokumen',
                                        data: Object.values(@json($fileYearData)),
                                    }],
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    markers: {
                                        size: 4
                                    },
                                    colors: ['#4154f1'],
                                    fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    yaxis: {
                                        type: 'numeric',
                                        forceNiceScale: true,
                                        categories: Object.values(@json($fileYearData))
                                    },
                                    xaxis: {
                                        type: 'year',
                                        categories: Object.keys(@json($fileYearData))
                                    },
                                    tooltip: {
                                        x: {
                                            format: 'dd/MM/yy'
                                        }
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Line Chart -->

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
