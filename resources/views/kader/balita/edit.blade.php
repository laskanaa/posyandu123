@extends('layouts.app')

@section('content')
    <div class="container">

        <h3>Edit Penimbangan Balita</h3>

        <form action="{{ route('balita.update', $balita->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Berat Badan</label>
                <input type="number" name="berat_badan" value="{{ $balita->berat_badan }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Tinggi Badan</label>
                <input type="number" name="tinggi_badan" value="{{ $balita->tinggi_badan }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>LILA</label>
                <input type="number" name="lila" value="{{ $balita->lila }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>LIKA</label>
                <input type="number" name="lika" value="{{ $balita->lika }}" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>

        </form>

    </div>
@endsection