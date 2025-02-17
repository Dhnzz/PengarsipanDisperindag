@extends('layout.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah {{ $title }}</h5>
                        <form class="row g-3" action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nomor_surat" id="nomor_surat"
                                        placeholder="From" value="{{ old('nomor_surat') }}" required>
                                    <label for="nomor_surat">Nomor Surat</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="From" value="{{ old('name') }}" required>
                                    <label for="name">Nama File</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="desc" id="desc" placeholder="From" value="{{ old('desc') }}" required
                                        cols="30" rows="20" style="height: 150px"></textarea>
                                    <label for="desc">Keterangan Surat</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                placeholder="From" value="{{ old('from') }}" required>
                                            <label for="from">Pengirim</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="to" id="to"
                                                placeholder="To" value="{{ old('to') }}" required>
                                            <label for="to">Penerima</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="file">Tanggal Dokumen</label>
                                <input type="date" class="form-control" name="date" id="date" required>
                            </div>
                            <div class="col-md-12">
                                <label for="file">Upload File</label>
                                <input type="file" class="form-control" name="file" id="file" required>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                <button type="reset" class="text-white btn btn-sm btn-warning">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
