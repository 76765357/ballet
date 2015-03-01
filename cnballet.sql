-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2015 at 09:16 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cnballet`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `avatar` int(11) NOT NULL,
  `bigavatar` int(11) NOT NULL,
  `desc` text NOT NULL,
  `cid` int(11) NOT NULL,
  `recommend` int(11) NOT NULL,
  `recom_reason` varchar(200) NOT NULL,
  `profess` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `name`, `avatar`, `bigavatar`, `desc`, `cid`, `recommend`, `recom_reason`, `profess`) VALUES
(1, '张剑', 4, 0, '北京舞蹈学院后进入中央芭蕾舞团。作为中芭首席主演，曾担任剧团上演的绝大多数中外舞剧中担任女主角。曾主演舞剧《天鹅湖》、《睡美人》、《仙女》、《红色娘子军》、《吉赛尔》、《大红灯笼高高挂》、《泪泉》、《希尔薇娅》、《罗密欧与朱丽叶》、《奥涅金》、《牡丹亭》、《胡桃夹子》中国版、《胡桃夹子》中国版、《舞姬》第三幕、《堂吉诃德》第三幕、《雷蒙达》第三幕、《祝福》第二幕等，以及《黄河》、《春之祭》、《梁祝》、《牵引》、《五首诗》、《平克佛洛德芭蕾》、《卡门》、《年轻人与死亡》、《卡兹米尔的色彩》、《贝多芬第七交响曲》、《曾经》等现代作品，并在巴兰钦的多部作品中担任主要角色。', 1, 1, 'ddddd', '国家一级演员');

-- --------------------------------------------------------

--
-- Table structure for table `actor_cate`
--

CREATE TABLE IF NOT EXISTS `actor_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `actor_cate`
--

INSERT INTO `actor_cate` (`id`, `name`) VALUES
(1, '首席演员'),
(2, '主要演员'),
(3, '独舞演员'),
(4, '领舞演员'),
(5, '群舞演员');

-- --------------------------------------------------------

--
-- Table structure for table `actor_image`
--

CREATE TABLE IF NOT EXISTS `actor_image` (
  `aid` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audi`
--

CREATE TABLE IF NOT EXISTS `audi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `token` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `audi`
--

INSERT INTO `audi` (`id`, `name`, `avatar`, `email`, `phone`, `token`, `password`) VALUES
(1, 'xk', '', 'emailwzq@163.com', '15811388128', '480f89', '123qwe');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `file`, `desc`, `type`) VALUES
(1, '1989%28DeluxeEdition%29(1)(1)(1)(1)(1).jpg', '', 0),
(2, 'image003(1)(1)(1)(1).png', '', 0),
(3, '198928DeluxeEdition29.jpg', '', 0),
(4, 'Penguins.png', '', 0),
(5, 'Penguins.png', '', 0),
(6, 'Penguins(1).png', '', 0),
(7, '198928DeluxeEdition29.jpg', '1989', 0),
(8, '198928DeluxeEdition29(1).jpg', '', 0),
(9, '198928DeluxeEdition29.jpg', '', 0),
(10, '79.jpg', '', 0),
(11, '89.jpg', '', 0),
(12, '88.jpg', '', 0),
(13, '90.jpg', '', 0),
(14, '82.jpg', '', 0),
(15, '82(1).jpg', '', 0),
(16, '87.jpg', '', 0),
(17, '83.jpg', '', 0),
(18, '88.jpg', '', 0),
(19, '90.jpg', '', 0),
(20, '87.jpg', '', 0),
(21, '103.jpg', '', 0),
(22, '87(1).jpg', '', 0),
(23, '135.jpg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `msg`, `uid`, `uname`, `avatar`, `phone`) VALUES
(1, 'dfjaoijfafa', 1, 'xk', '', '15811388128');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `img_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `subtitle`, `description`, `img_id`, `cate_id`, `vid`, `add_time`) VALUES
(1, 'aaa', 'aaaa', 'dddd', 0, 2, 0, 2015),
(2, 'aaa', 'aaaa', 'dddd', 0, 2, 0, 2015),
(3, '测试', '', '', 0, 2, 0, 0),
(5, '测试新闻图片上传', '子标题', '伟大', 3, 5, 0, 2015);

-- --------------------------------------------------------

--
-- Table structure for table `news_cate`
--

CREATE TABLE IF NOT EXISTS `news_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news_cate`
--

INSERT INTO `news_cate` (`id`, `name`, `desc`) VALUES
(2, '演出新闻', ''),
(5, '剧团新闻', '');

-- --------------------------------------------------------

--
-- Table structure for table `news_image`
--

CREATE TABLE IF NOT EXISTS `news_image` (
  `nid` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_image`
--

INSERT INTO `news_image` (`nid`, `mid`) VALUES
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `img_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`id`, `title`, `subtitle`, `desc`, `img_id`, `time`, `price`, `phone`, `addr`, `vid`) VALUES
(1, '测试', '测试演出', '测试', 10, 2010, '5', '13024076155', '51号楼', 1);

-- --------------------------------------------------------

--
-- Table structure for table `performance_image`
--

CREATE TABLE IF NOT EXISTS `performance_image` (
  `pid` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_image`
--

INSERT INTO `performance_image` (`pid`, `mid`) VALUES
(1, 11),
(1, 12),
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `performance_repertory`
--

CREATE TABLE IF NOT EXISTS `performance_repertory` (
  `pid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_repertory`
--

INSERT INTO `performance_repertory` (`pid`, `rid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recommend`
--

CREATE TABLE IF NOT EXISTS `recommend` (
  `rid` int(11) NOT NULL,
  `cid` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recommend`
--

INSERT INTO `recommend` (`rid`, `cid`, `type`) VALUES
(5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `repertory`
--

CREATE TABLE IF NOT EXISTS `repertory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `img_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `reserve` tinyint(4) NOT NULL,
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `repertory`
--

INSERT INTO `repertory` (`id`, `title`, `subtitle`, `desc`, `img_id`, `time`, `price`, `phone`, `addr`, `reserve`, `vid`) VALUES
(1, 'dadfs', 'dfsddf', '11111', 5, 2015, '1111', '111111', '111', 1, 1),
(3, 'jumutest', '', '', 16, 0, '', '', '', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `repertory_image`
--

CREATE TABLE IF NOT EXISTS `repertory_image` (
  `rid` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repertory_image`
--

INSERT INTO `repertory_image` (`rid`, `mid`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `rpt_id` int(11) NOT NULL,
  `nop` varchar(50) NOT NULL,
  `img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `troupe`
--

CREATE TABLE IF NOT EXISTS `troupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `troupe`
--

INSERT INTO `troupe` (`id`, `content`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `troupe_image`
--

CREATE TABLE IF NOT EXISTS `troupe_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `troupe_image`
--

INSERT INTO `troupe_image` (`id`, `tid`, `mid`) VALUES
(2, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pw`) VALUES
(1, 'admin', '46f94c8de14fb36680850768ff1b7f2a');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `file`, `title`, `subtitle`, `description`, `image`) VALUES
(1, 'testvideo.mov', 'id1testmodi', 'id1subtitletest', 'id1desc', '135.jpg'),
(2, 'testvideo(1).mov', 'shipingtest', 'subtitle', '测试', '87.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

