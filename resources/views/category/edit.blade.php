@extends('layout.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit {{ $title }}</h5>
                        <form class="row g-3" action="{{ route('category.update', $category->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Name" value="{{$category->name}}">
                                    <label for="floatingName">Nama Kategori</label>
                                </div>
                            </div>
                            <div class="text-start">
                                <button type="submit" class="btn btn-sm btn-success">Ubah</button>
                                <button type="reset" class="btn btn-sm btn-warning text-white">Reset</button>
                            </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
