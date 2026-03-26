<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="styles/view.css" />
    <link rel="stylesheet" href="styles/normalize.css" />
</head>

<body>
    <h1>Quản lý sinh viên</h1>

    <div class="actions" style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
        <form method="get" action="index.php" style="margin:0; display:inline-flex; gap:8px; align-items:center;">
            <input type="hidden" name="action" value="list" />
            <input type="text" name="q" placeholder="Tìm theo tên..."
                value="<?= htmlspecialchars($q ?? '') ?>"
                style="padding: 6px; border: 1px solid #ccc; border-radius: 3px;" />
            <input type="submit" value="Tìm" class="btn btn-edit" style="padding: 6px 12px;" />
        </form>
        <a href="index.php?action=add" class="btn btn-add">Thêm sinh viên</a>
    </div>

    <?php if (isset($totalStudents)): ?>
        <p style="margin-bottom: 10px;">
            Tổng sinh viên: <strong><?= $totalStudents ?></strong>
            <?php if ($q !== ''): ?>, tìm với "<?= htmlspecialchars($q) ?>"<?php endif; ?>.
        </p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Ngành học</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Không có sinh viên nào.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['major']) ?></td>
                        <td>
                            <a class="btn btn-edit" href="index.php?action=edit&id=<?= $student['id'] ?>">Edit</a>
                            <a class="btn btn-delete" href="index.php?action=delete&id=<?= $student['id'] ?>"
                                onclick="return confirm('Xóa sinh viên này?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($totalPages) && $totalPages > 1): ?>
        <div style="margin-top: 10px;">
            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <?php
                $query = http_build_query(['action' => 'list', 'q' => $q ?? '', 'page' => $p]);
                ?>
                <?php if ($p == ($page ?? 1)): ?>
                    <a class="btn btn-edit" style="background: #6c757d;"
                        href="index.php?<?= $query ?>"><?= $p ?></a>
                <?php else: ?>
                    <a class="btn btn-edit" href="index.php?<?= $query ?>"><?= $p ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

</body>

</html>