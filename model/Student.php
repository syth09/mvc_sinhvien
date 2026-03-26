<?php

class Student
{
    public $id;
    public $name;
    public $major;

    public function __construct($id, $name, $major)
    {
        $this->id = $id;
        $this->name = trim($name);
        $this->major = trim($major);
    }

    private static function getDataFile()
    {
        $dir = __DIR__ . '/../db';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return $dir . '/students_infor.json';
    }

    private static function loadData()
    {
        $file = self::getDataFile();
        if (!file_exists($file)) {
            $students = [
                ['id' => 1, 'name' => 'Johann S. Grimwald', 'major' => 'Information Technology'],
                ['id' => 2, 'name' => 'Trần Thị Huyển', 'major' => 'Accounting'],
                ['id' => 3, 'name' => 'Lee Haru', 'major' => 'Marketing'],
                ['id' => 4, 'name' => 'Kim Hannah', 'major' => 'Business Administration'],
                ['id' => 5, 'name' => 'Nguyễn Văn Phúc', 'major' => 'Computer Science'],
            ];
            file_put_contents($file, json_encode($students, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            return $students;
        }

        $content = file_get_contents($file);
        $data = json_decode($content, true);

        if (!is_array($data)) {
            return [];
        }

        return $data;
    }

    private static function saveData($students)
    {
        $file = self::getDataFile();
        file_put_contents($file, json_encode(array_values($students), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public static function all()
    {
        return self::loadData();
    }

    public static function find($id)
    {
        $students = self::loadData();
        foreach ($students as $student) {
            if ($student['id'] == $id) {
                return $student;
            }
        }
        return null;
    }

    public static function nextId()
    {
        $students = self::loadData();
        $ids = array_column($students, 'id');
        return empty($ids) ? 1 : max($ids) + 1;
    }

    public static function create($name, $major)
    {
        $students = self::loadData();
        $id = self::nextId();
        $students[] = ['id' => $id, 'name' => trim($name), 'major' => trim($major)];
        self::saveData($students);
        return $id;
    }

    public static function update($id, $name, $major)
    {
        $students = self::loadData();
        foreach ($students as $index => $student) {
            if ($student['id'] == $id) {
                $students[$index]['name'] = trim($name);
                $students[$index]['major'] = trim($major);
                self::saveData($students);
                return true;
            }
        }
        return false;
    }

    public static function delete($id)
    {
        $students = self::loadData();
        foreach ($students as $index => $student) {
            if ($student['id'] == $id) {
                array_splice($students, $index, 1);
                self::saveData($students);
                return true;
            }
        }
        return false;
    }

    public static function validate($name, $major)
    {
        $errors = [];
        if (trim($name) === '') {
            $errors[] = 'Họ tên không được để trống.';
        } elseif (mb_strlen(trim($name), 'UTF-8') < 3) {
            $errors[] = 'Họ tên phải có ít nhất 3 ký tự.';
        }

        if (trim($major) === '') {
            $errors[] = 'Ngành học không được để trống.';
        }

        return $errors;
    }
}
