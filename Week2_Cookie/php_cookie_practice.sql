-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-10-12 10:10:51
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE `php_cookie_practice`;
USE `php_cookie_practice`;
--
-- 資料庫： `php_cookie_practice`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cookie_login_record`
--

CREATE TABLE `cookie_login_record` (
  `Account` varchar(30) NOT NULL,
  `IP_Address` text NOT NULL,
  `LastLoginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `UTCTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cookie_login_record`
--

INSERT INTO `cookie_login_record` (`Account`, `IP_Address`, `LastLoginTime`, `UTCTime`) VALUES
('crystal', '10.99.0.228', '2021-10-12 08:08:10', '2021-10-12 00:08:10'),
('ewr', '10.99.2.40', '2021-10-12 07:57:11', '2021-10-11 23:57:11'),
('owo', '10.99.2.40', '2021-10-12 08:08:55', '2021-10-12 00:08:55'),
('qwq', '10.99.2.40', '2021-10-12 07:53:29', '2021-10-11 23:53:29'),
('ya', '10.99.2.40', '2021-10-12 04:51:11', '2021-10-11 20:51:11');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cookie_login_record`
--
ALTER TABLE `cookie_login_record`
  ADD PRIMARY KEY (`Account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
