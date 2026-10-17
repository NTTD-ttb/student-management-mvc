-- Khoi tao CSDL demo quan ly sinh vien (MariaDB/MySQL)
-- Chi chay lan dau tren CSDL trong hoac CSDL chua ton tai.
CREATE DATABASE IF NOT EXISTS `student_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `student_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `username` VARCHAR(50) NOT NULL PRIMARY KEY,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `majors` (
  `major_code` VARCHAR(5) NOT NULL PRIMARY KEY,
  `major_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `classes` (
  `class_code` VARCHAR(15) NOT NULL PRIMARY KEY,
  `class_name` VARCHAR(100) NOT NULL,
  `major_code` VARCHAR(5) NOT NULL,
  CONSTRAINT `fk_classes_majors` FOREIGN KEY (`major_code`) REFERENCES `majors` (`major_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` VARCHAR(9) NOT NULL PRIMARY KEY,
  `fullname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `class_code` VARCHAR(15) NOT NULL,
  CONSTRAINT `fk_students_classes` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- các Hash mẫu dưới đây đều là mã hóa bằng hàm password_hash() với tham số mặc định PASSWORD_DEFAULT của 123456 
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', '$2y$10$tu2/OFTNZ9Z6rJIlbOf3oe0Fa97MpH/vHdx/mqaOzrKxjCYe09.9u', 'admin'),
('user1', '$2y$10$nbZkNZaoKSqLG.pNlnJt3OnpmZZm49Fq9ZU3nALVl0PqkudzCeUci', 'user');

INSERT INTO `majors` (`major_code`, `major_name`) VALUES
('CNTT', 'Công nghệ Thông tin'),
('QTKD', 'Quản trị Kinh doanh');

INSERT INTO `classes` (`class_code`, `class_name`, `major_code`) VALUES
('DA23TTB', 'Đại học Công nghệ thông tin B 2023', 'CNTT'),
('DA23TTD', 'Đại học Công nghệ thông tin D 2023', 'CNTT'),
('DA23QKA', 'Đại học Quản trị kinh doanh A 2023', 'QTKD');

INSERT INTO `students` (`student_id`, `fullname`, `email`, `phone`, `class_code`) VALUES
('110123001', 'Nguyễn Văn An', 'an.nguyen@gmail.com', '0901234567', 'DA23TTB'),
('110123002', 'Trần Thị Bình', 'binh.tran@gmail.com', '0912345678', 'DA23TTB'),
('210723001', 'Lê Hoàng Cường', 'cuong.le@gmail.com', '0923456789', 'DA23TTD');
