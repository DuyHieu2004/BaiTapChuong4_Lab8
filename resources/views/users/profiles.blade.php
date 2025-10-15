<!DOCTYPE html>
<html>
<head>
    <title>Danh sách User và Profile</title>
    <style>
        body { font-family: sans-serif; }
        .user-card { border: 1px solid #ccc; margin-bottom: 15px; padding: 15px; border-radius: 5px; }
        .user-card strong { color: #007bff; }
    </style>
</head>
<body>

    <h1>Danh sách User và Profile (Quan hệ One-to-One)</h1>

    @foreach ($users as $user)
        <div class="user-card">
            <h3>User ID: {{ $user->id }} - <strong>{{ $user->name }}</strong></h3>
            <p>Email: {{ $user->email }}</p>

            {{-- Kiểm tra xem User có Profile không --}}
            @if ($user->profile)
                <h4>Thông tin Profile:</h4>
                <ul>
                    <li>Địa chỉ: {{ $user->profile->address }}</li>
                    <li>Điện thoại: {{ $user->profile->phone }}</li>
                </ul>
            @else
                <p style="color: red;">(Chưa có thông tin Profile)</p>
            @endif
        </div>
    @endforeach

</body>
</html>
