-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2023 lúc 06:10 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_final`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_tbl`
--

CREATE TABLE `bill_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` char(255) NOT NULL,
  `phone` char(10) DEFAULT NULL,
  `idShedule` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class_schedule`
--

CREATE TABLE `class_schedule` (
  `id` int(11) NOT NULL,
  `idTeacher` int(11) NOT NULL,
  `schedule` text DEFAULT NULL,
  `idCourse` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image` char(200) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `idCourseCate` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `detail` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_cates`
--

CREATE TABLE `course_cates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idEdu` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `edu_tbl`
--

CREATE TABLE `edu_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `process_detail`
--

CREATE TABLE `process_detail` (
  `id` int(11) NOT NULL,
  `idProcess` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `process_tbl`
--

CREATE TABLE `process_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idTeacher` int(11) NOT NULL,
  `schedules` char(255) NOT NULL,
  `idCourse` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `pass` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_tbl`
--

CREATE TABLE `role_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role_tbl`
--

INSERT INTO `role_tbl` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'student', 0, '2023-11-18 16:00:36', '2023-11-19 03:30:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students_tbl`
--

CREATE TABLE `students_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` char(100) NOT NULL,
  `email` char(255) NOT NULL,
  `phone` char(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` char(80) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idRole` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `phone` char(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `idRole`, `status`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'niam', 'niamcoder@gmail.com', 1, 1, NULL, NULL, '$2y$12$UEL/i1Gq8ZnnLuvXHfRnOuyMjJoHzbbg8aoOKbfft6T3cnkl6Ek8.', NULL, '2023-11-22 12:37:46', '2023-11-22 12:37:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill_tbl`
--
ALTER TABLE `bill_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_teacher` (`idTeacher`),
  ADD KEY `id_course` (`idCourse`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_course_cate` (`idCourseCate`);

--
-- Chỉ mục cho bảng `course_cates`
--
ALTER TABLE `course_cates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_edu` (`idEdu`);

--
-- Chỉ mục cho bảng `edu_tbl`
--
ALTER TABLE `edu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `process_detail`
--
ALTER TABLE `process_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`idStudent`);

--
-- Chỉ mục cho bảng `process_tbl`
--
ALTER TABLE `process_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`idTeacher`),
  ADD KEY `course` (`idCourse`);

--
-- Chỉ mục cho bảng `role_tbl`
--
ALTER TABLE `role_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`idRole`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill_tbl`
--
ALTER TABLE `bill_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `course_cates`
--
ALTER TABLE `course_cates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `edu_tbl`
--
ALTER TABLE `edu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `process_detail`
--
ALTER TABLE `process_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `process_tbl`
--
ALTER TABLE `process_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role_tbl`
--
ALTER TABLE `role_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `students_tbl`
--
ALTER TABLE `students_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD CONSTRAINT `id_course` FOREIGN KEY (`idCourse`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `id_teacher` FOREIGN KEY (`idTeacher`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `id_course_cate` FOREIGN KEY (`idCourseCate`) REFERENCES `course_cates` (`id`);

--
-- Các ràng buộc cho bảng `course_cates`
--
ALTER TABLE `course_cates`
  ADD CONSTRAINT `id_edu` FOREIGN KEY (`idEdu`) REFERENCES `edu_tbl` (`id`);

--
-- Các ràng buộc cho bảng `process_detail`
--
ALTER TABLE `process_detail`
  ADD CONSTRAINT `id_process` FOREIGN KEY (`idProcess`) REFERENCES `process_tbl` (`id`),
  ADD CONSTRAINT `id_student` FOREIGN KEY (`idStudent`) REFERENCES `students_tbl` (`id`);

--
-- Các ràng buộc cho bảng `process_tbl`
--
ALTER TABLE `process_tbl`
  ADD CONSTRAINT `course` FOREIGN KEY (`idCourse`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `teacher` FOREIGN KEY (`idTeacher`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_role` FOREIGN KEY (`idRole`) REFERENCES `role_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
