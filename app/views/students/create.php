<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<div class="col-md-8 offset-md-2">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">THÊM MỚI SINH VIÊN HỌC THEO LỚP</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST" action="index.php?action=student-create">
                <div class="mb-3">
                    <label class="form-label">Mã số sinh viên (MSSV)</label>
                    <input type="text" name="student_id" class="form-control" placeholder="Ví dụ: 210000004" maxlength="9" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Họ và Tên</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Chọn Lớp học</label>
                    <select name="class_code" class="form-select" required>
                        <option value="">-- Chọn Lớp --</option>
                        <?php foreach ($classes as $c): ?>
                            <option value="<?= $c['class_code'] ?>">
                                <?= htmlspecialchars($c['class_name']) ?> (<?= htmlspecialchars($c['major_name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Lưu sinh viên</button>
                <a href="index.php?action=students" class="btn btn-secondary">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>