@extends('layout.app')

@section('title', 'Data Hewan')

@section('header')
    <h1 class="container" style="text-align: center; margin-top: 1em;">Tambah Data Hewan</h1>
@endsection

@section('body')
    <form action="{{route('simpan-data-hewan')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            @if (session('status'))
                <h6 class="alert alert-success"> {{ session('status') }}</h6>
            @endif
            <div class="mb-3">
                <label for="name" class="form-label" style="margin-top:1em">Nama Hewan</label>
                <input name="name" type="text" class="form-control" id="namahewan" placeholder="Nama Hewan" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label" style="margin-top:1em">Input Gambar Hewan</label>
                <input name="image" class="form-control" type="file" id="gambarhewan" required>
            </div>

            <label for="number_of_foot" class="form-label" style="margin-top:1em">Pilih Jumlah Kaki</label> <br>

            <div class="form-check form-check-inline">
                <input name="number_of_foot" class="form-check-input" type="checkbox" id="kakihewandua" value="2">
                <label class="form-check-label" for="kakihewandua">2 Kaki</label>
            </div>

            <div class="form-check form-check-inline">
                <input name="number_of_foot" class="form-check-input" type="checkbox" id="kakihewanempat" value="4">
                <label class="form-check-label" for="kakihewanempat">4 Kaki</label>
            </div>

            <br>

            <div class="mb-3">
                <label for="suara" class="form-label" style="margin-top:1em">Pilih Suara Hewan</label> <br>
                <select name="suara" class="form-select" aria-label="suarahewan">
                    <option selected>Suara</option>
                    <option value="Mengonggong">Mengonggong</option>
                    <option value="Mengeong">Mengeong</option>
                    <option value="Mengaung">Mengaung</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label" style="margin-top:1em">Deskripsi </label>
                <textarea name="description" class="form-control" id="deskripsi" rows="3">Ketik Deskripsi Hewan</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a type="button" class="btn btn-success" href="{{route('daftar-hewan')}}">Kembali</a>
        </div>
    </form>
@endsection
