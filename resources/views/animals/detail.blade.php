@extends('layout.app')

@section('title', 'Data Hewan')

@section('header')
    <h1 class="container" style="text-align: center; margin-top: 1em;">Detail Data Hewan</h1>
@endsection

@section('body')
    <div class="container">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hewan</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $animal->name }}" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Foto Hewan</label> <br>
            <input type="text" class="form-control" id="name" name="name" value="{{ $animal->image }}" readonly>
            <img src="{{ asset('/public/storage/images/' . $animal->image) }}" style="margin-top:1em" width="170px" height="140px"
                alt="{{ $animal->image }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Suara Hewan</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $animal->suara}}" readonly>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Jumlah Kaki Hewan</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $animal->number_of_foot}}" readonly>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Hewan</label>
            <textarea class="form-control" id="description" name="description" rows="10"
                readonly>{{ $animal->description }}</textarea>
        </div>

        <a type="button" class="btn btn-success" href="{{ route('daftar-hewan') }}">Kembali</a>
    </div>
@endsection
