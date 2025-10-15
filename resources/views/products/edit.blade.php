@extends('layouts.app')

@section('title', 'Sửa Sản phẩm')

@section('content')
<h2>Chỉnh sửa Sản phẩm: {{ $product->name }}</h2>

<form method="POST" action="{{ route('products.update', $product) }}" style="max-width: 600px; margin: 0 auto;">
    @csrf
    @method('PUT') {{-- Bắt buộc phải có @method('PUT') cho thao tác UPDATE --}}

    {{-- $product và $categories được truyền từ ProductController::edit() --}}
    @include('products._form')

    <button type="submit" style="background-color: #ff9800; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px;">
        Cập nhật
    </button>
    <a href="{{ route('products.index') }}" style="margin-left: 10px; color: #2b6cb0;">Quay lại danh sách</a>
</form>
@endsection
