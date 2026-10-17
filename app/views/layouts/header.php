<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?action=students">QLSV MVC</a>
        <div class="d-flex align-items-center text-white">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="me-3">Xin chào, <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong> (<?= htmlspecialchars($_SESSION['user']['role']) ?>)</span>
                <a href="index.php?action=logout" class="btn btn-danger btn-sm">Đăng xuất</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mb-5">
    <div class="row">