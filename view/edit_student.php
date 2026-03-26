<?php
// edit_student.php
if (!isset($mode)) $mode = 'edit';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cập nhật sinh viên - Quản lý sinh viên</title>
    <link rel="stylesheet" href="styles/view.css" />
    <link rel="stylesheet" href="styles/normalize.css" />
</head>

<body>
    <h1>Quản lý sinh viên</h1>

    <div class="form-box">
        <h2>Cập nhật sinh viên</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?action=edit&id=<?= (int)($student['id'] ?? 0) ?>">
            <label for="name">Họ tên</label>
            <input type="text" id="name" name="name"
                value="<?= htmlspecialchars($name ?? '') ?>" required>

            <label for="major">Ngành học</label>
            <input type="text" id="major" name="major"
                value="<?= htmlspecialchars($major ?? '') ?>" required>

            <input type="submit" value="Cập nhật">
            <a href="index.php?action=list" class="btn btn-add" style="margin-left: 8px;">Quay lại danh sách</a>
        </form>
    </div>
</body>

</html>