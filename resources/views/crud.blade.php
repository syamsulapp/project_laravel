@extends('main.app')


@section('judul','halaman crud')


@section('konten')


<div class="container">
    @if(Session::has('flash'))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Pesan Sistem!</h4>
        <p>{{ session('flash') }}</p>
        <hr>
    </div>
    @endif
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Forms</h4>
                    <p class="card-text">
                        <form action="{{ route('AddData') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" placeholder="masukan nim" value="{{ old('nim') }}">
                            @error('nim')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" name="nrcs" value="{{ $format }}" readonly>
                            <br>
                            <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" placeholder="masukan nama" value="{{ old('nama') }}">
                            @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <br>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="masukan email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <br>
                            <input type="text" class="form-control  @error('jurusan') is-invalid @enderror" name="jurusan" placeholder="masukan jurusan" value="{{ old('jurusan') }}">
                            @error('jurusan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <br>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="Tidak Di Upload">
                            @error('foto')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <h3>List Data</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>email</th>
                    <th>jurusan</th>
                    <th>gambar</th>
                    <th>opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $d)
                @php $path = Storage::url('foto/'.$d->foto); @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nim }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->email }}</td>
                    <td>{{ $d->jurusan }}</td>
                    <td><img src="{{ url($path) }}" width="256" height="128" alt="foto tidak di upload"></td>
                    <td><a href="{{ url($path) }}">Download</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection