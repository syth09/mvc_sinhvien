# MVC Student MVC## (PHP)

### 1. Cách chạy

- Cài đặt XAMPP (Apache + PHP) hoặc môi trường PHP tương đương.
- Truy cập tới thư mục `mvc_sinhvien` nằm trong `htdocs` thuộc về folder `XAMPP`
- ví dụ: `c:\xampp\htdocs\mvc_sinhvien`
- Khởi động Apache.
- Truy cập trình duyệt: `http://localhost/mvc_sinhvien/index.php`

2. Các chức năng đã làm

- Lấy danh sách sinh viên (list) với phân trang (5 bản ghi/trang).
- Tìm kiếm theo tên (`q` query string).
- Thêm sinh viên mới (`add_student.php`).
- Sửa sinh viên (`edit_student.php`).
- Xóa sinh viên (`action=delete&id={id}`).
- Lưu dữ liệu vào `data/students.json` (đọc/ghi file JSON).
- Validation đầu vào: tên không rỗng, >=3 ký tự; ngành không rỗng.

3. Phần nâng cao (nếu có)

- Hiện đã có phân trang và tìm kiếm cơ bản.
- Có thể mở rộng:
  - Chuyển `students_infor.json` sang DB như MySQL/MySQLi/Oracle/Postgre để xử lý dữ liệu lớn.
  - Thêm phân quyền, xác thực người dùng.
  - Thêm xử lý upload ảnh cho sinh viên
