@extends('layout.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Password</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="row g-3" action="{{ route('change_password') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="old_password" id="old_password"
                                        placeholder="From" value="{{ old('old_password') }}" required>
                                    <label for="old_password">Password Lama</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="gap-3 gap-sm-0 row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="From" value="{{ old('password') }}" required>
                                            <label for="password">Password Baru</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                                placeholder="To" value="{{ old('password_confirmation') }}" required>
                                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                <button type="reset" class="text-white btn btn-sm btn-warning">Reset</button>
                            </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
