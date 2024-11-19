@extends('layout.app')
@push('style')
    <style>
        /* CSS untuk animasi fade-in dan fade-out */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        .fade-out {
            opacity: 1;
            animation: fadeOut 0.5s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end m-3">
                            <a href="{{ route('category.create') }}" class="btn btn-sm btn-success">Tambah Kategori</a>
                        </div>
                        <h5 class="card-title">Data {{ $title }}</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show fade-in" role="alert"
                                id="alertMessage">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                    <table class="table table-sm datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="d-flex flex-col flex-sm-row gap-2">
                                        <a href="{{ route('category.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning text-white">Edit</a>
                                        <form action="{{ route('category.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
