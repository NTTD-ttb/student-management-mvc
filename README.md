# Student Management MVC — Hướng dẫn khởi tạo dự án

Dự án minh họa mô hình **MVC thuần PHP** cho ứng dụng quản lý sinh viên, sử dụng **PHP, MySQL/MariaDB, XAMPP và Visual Studio Code**.

> Tài liệu này hướng dẫn **tạo bộ khung thư mục và file rỗng**. Chưa bao gồm mã nguồn xử lý nghiệp vụ, cấu hình cơ sở dữ liệu hay chức năng đăng nhập/CRUD.

## 1. Chuẩn bị

- Máy tính Windows 10/11.
- XAMPP đã được cài đặt (ví dụ tại `C:\xampp`).
- Visual Studio Code (VS Code).
- Terminal **PowerShell** (có sẵn trên Windows).

## 2. Tạo thư mục gốc

Mở File Explorer, truy cập:

```text
C:\xampp\htdocs
```

Tạo thư mục `TH_LTWEB` nếu chưa có, sau đó tạo thư mục `student-management-mvc` bên trong. Đường dẫn cuối cùng là:

```text
C:\xampp\htdocs\TH_LTWEB\student-management-mvc
```

> Nếu XAMPP được cài ở vị trí khác, hãy thay `C:\xampp` bằng đường dẫn thực tế.

## 3. Mở dự án bằng VS Code

1. Mở **Visual Studio Code**.
2. Chọn **File → Open Folder...**.
3. Chọn thư mục `C:\xampp\htdocs\TH_LTWEB\student-management-mvc`.
4. Chọn **Select Folder**. Nếu VS Code hỏi có tin cậy thư mục không, chỉ chấp nhận nếu đây là thư mục do bạn tạo hoặc nguồn đáng tin cậy.

## 4. Mở Terminal và kiểm tra đường dẫn

Trong VS Code, chọn **Terminal → New Terminal**.

Kiểm tra Terminal đang dùng **PowerShell** (thường có tiền tố `PS`). Nếu không phải, chọn mũi tên cạnh dấu `+` trong bảng Terminal và chọn **PowerShell**.

Nếu Terminal chưa ở thư mục gốc, chạy:

```powershell
cd C:\xampp\htdocs\TH_LTWEB\student-management-mvc
```

Để xem đường dẫn hiện tại, chạy:

```powershell
Get-Location
```

Kết quả cần trỏ đến thư mục `student-management-mvc`.

## 5. Tạo file script `create-structure.ps1`

Trong khung **Explorer** của VS Code, nhấp **New File** tại thư mục gốc và đặt tên:

```text
create-structure.ps1
```

Sao chép đoạn mã dưới đây vào file, sau đó nhấn **Ctrl + S** để lưu:

```powershell
# Script tao bo khung MVC thuan PHP.
# Chay tai thu muc goc cua du an.

$folders = @(
    "config",
    "routes",
    "app/models",
    "app/controllers",
    "app/views/layouts",
    "app/views/auth",
    "app/views/students",
    "public/css",
    "public/js"
)

$files = @(
    "config/DataBase.php",
    "routes/Router.php",
    "app/models/UserModel.php",
    "app/models/MajorModel.php",
    "app/models/ClassModel.php",
    "app/models/StudentModel.php",
    "app/controllers/AuthController.php",
    "app/controllers/StudentController.php",
    "app/views/layouts/header.php",
    "app/views/layouts/footer.php",
    "app/views/layouts/sidebar.php",
    "app/views/auth/login.php",
    "app/views/students/index.php",
    "app/views/students/detail.php",
    "app/views/students/create.php",
    "app/views/students/edit.php",
    "public/css/style.css",
    "public/index.php",
    "README.md"
)

# Xac dinh thu muc goc dua tren vi tri cua file script.
# Nho do script van dung khi Terminal dang o thu muc khac.
$root = $PSScriptRoot

foreach ($folder in $folders) {
    $path = Join-Path $root $folder
    New-Item -ItemType Directory -Path $path -Force | Out-Null
}

foreach ($file in $files) {
    $path = Join-Path $root $file
    if (-not (Test-Path -LiteralPath $path)) {
        New-Item -ItemType File -Path $path | Out-Null
    }
}

Write-Host "Da tao xong cau truc MVC!"
```

**Giải thích:** `$folders` chứa danh sách thư mục cần tạo; `$files` chứa danh sách file cần tạo. Script **không ghi đè các file đã tồn tại**. Biến `$PSScriptRoot` giúp xác định đúng thư mục chứa file script.

## 6. Thực thi script

Tại Terminal PowerShell đang ở thư mục gốc, chạy:

```powershell
.\create-structure.ps1
```

Nếu chạy thành công, Terminal hiển thị:

```text
Da tao xong cau truc MVC!
```

**Nếu xuất hiện lỗi `running scripts is disabled on this system`:** có thể sử dụng lệnh sau để thực thi file đáng tin cậy mà không thay đổi chính sách thực thi của toàn hệ thống:

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File .\create-structure.ps1
```

Chỉ thực thi script do chính mình tạo hoặc đã kiểm tra nội dung.

## 7. Kiểm tra kết quả

Trong Terminal, chạy:

```powershell
tree /F
```

Cấu trúc dự kiến:

```text
student-management-mvc/
├── config/
│   └── DataBase.php
├── routes/
│   └── Router.php
├── app/
│   ├── models/
│   │   ├── UserModel.php
│   │   ├── MajorModel.php
│   │   ├── ClassModel.php
│   │   └── StudentModel.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── StudentController.php
│   └── views/
│       ├── layouts/
│       │   ├── header.php
│       │   ├── footer.php
│       │   └── sidebar.php
│       ├── auth/
│       │   └── login.php
│       └── students/
│           ├── index.php
│           ├── detail.php
│           ├── create.php
│           └── edit.php
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   └── index.php
├── create-structure.ps1
└── README.md
```

> Cây trên là cách biểu diễn dễ đọc; lệnh `tree /F` trên Windows hiển thị bằng các ký tự đường nhánh hơi khác.

## 8. Vai trò của các thành phần chính

| Thành phần | Vai trò |
|---|---|
| `config/DataBase.php` | Khai báo lớp kết nối cơ sở dữ liệu qua PDO. |
| `routes/Router.php` | Định tuyến yêu cầu đến Controller phù hợp. |
| `app/models/` | Các lớp thao tác dữ liệu. |
| `app/controllers/` | Nhận yêu cầu và điều phối xử lý. |
| `app/views/` | Các giao diện hiển thị cho người dùng. |
| `public/index.php` | **Front Controller** — điểm vào của ứng dụng. |
| `public/css/`, `public/js/` | Tài nguyên giao diện công khai. |
| `create-structure.ps1` | Script tạo bộ khung thư mục và file. |

## 9. Lưu ý khi chạy ứng dụng

- Sau khi chạy script, các file PHP vẫn **rỗng**. Ứng dụng chưa thể hoạt động cho đến khi viết mã nguồn.
- Khi đã hoàn thiện phần định tuyến và xử lý, có thể thử truy cập `http://localhost/TH_LTWEB/student-management-mvc/public/` với Apache của XAMPP đang chạy.
- Trong triển khai thực tế, nên cấu hình Apache để thư mục `public/` là **DocumentRoot**, không công khai trực tiếp `app/` hoặc `config/`.
- Nếu chia sẻ dự án lên GitHub, hãy đưa cả `README.md` và `create-structure.ps1` vào repository để người khác có thể làm theo.

## 10. Câu hỏi tự kiểm tra

1. Vì sao phải mở Terminal tại đúng thư mục gốc của dự án?
2. File `.ps1` dùng để làm gì? Nó có phải file PHP không?
3. Vai trò của `public/index.php` khác gì với các file trong `app/views/`?
4. Nếu chạy lại script lần thứ hai, các file PHP đã viết có bị mất nội dung không?
