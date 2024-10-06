<!DOCTYPE html>
<html>
<head>
    <title>Thông báo sách mới</title>
</head>
<body>
    <h1>Thông tin sách mới</h1>
    <p>Tên sách: {{ $book['title'] ?? 'Không có tên' }}</p>
    <p>Tác giả: {{ $book['author'] ?? 'Không có tác giả' }}</p>
    <p>Năm xuất bản: {{ $book['published_year'] ?? 'Không có năm xuất bản' }}</p>
    <p>Mã sách: {{ $book['code'] ?? 'Không có mã' }}</p>
</body>
</html>
