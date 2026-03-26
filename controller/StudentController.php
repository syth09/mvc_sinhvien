<?php
require_once __DIR__ . '/../model/Student.php';

class StudentController
{
    public function list()
    {
        $q = trim($_GET['q'] ?? '');
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 5;

        $students = Student::all();

        if ($q !== '') {
            $students = array_filter($students, function ($student) use ($q) {
                return mb_stripos($student['name'], $q, 0, 'UTF-8') !== false;
            });
        }

        $totalStudents = count($students);
        $totalPages = $totalStudents > 0 ? (int)ceil($totalStudents / $perPage) : 1;
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $start = ($page - 1) * $perPage;
        $students = array_slice($students, $start, $perPage);

        include __DIR__ . '/../view/student_view.php';
    }

    public function add()
    {
        $errors = [];
        $name = '';
        $major = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $major = $_POST['major'] ?? '';
            $errors = Student::validate($name, $major);

            if (empty($errors)) {
                Student::create($name, $major);
                header('Location: index.php?action=list');
                exit;
            }
        }

        $mode = 'add';
        include __DIR__ . '/../view/add_student.php';
    }

    public function edit($id)
    {
        $errors = [];
        $student = Student::find($id);
        if (!$student) {
            header('Location: index.php?action=list');
            exit;
        }

        $name = $student['name'];
        $major = $student['major'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $major = $_POST['major'] ?? '';
            $errors = Student::validate($name, $major);

            if (empty($errors)) {
                Student::update($id, $name, $major);
                header('Location: index.php?action=list');
                exit;
            }
        }

        $mode = 'edit';
        include __DIR__ . '/../view/edit_student.php';
    }

    public function delete($id)
    {
        Student::delete($id);
        header('Location: index.php?action=list');
        exit;
    }
}
