SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- 資料庫： `w13`
--
CREATE DATABASE IF NOT EXISTS `w13` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `w13`;

-- --------------------------------------------------------

--
-- 資料表結構 `person`
--

CREATE TABLE `person` (
  `user` varchar(16) NOT NULL,
  `pwd` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `person`
--

INSERT INTO `person` (`user`, `pwd`) VALUES
('admin', 'admin');
COMMIT;
