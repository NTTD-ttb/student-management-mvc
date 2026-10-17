<div class="col-md-3">
    <div class="list-group mb-4">
        <a href="index.php?action=students" class="list-group-item list-group-item-action fw-bold active">
            Tất cả Sinh viên
        </a>
    </div>
    <div class="card">
        <div class="card-header bg-secondary text-white fw-bold">
            Lọc theo Lớp
        </div>
        <div class="list-group list-group-flush">
            <?php foreach ($classes as $c): ?>
                <a href="index.php?action=students&class_code=<?= $c['class_code'] ?>" 
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= (isset($_GET['class_code']) && $_GET['class_code'] == $c['class_code']) ? 'fw-bold text-primary bg-light' : '' ?>">
                    <?= htmlspecialchars($c['class_name']) ?>
                    <span class="badge bg-secondary rounded-pill"><?= htmlspecialchars($c['class_code']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>