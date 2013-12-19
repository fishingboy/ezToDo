-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Dec 19, 2013, 07:36 PM
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
  `usedHours` int(11) NOT NULL,
  `createTime` datetime NOT NULL COMMENT '建立時間',
  `updateTime` datetime NOT NULL COMMENT '更新時間',
  `sn` int(11) NOT NULL COMMENT '順序',
  PRIMARY KEY (`todoID`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- 列出以下資料庫的數據： `todo`
--

INSERT INTO `todo` (`todoID`, `status`, `title`, `note`, `hours`, `usedHours`, `createTime`, `updateTime`, `sn`) VALUES
(2, 1, '館頁及搜尋頁 Solr Cloud 測試', '館頁及搜尋頁的測試\n', 16, 0, '2013-12-17 00:57:14', '2013-12-18 14:32:07', 60),
(3, 1, '館頁 - 改版', '目前預做三天左右，主要是改 view 和 js\n--\n另外，拿掉 noscript 的敘述', 16, 0, '2013-12-17 00:57:59', '2013-12-18 14:29:48', 10),
(4, 1, '安全性過瀘 - 新加坡的錯誤頁會導向台灣', '目前還沒有測到 case ，可能要問看看是哪個網址？', 4, 0, '2013-12-17 09:22:35', '2013-12-18 14:31:58', 50),
(6, 1, '安全性過瀘 - 錯誤訊息加強', '在 dev 或 beta 沒有錯誤訊息實在太難開發了\n而且 log 也要加強一下，把 /applications/errors 的錯誤也記一下 log', 4, 0, '2013-12-17 10:18:44', '2013-12-17 10:21:37', 40),
(11, 1, 'ITEM_ATTRIBUTE 的維護功能', '增修刪', 0, 0, '2013-12-18 00:44:21', '2013-12-18 00:44:45', 70),
(16, 1, '搜尋頁 - 安全性過瀘', '搜尋頁目前沒有上安全性過瀘\n弄好的話跟 ken 講一下', 4, 0, '2013-12-18 13:33:27', '2013-12-18 13:34:16', 30),
(15, 1, '館頁 - 連結另開視窗', '', 3, 0, '2013-12-18 11:51:32', '2013-12-18 11:59:43', 20),
(14, 1, '館頁 - 圖片改為固定高度', '', 3, 0, '2013-12-18 11:50:40', '2013-12-18 11:51:04', 140),
(17, 1, '買立折的英文', '', 1, 0, '2013-12-18 14:25:17', '2013-12-18 14:25:26', 110),
(18, 1, '試一次進貨流程', '從 pmadmin 按進貨，然後把借貨單給韋恩', 1, 0, '2013-12-18 14:25:38', '2013-12-18 14:26:22', 80),
(19, 1, '給阿酷 firephp 的安裝方法', '', 1, 0, '2013-12-18 14:28:33', '2013-12-18 14:28:41', 90),
(22, 1, '個人工具：上 code 時間', '', 1, 0, '2013-12-18 14:31:35', '2013-12-18 14:31:43', 100),
(24, 1, 'Solr 會議', '1. schema.xml (更新文件)\n2. 搜尋置頂 (elevate)\n3. 搜尋頁的規格\n4. 自動完成/熱門搜尋(已完成)\n5. 搜尋: 嬰兒車, 蘋果\n6. 搜尋 test case (有 a 和 b 的兩份文件)\n7. 搜尋加分機制 (by 關鍵字、分類名稱、click數)\n8. ika 問題 (無法 filter)\n9. solr cloud 限制', 1, 0, '2013-12-19 11:11:29', '2013-12-19 12:02:56', 120),
(28, 1, '館頁 - 價格的 clear 按鈕飛牛還是沒寫', '', 0, 0, '2013-12-19 14:33:58', '2013-12-19 14:34:25', 130),
(30, 0, '', '', 0, 0, '2013-12-19 19:26:49', '0000-00-00 00:00:00', 0);
