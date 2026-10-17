<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="col-md-9">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>
            DANH SÁCH SINH VIÊN 
            <?php 
                if (isset($_GET['class_code'])) {
                    echo "- LỚP " . htmlspecialchars($_GET['class_code']);
                }
            ?>
        </h4>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?action=student-create" class="btn btn-success">+ Thêm sinh viên</a>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover border align-middle">
            <thead class="table-dark">
                <tr>
                    <th>MSSV</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Lớp</th>
                    <th>Ngành</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Không có sinh viên nào trong danh sách.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $st): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($st->student_id) ?></strong></td>
                            <td><?= htmlspecialchars($st->fullname) ?></td>
                            <td><?= htmlspecialchars($st->email) ?></td>
                            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($st->class_name) ?></span></td>
                            <td><?= htmlspecialchars($st->major_name) ?></td>
                            <td class="text-center">
                                <a href="index.php?action=student-detail&id=<?= $st->student_id ?>" class="btn btn-info btn-sm">Xem</a>
                                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                    <a href="index.php?action=student-edit&id=<?= $st->student_id ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="index.php?action=student-delete&id=<?= $st->student_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sinh viên này?')">Xóa</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>