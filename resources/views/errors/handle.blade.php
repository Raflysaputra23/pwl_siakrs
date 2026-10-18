@extends('layouts.app')

@section('content')
<div class="h-full text-center flex flex-col justify-center items-center gap-2">
    <h1 class="text-3xl font-bold text-red-600">Terjadi Kesalahan Sistem</h1>
    <a href="{{ route('/') }}" class="px-3 py-2 rounded-xl bg-primary text-white">Kembali ke beranda</a>
</div>
@endsection