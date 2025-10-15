<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm - @yield('title')</title>
    <style>


    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body>
    <div class="container">
        <header>
            <h1 style="text-align: center; color: #2b6cb0; font-size: 2.5rem; margin-bottom: 20px;">
                HỆ THỐNG QUẢN LÝ SẢN PHẨM
            </h1>
        </header>

        <main>
            <!-- Đây là nơi nội dung từ index.blade.php sẽ được nhúng vào -->
            @yield('content')
        </main>

        <footer style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: center; color: #718096;">
            <p>&copy; 2025 Quản Lý Sản Phẩm Laravel. Đồ án LTMNM.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
