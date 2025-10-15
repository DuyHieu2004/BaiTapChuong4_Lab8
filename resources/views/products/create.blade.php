@extends('layouts.app')

@section('title', 'Thêm Sản phẩm')

@section('content')
<h2>Thêm Sản phẩm Mới</h2>

<form method="POST" action="{{ route('products.store') }}" style="max-width: 600px; margin: 0 auto;">
    @csrf

    {{-- $categories được truyền từ ProductController::create() --}}
    @include('products._form', ['product' => new \App\Models\Product()])

    <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px;">
        Lưu Sản phẩm
    </button>
    <a href="{{ route('products.index') }}" style="margin-left: 10px; color: #2b6cb0;">Quay lại danh sách</a>
</form>
@endsection
