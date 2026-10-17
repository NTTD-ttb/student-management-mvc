<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<div class="col-md-8 offset-md-2">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">CẬP NHẬT THÔNG TIN SINH VIÊN</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST" action="index.php?action=student-edit&id=<?= $student->student_id ?>">
                <div class="mb-3">
                    <label class="form-label">Mã số sinh viên (Chỉ xem)</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($student->student_id) ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Họ và Tên</label>
                    <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($student->fullname) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student->email) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($student->phone) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Chuyển sang Lớp học</label>
                    <select name="class_code" class="form-select" required>
                        <?php foreach ($classes as $c): ?>
                            <option value="<?= $c['class_code'] ?>" <?= ($student->class_code == $c['class_code']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['class_name']) ?> (<?= htmlspecialchars($c['major_name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning">Cập nhật</button>
                <a href="index.php?action=students&class_code=<?= $student->class_code ?>" class="btn btn-secondary">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>