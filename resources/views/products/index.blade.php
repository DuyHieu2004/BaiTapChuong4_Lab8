@extends('layouts.app')

@section('title', 'Danh sách Sản phẩm')

@section('content')
    <h2 class="mb-4">Danh sách sản phẩm</h2>

    {{-- Hiển thị thông báo thành công (sử dụng alert Bootstrap) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Nút Thêm mới --}}
        <a href="{{ route('products.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> + Thêm Sản phẩm Mới
        </a>

        {{-- Các Nút Lọc theo Giá --}}
        <div class="btn-group" role="group" aria-label="Lọc theo giá">
            {{-- Nút Tất Cả Sản phẩm --}}
            <a href="{{ route('products.index') }}"
               class="btn {{ $currentFilter == null && $currentCategory == null ? 'btn-info' : 'btn-outline-info' }}">
                Tất Cả Sản phẩm
            </a>

            {{-- Nút Giá > 100,000 --}}
            <a href="{{ route('products.index', ['filter' => 'expensive', 'category_id' => $currentCategory]) }}"
               class="btn {{ $currentFilter == 'expensive' ? 'btn-info' : 'btn-outline-info' }}">
                Giá > 100.000 đ
            </a>
        </div>
    </div>

    {{-- Combobox Lọc theo Danh mục và Đếm Sản phẩm --}}
    <div class="d-flex align-items-center mb-4 p-3 bg-light border rounded">
        <label for="category_filter" class="form-label me-3 mb-0 fw-bold text-primary">Lọc theo Danh mục:</label>

        <form id="category-filter-form" action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center">
            {{-- Giữ lại bộ lọc giá hiện tại khi đổi danh mục --}}
            <input type="hidden" name="filter" value="{{ $currentFilter }}">

            <select name="category_id" id="category_filter" class="form-select w-auto me-3" onchange="document.getElementById('category-filter-form').submit()">
                <option value="all" {{ $currentCategory == 'all' || $currentCategory == null ? 'selected' : '' }}>-- Tất cả Danh mục ({{ $products->total() }} sản phẩm) --</option>

                @foreach ($categoriesWithCount as $category)
                    <option value="{{ $category->id }}" {{ $currentCategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }} ({{ $category->products_count }})
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Nút để submit form nếu người dùng không dùng onchange (tùy chọn) --}}
        {{-- <button type="submit" class="btn btn-secondary">Lọc</button> --}}
    </div>

    {{-- Bảng danh sách sản phẩm --}}
    <table class="table table-hover table-striped shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ number_format($p->price, 0, ',', '.') }} đ</td> {{-- Định dạng lại giá tiền cho dễ đọc --}}
                    <td>{{ $p->category->name }}</td>
                    <td>
                        {{-- Nút Sửa --}}
                        <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-warning me-2">Sửa</a>

                        {{-- Nút Xóa (Dùng Form để gửi DELETE request) --}}
                        <form action="{{ route('products.destroy', $p) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm {{ $p->name }}?')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Không tìm thấy sản phẩm nào phù hợp với điều kiện lọc.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Phân trang (Sử dụng Bootstrap link) --}}
    <div class="d-flex justify-content-center">
        {{ $products->appends(['filter' => $currentFilter, 'category_id' => $currentCategory])->links() }}
    </div>

    <div class="text-center mt-3 text-muted">
        {{-- Hiển thị thông tin phân trang --}}
        Hiển thị {{ $products->firstItem() }} đến {{ $products->lastItem() }} trong tổng số {{ $products->total() }} kết quả.
    </div>

@endsection
