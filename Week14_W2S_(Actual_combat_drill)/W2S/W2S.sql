-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2012 年 03 月 27 日 11:11
-- 伺服器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `walktoschool`
--
CREATE DATABASE `walktoschool` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `walktoschool`;

-- --------------------------------------------------------

--
-- 表的結構 `apply_info`
--

CREATE TABLE IF NOT EXISTS `apply_info` (
  `apply_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '評核編號',
  `area_code` char(2) NOT NULL COMMENT '縣市別',
  `school_name` varchar(200) NOT NULL COMMENT '學校名稱',
  `contact_name` varchar(20) NOT NULL COMMENT '聯絡人姓名',
  `contact_tel` varchar(20) NOT NULL COMMENT '聯絡電話',
  `contact_fax` varchar(20) NOT NULL COMMENT '聯絡傳真',
  `contact_email` varchar(100) NOT NULL COMMENT '聯絡email',
  `status` char(1) NOT NULL COMMENT '狀態',
  `note` varchar(1000) DEFAULT NULL COMMENT '備註',
  `review_id` int(11) DEFAULT NULL COMMENT '審核人員',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  `apply_url` varchar(400) DEFAULT NULL COMMENT '學校首頁或相關活動連結網址',
  `apply_note` varchar(1000) DEFAULT NULL COMMENT '學校推動走路上學現況說明',
  PRIMARY KEY (`apply_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='報名學校基本資料檔' AUTO_INCREMENT=128 ;

--
-- 轉存資料表中的資料 `apply_info`
--

INSERT INTO `apply_info` (`apply_no`, `area_code`, `school_name`, `contact_name`, `contact_tel`, `contact_fax`, `contact_email`, `status`, `note`, `review_id`, `join_date`, `modify_date`, `apply_url`, `apply_note`) VALUES
(1, '02', '報名學校11', '連絡人1', '00-00000000', '00-00000000', '00@000.000.000', '2', 'note1note2note3', 25, '2008-08-30 00:34:10', '2008-08-30 16:56:13', NULL, NULL),
(2, '02', '報名學校2', '連絡人2', '00-00000000', '00-00000000', '00@000.000.000', '1', '111222', NULL, '2008-08-30 00:34:10', '2008-08-30 01:54:37', NULL, NULL),
(3, '02', '報名學校3', '連絡人3', '00-00000000', '00-00000000', '00@000.000.000', '2', 'note', 25, '2008-08-30 00:35:04', '2008-09-08 18:12:28', NULL, NULL),
(4, '02', '報名學校4', '連絡人4', '00-00000000', '00-00000000', '00@000.000.000', '3', 'note\r\n222\r\n333', 25, '2008-08-30 00:35:04', '2008-08-30 16:55:47', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的結構 `banner_info`
--

CREATE TABLE IF NOT EXISTS `banner_info` (
  `banner_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '廣告編號',
  `title` varchar(200) NOT NULL COMMENT '廣告名稱',
  `pic_no` int(11) NOT NULL COMMENT '圖片編號',
  `pic_url` varchar(300) NOT NULL COMMENT '廣告URL',
  `start_date` date NOT NULL COMMENT '啟用日期',
  `expire_date` date NOT NULL COMMENT '到期日期',
  `join_id` int(11) NOT NULL COMMENT '建檔人員',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  `type` char(1) NOT NULL COMMENT '區塊類別',
  PRIMARY KEY (`banner_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='廣告基本資料檔' AUTO_INCREMENT=7 ;

--
-- 轉存資料表中的資料 `banner_info`
--

INSERT INTO `banner_info` (`banner_no`, `title`, `pic_no`, `pic_url`, `start_date`, `expire_date`, `join_id`, `join_date`, `modify_date`, `type`) VALUES
(4, 'ad6', 91, 'http://walktoschool.ty.ntsu.edu.tw/bbb', '2008-08-31', '2013-09-18', 25, '2008-09-01 22:40:11', '2008-09-17 14:47:58', '1'),
(5, 'AD2', 85, 'http://walktoschool.ty.ntsu.edu.tw/aaa', '2008-09-09', '2015-09-15', 25, '2008-09-08 17:52:33', '2008-09-16 14:50:39', '2');

-- --------------------------------------------------------

--
-- 表的結構 `comment_info`
--

CREATE TABLE IF NOT EXISTS `comment_info` (
  `schedule_no` int(11) NOT NULL COMMENT '行程編號',
  `f01` char(1) DEFAULT NULL,
  `f02` char(1) DEFAULT NULL,
  `f03` char(1) DEFAULT NULL,
  `f04` char(1) DEFAULT NULL,
  `f05` char(1) DEFAULT NULL,
  `f06` varchar(3000) DEFAULT NULL,
  `f111` char(1) DEFAULT NULL,
  `f112` char(1) DEFAULT NULL,
  `f113` char(1) DEFAULT NULL,
  `f114` char(1) DEFAULT NULL,
  `f115` char(1) DEFAULT NULL,
  `f121` char(1) DEFAULT NULL,
  `f122` char(1) DEFAULT NULL,
  `f123` char(1) DEFAULT NULL,
  `f124` char(1) DEFAULT NULL,
  `f125` char(1) DEFAULT NULL,
  `f126` char(1) DEFAULT NULL,
  `f13` int(11) DEFAULT NULL,
  `f14` varchar(3000) DEFAULT NULL,
  `f15` int(11) DEFAULT NULL,
  `f16` char(1) DEFAULT NULL,
  `f211` char(1) DEFAULT NULL,
  `f212` char(1) DEFAULT NULL,
  `f213` char(1) DEFAULT NULL,
  `f214` char(1) DEFAULT NULL,
  `f215` char(1) DEFAULT NULL,
  `f221` char(1) DEFAULT NULL,
  `f222` char(1) DEFAULT NULL,
  `f223` char(1) DEFAULT NULL,
  `f224` char(1) DEFAULT NULL,
  `f225` char(1) DEFAULT NULL,
  `f23` int(11) DEFAULT NULL,
  `f24` varchar(3000) DEFAULT NULL,
  `f25` int(11) DEFAULT NULL,
  `f26` char(1) DEFAULT NULL,
  `f311` char(1) DEFAULT NULL,
  `f312` char(1) DEFAULT NULL,
  `f313` char(1) DEFAULT NULL,
  `f314` char(1) DEFAULT NULL,
  `f321` char(1) DEFAULT NULL,
  `f322` char(1) DEFAULT NULL,
  `f323` char(1) DEFAULT NULL,
  `f324` char(1) DEFAULT NULL,
  `f325` char(1) DEFAULT NULL,
  `f326` char(1) DEFAULT NULL,
  `f327` char(1) DEFAULT NULL,
  `f33` int(11) DEFAULT NULL,
  `f34` varchar(3000) DEFAULT NULL,
  `f35` int(11) DEFAULT NULL,
  `f36` char(1) DEFAULT NULL,
  `f411` char(1) DEFAULT NULL,
  `f412` char(1) DEFAULT NULL,
  `f413` char(1) DEFAULT NULL,
  `f414` char(1) DEFAULT NULL,
  `f421` char(1) DEFAULT NULL,
  `f422` char(1) DEFAULT NULL,
  `f43` int(11) DEFAULT NULL,
  `f44` varchar(3000) DEFAULT NULL,
  `f45` int(11) DEFAULT NULL,
  `f46` char(1) DEFAULT NULL,
  `f511` char(1) DEFAULT NULL,
  `f521` char(1) DEFAULT NULL,
  `f522` char(1) DEFAULT NULL,
  `f523` char(1) DEFAULT NULL,
  `f53` int(11) DEFAULT NULL,
  `f54` varchar(3000) DEFAULT NULL,
  `f55` int(11) DEFAULT NULL,
  `f56` char(1) DEFAULT NULL,
  `f61` varchar(3000) DEFAULT NULL,
  `join_id` int(11) DEFAULT NULL,
  `join_date` datetime NOT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='評核意見基本資料檔';

--
-- 轉存資料表中的資料 `comment_info`
--

INSERT INTO `comment_info` (`schedule_no`, `f01`, `f02`, `f03`, `f04`, `f05`, `f06`, `f111`, `f112`, `f113`, `f114`, `f115`, `f121`, `f122`, `f123`, `f124`, `f125`, `f126`, `f13`, `f14`, `f15`, `f16`, `f211`, `f212`, `f213`, `f214`, `f215`, `f221`, `f222`, `f223`, `f224`, `f225`, `f23`, `f24`, `f25`, `f26`, `f311`, `f312`, `f313`, `f314`, `f321`, `f322`, `f323`, `f324`, `f325`, `f326`, `f327`, `f33`, `f34`, `f35`, `f36`, `f411`, `f412`, `f413`, `f414`, `f421`, `f422`, `f43`, `f44`, `f45`, `f46`, `f511`, `f521`, `f522`, `f523`, `f53`, `f54`, `f55`, `f56`, `f61`, `join_id`, `join_date`, `modify_date`) VALUES
(1, 'Y', '', 'Y', '', 'Y', '', 'Y', '', '', '', '', 'Y', '', '', '', '', '', 1, '111', 1, '1', '', 'Y', '', 'Y', '', '', 'Y', '', 'Y', '', 2, '自訂工作內容2\r\n自訂工作內容22\r\n自訂工作內容222', 2, '2', 'Y', 'Y', 'Y', '', 'Y', '', 'Y', '', '', 'Y', '', 3, '自訂工作內容3\r\n自訂工作內容33\r\n自訂工作內容233', 3, '3', '', 'Y', '', '', 'Y', '', 4, '自訂工作內容4', 4, '4', 'Y', 'Y', 'Y', '', 3, '自訂工作內容5', 5, '1', 'f61', 28, '0000-00-00 00:00:00', '2008-09-14 15:43:39'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, '2008-09-11 14:24:39', NULL),
(5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', 0, '', 0, '', '', '', '', '', 0, '', 0, '', '', 28, '2008-09-14 17:27:07', NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, '2008-09-14 17:35:35', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `comment_schedule`
--

CREATE TABLE IF NOT EXISTS `comment_schedule` (
  `schedule_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '行程編號',
  `issue_date` date NOT NULL COMMENT '預定訪視日期',
  `school_no` varchar(10) NOT NULL COMMENT '預定訪視學校',
  `issue_times` varchar(4000) NOT NULL COMMENT '訪視次數',
  `contact_name` varchar(20) NOT NULL COMMENT '訪視學校聯絡人',
  `contact_tel` varchar(20) NOT NULL COMMENT '聯絡人電話',
  `contact_status` char(1) NOT NULL COMMENT '是否和訪視學校確認行程',
  `status` char(1) NOT NULL COMMENT '狀態',
  `note` varchar(1000) DEFAULT NULL COMMENT '備註',
  `review_id` int(11) DEFAULT NULL COMMENT '審核人員',
  `join_id` int(11) NOT NULL COMMENT '輔導委員姓名',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  PRIMARY KEY (`schedule_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='評核行程基本資料檔' AUTO_INCREMENT=7 ;

--
-- 轉存資料表中的資料 `comment_schedule`
--

INSERT INTO `comment_schedule` (`schedule_no`, `issue_date`, `school_no`, `issue_times`, `contact_name`, `contact_tel`, `contact_status`, `status`, `note`, `review_id`, `join_id`, `join_date`, `modify_date`) VALUES
(1, '2008-09-18', '0116061', '1', '學校聯絡人', '00-0000000', '1', '4', NULL, NULL, 28, '2008-09-10 15:12:49', '2008-09-10 15:12:49'),
(5, '2008-09-17', '0143113', '1', '訪視聯絡人', '00-00000000', '1', '2', 'TEST1\r\n111', 25, 28, '2008-09-14 16:31:41', '2008-09-14 17:27:35'),
(6, '2008-09-16', '0143113', '2', '聯絡人', '0918-888888', '2', '1', '', NULL, 28, '2008-09-14 16:32:00', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `export_info`
--

CREATE TABLE IF NOT EXISTS `export_info` (
  `table_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '表格編號',
  `name` varchar(50) NOT NULL COMMENT '表格名稱',
  `description` varchar(200) NOT NULL COMMENT '功能描述',
  PRIMARY KEY (`table_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系統資料表基本資料檔' AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `export_info`
--

INSERT INTO `export_info` (`table_no`, `name`, `description`) VALUES
(1, 'user_info', '使用者基本資料檔'),
(2, 'school_area', '縣市別基本資料檔'),
(3, 'qa_info', 'TEST ONLY'),
(4, 'seed_info', 'TEST ONLY');

-- --------------------------------------------------------

--
-- 表的結構 `export_log`
--

CREATE TABLE IF NOT EXISTS `export_log` (
  `export_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '匯出編號',
  `table_no` int(11) NOT NULL COMMENT '表格編號',
  `start_date` date NOT NULL COMMENT '起始日期',
  `end_date` date NOT NULL COMMENT '結束日期',
  `export_file` varchar(200) NOT NULL COMMENT '匯出檔名',
  `export_id` int(11) NOT NULL COMMENT '匯出人員',
  `export_key` varchar(20) NOT NULL COMMENT '群組識別編號',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  PRIMARY KEY (`export_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='匯出資料記錄檔' AUTO_INCREMENT=41 ;

--
-- 轉存資料表中的資料 `export_log`
--

INSERT INTO `export_log` (`export_no`, `table_no`, `start_date`, `end_date`, `export_file`, `export_id`, `export_key`, `join_date`) VALUES
(16, 3, '2008-08-07', '2011-08-17', 'qa_info20080903154106.csv', 25, '20080903154106', '2008-09-03 15:41:06'),
(17, 3, '2008-08-07', '2011-08-17', 'qa_info20080903154149.csv', 25, '20080903154149', '2008-09-03 15:41:49');

-- --------------------------------------------------------

--
-- 表的結構 `news_info`
--

CREATE TABLE IF NOT EXISTS `news_info` (
  `news_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息編號',
  `issue_date` date NOT NULL COMMENT '發表日期',
  `type` char(1) NOT NULL COMMENT '消息類別',
  `subject` varchar(200) NOT NULL COMMENT '消息主旨',
  `pic_no` int(11) DEFAULT NULL COMMENT '圖片編號',
  `content` varchar(4000) NOT NULL COMMENT '消息內容',
  `join_id` int(11) NOT NULL COMMENT '建檔人員',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  PRIMARY KEY (`news_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='最新消息基本資料檔' AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `news_info`
--

INSERT INTO `news_info` (`news_no`, `issue_date`, `type`, `subject`, `pic_no`, `content`, `join_id`, `join_date`, `modify_date`) VALUES
(1, '2008-09-03', '1', 'News Title', 84, 'test123', 25, '2008-09-02 12:07:47', '2008-09-16 11:08:23'),
(2, '2008-09-11', '2', 'News Title 2', 0, '111222333', 25, '2008-09-02 12:20:05', NULL),
(3, '2008-09-11', '3', 'News Title 2', 43, '111\r\n222\r\n333', 25, '2008-09-02 12:22:40', '2008-09-02 12:58:02'),
(5, '2008-09-09', '2', 'News 5', 0, '555', 25, '2008-09-02 17:46:49', '2008-09-02 17:47:11');

-- --------------------------------------------------------

--
-- 表的結構 `pic_info`
--

CREATE TABLE IF NOT EXISTS `pic_info` (
  `pic_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '圖片編號',
  `title` varchar(100) NOT NULL COMMENT '圖片說明',
  `path` varchar(200) NOT NULL COMMENT '圖片路徑',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  PRIMARY KEY (`pic_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='圖片基本資料檔' AUTO_INCREMENT=94 ;

--
-- 轉存資料表中的資料 `pic_info`
--

INSERT INTO `pic_info` (`pic_no`, `title`, `path`, `join_date`) VALUES
(0, '', '', '0000-00-00 00:00:00'),
(31, '', 'phpuVxPWO.jpg', '2008-09-01 21:46:04'),
(32, '', 'phpL4fFgS.jpg', '2008-09-01 22:22:31'),
(33, '', 'phpT6v6CD.jpg', '2008-09-01 22:24:55');

-- --------------------------------------------------------

--
-- 表的結構 `qa_info`
--

CREATE TABLE IF NOT EXISTS `qa_info` (
  `qa_no` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Q&A編號',
  `type` char(1) NOT NULL COMMENT 'Q&A類別',
  `question` varchar(1000) NOT NULL COMMENT '問題',
  `answer` varchar(4000) NOT NULL COMMENT '解決方案',
  `join_id` int(11) NOT NULL COMMENT '建檔人員',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  PRIMARY KEY (`qa_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Q&A基本資料檔' AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `qa_info`
--

INSERT INTO `qa_info` (`qa_no`, `type`, `question`, `answer`, `join_id`, `join_date`, `modify_date`) VALUES
(1, '1', 'Q1', 'Answer 111', 25, '2008-08-29 00:18:32', NULL),
(2, '1', 'Question 2\r\n222', 'Answer\r\n111\r\n222\r\n333', 25, '2008-08-29 00:23:57', '2012-03-27 07:02:15'),
(5, '3', '學校Q&A', '學校Q&A\r\n學校Q&A\r\n學校Q&A\r\n', 25, '2008-09-16 15:22:19', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `qa_parent`
--

CREATE TABLE IF NOT EXISTS `qa_parent` (
  `qa_no` int(11) NOT NULL AUTO_INCREMENT,
  `join_date` datetime NOT NULL,
  `f10` char(1) DEFAULT NULL,
  `f111` char(1) DEFAULT NULL,
  `f112` char(1) DEFAULT NULL,
  `f113` char(1) DEFAULT NULL,
  `f114` char(1) DEFAULT NULL,
  `f115` char(1) DEFAULT NULL,
  `f116` char(1) DEFAULT NULL,
  `f117` varchar(400) DEFAULT NULL,
  `f12` int(11) DEFAULT NULL,
  `f20` char(1) DEFAULT NULL,
  `f211` char(1) DEFAULT NULL,
  `f212` char(1) DEFAULT NULL,
  `f213` char(1) DEFAULT NULL,
  `f214` char(1) DEFAULT NULL,
  `f215` char(1) DEFAULT NULL,
  `f216` char(1) DEFAULT NULL,
  `f217` char(1) DEFAULT NULL,
  `f218` varchar(400) DEFAULT NULL,
  `f22` int(11) DEFAULT NULL,
  `f30` char(1) DEFAULT NULL,
  `f311` char(1) DEFAULT NULL,
  `f312` char(1) DEFAULT NULL,
  `f313` char(1) DEFAULT NULL,
  `f314` char(1) DEFAULT NULL,
  `f315` char(1) DEFAULT NULL,
  `f316` char(1) DEFAULT NULL,
  `f317` varchar(400) DEFAULT NULL,
  `f32` int(11) DEFAULT NULL,
  `f411` char(1) DEFAULT NULL,
  `f412` char(1) DEFAULT NULL,
  `f413` char(1) DEFAULT NULL,
  `f414` char(1) DEFAULT NULL,
  `f415` char(1) DEFAULT NULL,
  `f42` int(11) DEFAULT NULL,
  `f50` char(1) DEFAULT NULL,
  `f511` char(1) DEFAULT NULL,
  `f512` char(1) DEFAULT NULL,
  `f513` char(1) DEFAULT NULL,
  `f514` char(1) DEFAULT NULL,
  `f515` char(1) DEFAULT NULL,
  `f516` char(1) DEFAULT NULL,
  `f517` varchar(400) DEFAULT NULL,
  `f52` int(11) DEFAULT NULL,
  PRIMARY KEY (`qa_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='家長環境評估表資料檔' AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `qa_parent`
--

INSERT INTO `qa_parent` (`qa_no`, `join_date`, `f10`, `f111`, `f112`, `f113`, `f114`, `f115`, `f116`, `f117`, `f12`, `f20`, `f211`, `f212`, `f213`, `f214`, `f215`, `f216`, `f217`, `f218`, `f22`, `f30`, `f311`, `f312`, `f313`, `f314`, `f315`, `f316`, `f317`, `f32`, `f411`, `f412`, `f413`, `f414`, `f415`, `f42`, `f50`, `f511`, `f512`, `f513`, `f514`, `f515`, `f516`, `f517`, `f52`) VALUES
(1, '2008-09-17 16:12:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2008-09-17 16:15:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2008-09-17 16:41:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2008-09-17 16:49:40', '2', 'Y', '', 'Y', '', 'Y', '', '', 3, '2', '', '', '', '', '', '', '', 'aaa', 4, '2', '', '', '', '', 'Y', '', '', 0, '2', '1', '2', '1', '2', 3, '2', 'Y', '', 'Y', '', 'Y', '', '', 3),
(5, '2008-09-17 19:24:48', '2', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', 6, '2', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', 6, '2', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', 6, '2', '2', '2', '2', '2', 6, '2', 'Y', '', 'Y', 'Y', 'Y', 'Y', '', 6);

-- --------------------------------------------------------

--
-- 表的結構 `qa_school`
--

CREATE TABLE IF NOT EXISTS `qa_school` (
  `qa_no` int(11) NOT NULL AUTO_INCREMENT,
  `join_date` datetime NOT NULL,
  `f10` char(1) DEFAULT NULL,
  `f111` char(1) DEFAULT NULL,
  `f112` char(1) DEFAULT NULL,
  `f113` char(1) DEFAULT NULL,
  `f114` char(1) DEFAULT NULL,
  `f115` char(1) DEFAULT NULL,
  `f116` char(1) DEFAULT NULL,
  `f117` varchar(400) DEFAULT NULL,
  `f12` int(11) DEFAULT NULL,
  `f20` char(1) DEFAULT NULL,
  `f211` char(1) DEFAULT NULL,
  `f212` char(1) DEFAULT NULL,
  `f213` char(1) DEFAULT NULL,
  `f214` char(1) DEFAULT NULL,
  `f215` char(1) DEFAULT NULL,
  `f216` char(1) DEFAULT NULL,
  `f217` char(1) DEFAULT NULL,
  `f218` varchar(400) DEFAULT NULL,
  `f22` int(11) DEFAULT NULL,
  `f30` char(1) DEFAULT NULL,
  `f311` char(1) DEFAULT NULL,
  `f312` char(1) DEFAULT NULL,
  `f313` char(1) DEFAULT NULL,
  `f314` char(1) DEFAULT NULL,
  `f315` char(1) DEFAULT NULL,
  `f316` char(1) DEFAULT NULL,
  `f317` varchar(400) DEFAULT NULL,
  `f32` int(11) DEFAULT NULL,
  `f411` char(1) DEFAULT NULL,
  `f412` char(1) DEFAULT NULL,
  `f413` char(1) DEFAULT NULL,
  `f414` char(1) DEFAULT NULL,
  `f415` char(1) DEFAULT NULL,
  `f42` int(11) DEFAULT NULL,
  `f50` char(1) DEFAULT NULL,
  `f511` char(1) DEFAULT NULL,
  `f512` char(1) DEFAULT NULL,
  `f513` char(1) DEFAULT NULL,
  `f514` char(1) DEFAULT NULL,
  `f515` char(1) DEFAULT NULL,
  `f516` char(1) DEFAULT NULL,
  `f517` varchar(400) DEFAULT NULL,
  `f52` int(11) DEFAULT NULL,
  PRIMARY KEY (`qa_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='學校環境評估表資料檔' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `school_area`
--

CREATE TABLE IF NOT EXISTS `school_area` (
  `area_code` char(2) NOT NULL COMMENT '縣市代碼',
  `name` varchar(100) NOT NULL COMMENT '名稱',
  PRIMARY KEY (`area_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='縣市別基本資料檔';

--
-- 轉存資料表中的資料 `school_area`
--

INSERT INTO `school_area` (`area_code`, `name`) VALUES
('01', '基隆市'),
('02', '台北縣'),
('03', '台北市'),
('04', '桃園縣'),
('05', '新竹縣'),
('06', '新竹市'),
('07', '苗栗縣'),
('08', '台中縣'),
('09', '台中市'),
('10', '南投縣'),
('11', '彰化縣'),
('12', '雲林縣'),
('13', '嘉義縣'),
('14', '嘉義市'),
('15', '台南縣'),
('16', '台南市'),
('17', '高雄縣'),
('18', '高雄市'),
('19', '屏東縣'),
('20', '台東縣'),
('21', '花蓮縣'),
('22', '宜蘭縣'),
('23', '澎湖縣'),
('24', '金門縣'),
('25', '連江縣');

-- --------------------------------------------------------

--
-- 表的結構 `school_info`
--

CREATE TABLE IF NOT EXISTS `school_info` (
  `school_no` varchar(10) NOT NULL COMMENT '學校編號',
  `school_code` varchar(10) NOT NULL COMMENT '學校代碼',
  `name` varchar(200) NOT NULL COMMENT '學校名稱',
  `area_code` char(2) NOT NULL COMMENT '縣市別',
  `type` char(1) NOT NULL COMMENT '學制',
  PRIMARY KEY (`school_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='種子學校基本資料檔';

--
-- 轉存資料表中的資料 `school_info`
--

INSERT INTO `school_info` (`school_no`, `school_code`, `name`, `area_code`, `type`) VALUES
('', '', '', '', ''),
('0116061', '011606', '私立護北實小', '02', '1'),
('0143113', '014311', '國立北護高中', '02', '3');

-- --------------------------------------------------------

--
-- 表的結構 `seed_info`
--

CREATE TABLE IF NOT EXISTS `seed_info` (
  `seed_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '活動編號',
  `school_no` varchar(10) NOT NULL COMMENT '學校編號',
  `issue_date` date NOT NULL COMMENT '活動日期',
  `subject` varchar(200) NOT NULL COMMENT '活動主旨',
  `pic_no` int(11) DEFAULT NULL COMMENT '圖片編號',
  `content` varchar(4000) NOT NULL COMMENT '活動說明',
  `join_id` int(11) NOT NULL COMMENT '建檔人員',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  PRIMARY KEY (`seed_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='種子學校活動資料檔' AUTO_INCREMENT=4 ;

--
-- 轉存資料表中的資料 `seed_info`
--

INSERT INTO `seed_info` (`seed_no`, `school_no`, `issue_date`, `subject`, `pic_no`, `content`, `join_id`, `join_date`, `modify_date`) VALUES
(1, '0116061', '2008-09-24', 'Title1', 52, 'Content222333', 27, '2008-09-06 10:18:54', '2008-09-06 11:24:01'),
(2, '0116061', '2008-09-23', 'Title2', 87, '111\r\n222\r\n333', 27, '2008-09-06 10:25:48', '2008-09-16 22:45:32'),
(3, '0116061', '2008-09-18', 'Test3', 0, 'aaa\r\nbbb\r\nccc', 27, '2008-09-08 17:24:50', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `seed_pic`
--

CREATE TABLE IF NOT EXISTS `seed_pic` (
  `seed_no` int(11) NOT NULL COMMENT '成果編號',
  `pic_no` int(11) NOT NULL COMMENT '圖片編號'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='種子學校相簿資料檔';

--
-- 轉存資料表中的資料 `seed_pic`
--

INSERT INTO `seed_pic` (`seed_no`, `pic_no`) VALUES
(2, 31),
(3, 32);

-- --------------------------------------------------------

--
-- 表的結構 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_no` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '使用者編號',
  `id` varchar(20) NOT NULL COMMENT '帳號',
  `passwd` varchar(20) NOT NULL COMMENT '密碼',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `group` char(1) NOT NULL COMMENT '群組',
  `school_no` varchar(10) DEFAULT NULL COMMENT '學校代碼',
  `tel` varchar(20) DEFAULT NULL COMMENT '電話',
  `fax` varchar(20) DEFAULT NULL COMMENT '傳真',
  `email` varchar(100) DEFAULT NULL COMMENT '電子郵件',
  `note` varchar(1000) DEFAULT NULL COMMENT '備註',
  `join_date` datetime NOT NULL COMMENT '新增時間',
  `modify_date` datetime DEFAULT NULL COMMENT '修改時間',
  PRIMARY KEY (`user_no`),
  UNIQUE KEY `Index_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='使用者基本資料檔' AUTO_INCREMENT=33 ;

--
-- 轉存資料表中的資料 `user_info`
--

INSERT INTO `user_info` (`user_no`, `id`, `passwd`, `name`, `group`, `school_no`, `tel`, `fax`, `email`, `note`, `join_date`, `modify_date`) VALUES
(25, 'admin', 'admin', 'admin', '1', '', '', '', '', '', '2008-08-28 08:40:32', '2012-03-27 08:30:35'),
(27, 'seed', 'seed', 'seed', '2', '0116061', '', '', '', '', '2008-08-28 09:38:31', '2012-03-27 08:30:26'),
(28, 'user3', 'user3', 'user3', '3', '', '', '', '', '', '2008-08-29 02:59:00', '2012-03-27 08:30:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
