-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-03-29 09:36:27
-- 服务器版本： 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------


--
-- 表的结构 `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
`id` int(11) NOT NULL,
  `uname` varchar(12) DEFAULT NULL,
  `title` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `other` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `guest`
--

INSERT INTO `guest` (`id`, `uname`, `title`, `content`, `create_time`, `other`) VALUES
(1, 'admin', '今天真高兴', '春天来了，万物复苏,不错的清晨', 1427613320, NULL),
(2, 'admin', '青春啊', '青春不止，奋斗不息', 1427613372, NULL),
(3, 'admin', '博客开启', '开启csdn博客之旅，哈哈，有点小激动', 1427613498, NULL),
(4, 'xp', '百度一下', '百度一下，你就知道，谷歌一下，你知道的更多', 1427613604, NULL),
(5, 'xp', '谚语', '勤学如春起之苗，不见其增，日有所长，\n辍学如磨刀之石，不见其损，日有所亏。', 1427613736, NULL),
(6, 'xp', '不约而同', '没人约，就同性恋了！哈哈！', 1427613786, NULL),
(7, 'hello', '世界，你好', 'code change the world!', 1427613849, NULL),
(8, 'hello', 'phper', '成长在道路上。。。。', 1427613866, NULL),
(9, '坏蛋', '你可举报我', '责任链模式，hehe为隐僻词汇', 1427613951, NULL),
(10, '坏蛋', '我是小偷', '小偷要搞分裂，搞独立', 1427614243, NULL);

-- --------------------------------------------------------


--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `coin` int(11) DEFAULT '100',
  `last_time` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `coin`, `last_time`) VALUES
(1, 'admin', '96e79218965eb72c92a549dd5a330112', 100, 1427613269),
(2, 'xp', '202cb962ac59075b964b07152d234b70', 102, 1427613629),
(3, 'hello', '7d793037a0760186574b0282f2f435e7', 100, 1427613810),
(4, '坏蛋', '4e4d6c332b6fe62a63afe56171fd3725', 100, 1427613889);

--
-- Indexes for dumped tables
--



--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`id`);





--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
MODIFY `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;

--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
