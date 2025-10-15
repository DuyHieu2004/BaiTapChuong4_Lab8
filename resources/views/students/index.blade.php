@extends('layouts.app')
@section('content')
    <h2>Danh sách sinh viên và các môn học đã đăng ký</h2>
    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Môn học</th>
                {{-- ĐÃ THÊM: Cột tiêu đề mới --}}
                <th class="text-center">Số lượng Môn học</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td>
                        {{-- Hiển thị danh sách môn học dưới dạng tag (badge) cho đẹp --}}
                        @forelse ($s->courses as $c)
                            <span class="badge bg-primary me-1">{{ $c->title }}</span>
                        @empty
                            <span class="text-muted fst-italic">Chưa đăng ký</span>
                        @endforelse
                    </td>
                    {{-- ĐÃ THÊM: Cột dữ liệu mới, hiển thị thuộc tính courses_count --}}
                    <td class="fw-bold text-center">{{ $s->courses_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
