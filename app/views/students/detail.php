<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<div class="col-md-8 offset-md-2">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">THÔNG TIN CHI TIẾT SINH VIÊN</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Mã số sinh viên</th>
                    <td><strong><?= htmlspecialchars($student->student_id) ?></strong></td>
                </tr>
                <tr>
                    <th>Họ và Tên</th>
                    <td><?= htmlspecialchars($student->fullname) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($student->email) ?></td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td><?= htmlspecialchars($student->phone) ?></td>
                </tr>
                <tr>
                    <th>Lớp học</th>
                    <td><?= htmlspecialchars($student->class_name) ?> (Mã: <?= htmlspecialchars($student->class_code) ?>)</td>
                </tr>
                <tr>
                    <th>Ngành đào tạo</th>
                    <td><?= htmlspecialchars($student->major_name) ?></td>
                </tr>
            </table>
            <a href="index.php?action=students&class_code=<?= $student->class_code ?>" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>