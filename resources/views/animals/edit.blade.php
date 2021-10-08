@extends('layout.app')

@section('title')
    Sunting Data Hewan
@endsection


@section('header')
    <h1 class="container" style="text-align: center; margin-top: 1em;">Sunting Data Hewan</h1>
@endsection

@section('body')
    <div class="container">
        {{-- <form action="/{{ $animal->id }}/saveedit" method="POST" enctype="multipart/form-data"> --}}
        <form action="{{route('simpan-data-edit-hewan', ['id'=>$animal->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @foreach ($formdata as $key => $value)
                @if ($key == 'name')
                    <div class="mb-3">
                        <label for="{{ $key }}" class="form-label">{{ $value[1] }}</label>
                        <input type="{{ $value[0] }}" class="form-control" id="{{ $key }}"
                            name="{{ $key }}" value="{{ $animal->name }}">
                    </div>
                @endif

                @if ($value[0] == 'file')
                    <input type="hidden" name="{{$key}}" value="{{$animal->image}}" >
                    <div class="mb-3">
                        <label for="{{ $key }}" class="form-label"
                            style="margin-top:1em">{{ $value[1] }}</label> <br>
                        <img src="{{ asset('/public/storage/images/' . $animal->image) }}" width="180px" height="140px"
                            alt="{{ $animal->image }}"> <br>
                        <input name="{{ $key }}" class="form-control" type="{{ $value[0] }}"
                            id="{{ $key }}" style="margin-top:1em" value="{{ $key }}">
                        @error($key)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                {{-- yang ini masih harus dicek dulu karena saat masuk halaman yang dicek malah nilai yang paling besar keknya harus make hidden input --}}
                @if ($key == 'numberoffoot')
                    <label for="{{ $key }}" class="form-label"
                        style="margin-top:1em">{{ $value[1] }}</label> <br>
                    <div class="form-check form-check-inline">
                        @foreach ($value[2] as $opsi => $nilai)
                            <input class="{{ $key }}" type="{{ $value[1] }}" name="{{ $key }}"
                                id="{{ $key }}" value="{{ $nilai }}">
                            <option value="{{ $nilai }}">{{ $nilai }}</option>
                        @endforeach
                    </div>
                @endif

                @if ($key == 'description')
                    <div class="mb-3">
                        <label for="{{ $key }}" class="form-label">{{ $value[1] }}</label>
                        <textarea class="form-control" id="{{ $key }}" name="{{ $key }}"
                            rows="10">{{ $animal->description }}</textarea>
                    </div>
                @endif

                @if ($key == 'suara')
                    <div class="mb-3">
                        <label for="{{ $key }}" class="form-label"
                            style="margin-top:1em">{{ $value[1] }}</label> <br>
                        <select name="{{ $key }}" class="form-select" style="margin-bottom: 1em"
                            aria-label="suarahewan">
                            <option selected>{{ $animal->suara }}</option>
                            @foreach ($value[2] as $opsi => $nilai)
                                <option value="{{ $nilai }}">{{ $nilai }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

            @endforeach
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a type="button" class="btn btn-success" href="{{route('daftar-hewan')}}">Kembali</a>
            </div>
        </form>
    </div>
@endsection
