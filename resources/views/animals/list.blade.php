@extends('layout.app')

@section('title', 'Data Hewan')

@section('header')
    <h1 class="container" style="text-align: center; margin-top: 1em; margin-bottom: 1em">Daftar Data Hewan</h1>
@endsection

@section('body')
    <div class="container">
        {{-- untuk memberikan status yang sudah dituliskan --}}
        @if (session('status'))
            <h6 class="alert alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </h6>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <caption>Daftar Hewan Dari Database</caption>
                <thead>
                    <tr>
                        <th scope="col">NOMOR</th>
                        <th scope="col">Nama Hewan</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Suara</th>
                        <th scope="col">Jumlah Kaki</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Tombol Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($animals as $animal)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 + ($animals->currentPage() - 1) * 5 }}</th>
                            <td>{{ $animal->name }}</td>
                            <td>
                                <img src="{{ asset('/public/storage/images/' . $animal->image) }}" width="180px"
                                    height="140px" alt="{{ $animal->image }}">
                            </td>
                            <td>{{ $animal->suara }}</td>
                            <td>{{ $animal->number_of_foot }}</td>
                            <td>{{ Str::limit($animal->description, 50) }}</td>
                            <td>
                                <form action="{{ route('hapus-data-hewan', ['id' => $animal->id]) }}" method="POST"
                                    onsubmit="return confirm('Apakah Data ini ingin dihapus?')">
                                    <div class="btn-group" role="group" aria-label="Basic mixed style example">
                                        @csrf
                                        {{-- <a href="/{{ $animal->id }}/detail" type="button" class="btn btn-success">Detail</a> --}}
                                        {{-- <a href="/{{ $animal->id }}/sunting" type="button" class="btn btn-warning">Sunting</a> --}}
                                        <a href="{{ route('detail-data-hewan', ['id' => $animal->id]) }}" type="button"
                                            class="btn btn-success">Detail</a>
                                        <a href="{{ route('edit-data-hewan', ['id' => $animal->id]) }}" type="button"
                                            class="btn btn-warning">Sunting</a>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $animals->links() }}
        <div class="mb-3">
            <div class="btn-group-lg" role="group" aria-label="Basic example">
                <a style="position: right;" type="button" class="btn btn-info" href="{{ route('tambah-data-hewan')}}">Tambah Data Hewan</a>
            </div>
        </div>
    </div>
@endsection
