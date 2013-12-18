-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Dec 18, 2013, 10:18 AM
-- 伺服器版本: 5.1.71
-- PHP 版本: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `wbkuo`
--

-- --------------------------------------------------------

--
-- 資料表格式： `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `todoID` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '狀態 0.未完成 1. 正常 2. 已完成 3.擱置',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '標題',
  `note` text COLLATE utf8_unicode_ci NOT NULL COMMENT '工作描述',
  `hours` int(11) NOT NULL COMMENT '預估時間',
  `createTime` datetime NOT NULL COMMENT '建立時間',
  `updateTime` datetime NOT NULL COMMENT '更新時間',
  `sn` int(11) NOT NULL COMMENT '順序',
  PRIMARY KEY (`todoID`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- 列出以下資料庫的數據： `todo`
--

INSERT INTO `todo` (`todoID`, `status`, `title`, `note`, `hours`, `createTime`, `updateTime`, `sn`) VALUES
(2, 1, '館頁及搜尋頁 Solr Cloud 測試', '館頁及搜尋頁的測試\n', 4, '2013-12-17 00:57:14', '2013-12-17 23:00:33', 10),
(3, 1, '館頁改版', '目前預做三天左右，主要是改 view 和 js\n--\n館頁圖片要改為固定高度(沒瀑布流效果)\n連結另開視窗', 24, '2013-12-17 00:57:59', '2013-12-18 09:52:54', 50),
(4, 1, '安全性過瀘 - 新加坡的錯誤頁會導向台灣', '目前還沒有測到 case ，可能要問看看是哪個網址？', 0, '2013-12-17 09:22:35', '2013-12-17 09:27:25', 20),
(6, 1, '安全性過瀘 - 錯誤訊息加強', '在 dev 或 beta 沒有錯誤訊息實在太難開發了\n而且 log 也要加強一下，把 /applications/errors 的錯誤也記一下 log', 4, '2013-12-17 10:18:44', '2013-12-17 10:21:37', 30),
(11, 1, 'ITEM_ATTRIBUTE 的維護功能', '增修刪', 0, '2013-12-18 00:44:21', '2013-12-18 00:44:45', 40),
(12, 0, '', '', 0, '2013-12-18 10:16:39', '0000-00-00 00:00:00', 0);
