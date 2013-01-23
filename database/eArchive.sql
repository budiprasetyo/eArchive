CREATE DATABASE  IF NOT EXISTS `earchive` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `earchive`;
-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: earchive
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dyn_menu`
--

DROP TABLE IF EXISTS `dyn_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dyn_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uri',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `module_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dyn_group_id` int(11) NOT NULL DEFAULT '0',
  `position` int(5) NOT NULL DEFAULT '0',
  `target` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'make sure there''s no space in this field, if not it will be target=_blank',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `show_menu` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `id_r_privilege` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dyn_group_id - normal` (`dyn_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dyn_menu`
--

LOCK TABLES `dyn_menu` WRITE;
/*!40000 ALTER TABLE `dyn_menu` DISABLE KEYS */;
INSERT INTO `dyn_menu` (`id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `is_parent`, `show_menu`, `id_r_privilege`) VALUES (1,'Beranda','page',1,'','site/administrator_area','',1,0,'',0,0,'1','+1+2+3+4+5+6+7+'),(2,'Surat Masuk','page',2,'','http://','',1,0,'',0,1,'1','+1+2+3+4+5+6+7+'),(3,'Surat Keluar','page',3,'','http://','',1,0,'',0,1,'1','+1+2+3+4+5+6+7+'),(4,'Category4','page',4,'','http://www.category4.com','',1,0,'',0,0,'1',''),(5,'Surat Masuk','page',5,'','c_suratmasuk','',1,0,'',2,0,'1',''),(6,'Category 1 - 2','page',6,'','http://www.category12.com','',1,0,'',2,1,'1',''),(7,'Category 1 - 2 - 1','page',7,'','http://www.category121.com','',1,0,'',6,0,'1',''),(8,'Category 1 - 2 - 2','page',8,'','http://www.category122.com','',1,0,'',6,1,'1',''),(9,'Category 1 - 2 - 2 - 1','page',9,'','http://www.category1221.com','',1,0,'',8,0,'1',''),(10,'Category 1 - 2 - 2 - 2','page',10,'','http://www.category1222.com','',1,0,'',8,0,'1',''),(11,'R/U/H Surat Keluar','page',11,'','c_ruh_suratkeluar','',1,0,'',3,0,'1',''),(12,'Category 3 - 2','page',12,'','http://www.category32.com','',1,0,'',3,0,'1',''),(13,'Category 3 - 3','page',13,'','http://www.category33.com','',1,0,'',3,0,'1',''),(14,'Category 3 - 4','page',14,'','http://www.category34.com','',1,0,'',3,0,'1',''),(15,'Category 3 - 5','page',15,'','http://www.category35.com','',1,0,'',3,0,'1',''),(16,'Category 3 - 6','page',16,'','http://www.category36.com','',1,0,'',3,0,'1',''),(17,'Referensi','page',17,'','http://','',1,0,'',0,1,'1','+1+'),(18,'Keluar','page',18,' ','login/logout',' ',1,0,'',0,0,'1','+1+2+3+4+5+6+7+'),(19,'Referensi Kementerian','page',19,' ','c_ref_kementerian',' ',1,0,'',17,0,'1','+1+'),(20,'Referensi Satker','page',20,'','c_ref_kantor','',1,0,'',17,0,'1','+1+'),(21,'Referensi Privilege','page',21,'','c_ref_privilege','',1,0,'',17,0,'1','+1+');
/*!40000 ALTER TABLE `dyn_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suratmasuk_log`
--

DROP TABLE IF EXISTS `suratmasuk_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suratmasuk_log` (
  `id_suratmasuk_usertime` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_suratmasuk_data` mediumint(7) unsigned NOT NULL,
  `id_users` tinyint(3) unsigned NOT NULL,
  `time_process` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_process` smallint(2) unsigned NOT NULL COMMENT '0 = pre entry to another levels\n1 = masuk\n2 = keluar/respon',
  PRIMARY KEY (`id_suratmasuk_usertime`),
  KEY `id_suratmasuk_data` (`id_suratmasuk_data`),
  KEY `suratmasuk_log_idus_1` (`id_users`),
  CONSTRAINT `suratmasuk_log_ibfk_1` FOREIGN KEY (`id_suratmasuk_data`) REFERENCES `suratmasuk_data` (`id_suratmasuk_data`) ON UPDATE CASCADE,
  CONSTRAINT `suratmasuk_log_idus_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suratmasuk_log`
--

LOCK TABLES `suratmasuk_log` WRITE;
/*!40000 ALTER TABLE `suratmasuk_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `suratmasuk_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `r_menteri`
--

DROP TABLE IF EXISTS `r_menteri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_menteri` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `kdmenteri` varchar(3) NOT NULL,
  `nmmenteri` varchar(175) NOT NULL,
  `kdes1` varchar(2) NOT NULL,
  `nmes1` varchar(200) NOT NULL,
  `kdes2` varchar(4) NOT NULL,
  `nmes2` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='referensi kementerian, nama kementerian, kode eselon 1, nama';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `r_menteri`
--

LOCK TABLES `r_menteri` WRITE;
/*!40000 ALTER TABLE `r_menteri` DISABLE KEYS */;
INSERT INTO `r_menteri` (`id`, `kdmenteri`, `nmmenteri`, `kdes1`, `nmes1`, `kdes2`, `nmes2`) VALUES (1,'025','Kementerian Agama','02','Ditjen Pendidikan Dasar Islam','0202','Kanwil Kementerian Agama Provinsi Semarang'),(2,'025','Kementerian Agama','01','Ditjen Bimas Islam','0105','Kanwil Kementerian Agama Provinsi Jawa Barat'),(3,'999','Kementerian Keuangan','01','Direktorat Jenderal Perimbangan Keuangan','0101','Direktorat Layanan Publiks'),(5,'024','Kementerian Kesehatan','01','Ditjen Penyakit Menular','0105','Suku Dinas Penanggulangan Penyakit');
/*!40000 ALTER TABLE `r_menteri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_users` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `session_id` varchar(150) NOT NULL,
  `kdsatker` varchar(6) NOT NULL,
  `kdbagian` varchar(2) NOT NULL,
  `kdsbagian` varchar(4) NOT NULL COMMENT 'kdbagian VARCHAR(2)+kdsbagian VARCHAR(2)',
  `kdseksi` varchar(5) NOT NULL COMMENT 'kdbagian VARCHAR(2)+kdsbagian VARCHAR(2)+kdseksi VARCHAR(1)',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 = inactive\n1 = active\n2 = default official',
  `id_r_privilege` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_users`),
  KEY `fk_users_id_r_privilege` (`id_r_privilege`),
  CONSTRAINT `fk_users_id_r_privilege` FOREIGN KEY (`id_r_privilege`) REFERENCES `r_privilege` (`id_r_privilege`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_users`, `username`, `password`, `first_name`, `last_name`, `session_id`, `kdsatker`, `kdbagian`, `kdsbagian`, `kdseksi`, `active`, `id_r_privilege`) VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','admin','','','','','',1,1),(3,'loket','a9c8dcf6a784cb0d0672f8bcd3190b9c','','','','','','','',1,7),(4,'sekretaris','ce1023b227de5c34b98c470cda4699bb','','','','','','','',1,6),(5,'pimpinan1','a1475279de60efc1b418fa651f695384','','','','','','','',1,2),(6,'pimpinan2','5a2b8ca40e7be03658a71d89933c0347','','','','','','','',1,3),(7,'pimpinan3','4adb41fef0b3e0c110d6f8c20eeb6c11','','','','','','','',1,4),(8,'pelaksana','6875ccc2c267a8c215afb1f25f81d7a0','','','','','','','',1,5);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suratmasuk_data`
--

DROP TABLE IF EXISTS `suratmasuk_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suratmasuk_data` (
  `id_suratmasuk_data` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `nosurat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `pengirim` varchar(150) CHARACTER SET latin1 NOT NULL,
  `tujuan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tglsurat` date NOT NULL DEFAULT '0000-00-00',
  `file` varchar(100) CHARACTER SET latin1 NOT NULL,
  `perihal` varchar(200) CHARACTER SET latin1 NOT NULL,
  `jenissurat` smallint(2) unsigned NOT NULL,
  `sifatsurat` smallint(2) unsigned NOT NULL,
  PRIMARY KEY (`id_suratmasuk_data`),
  KEY `tglsurat` (`tglsurat`),
  KEY `perihal` (`perihal`),
  KEY `nosurat` (`nosurat`),
  KEY `pengirim` (`pengirim`(10),`perihal`(10))
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suratmasuk_data`
--

LOCK TABLES `suratmasuk_data` WRITE;
/*!40000 ALTER TABLE `suratmasuk_data` DISABLE KEYS */;
INSERT INTO `suratmasuk_data` (`id_suratmasuk_data`, `nosurat`, `pengirim`, `tujuan`, `tglsurat`, `file`, `perihal`, `jenissurat`, `sifatsurat`) VALUES (1,'S-1234','Direktorat PKN','Direktur Sistem Perbendaharaan u.p.Kasubdit Pengembangan Aplikasi','2012-08-17','xxx.pdf','aplikasi moka',0,0),(43,'asdf','asdf','asdf','2012-12-07','1262122589905_20121109.pdf','asdf',0,0);
/*!40000 ALTER TABLE `suratmasuk_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dyn_groups`
--

DROP TABLE IF EXISTS `dyn_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dyn_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `abbrev` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Navigation groupings. Eg, header, sidebar, footer, etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dyn_groups`
--

LOCK TABLES `dyn_groups` WRITE;
/*!40000 ALTER TABLE `dyn_groups` DISABLE KEYS */;
INSERT INTO `dyn_groups` (`id`, `title`, `abbrev`) VALUES (1,'Header','header'),(2,'Sidebar','sidebar'),(3,'Footer','footer'),(4,'Topbar','topbar'),(5,'Sidebar1','sidebar1'),(6,'Sidebar2','sidebar2');
/*!40000 ALTER TABLE `dyn_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `r_office`
--

DROP TABLE IF EXISTS `r_office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_office` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `kdmenteri` varchar(3) NOT NULL,
  `kdes1` varchar(2) NOT NULL,
  `kdes2` varchar(4) NOT NULL COMMENT 'kdes1 VARCHAR(2)+kdes2 VARCHAR(2)\n',
  `kdsatker` varchar(6) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kodepos` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `telp` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `smsgateway` varchar(25) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL COMMENT '0 = inactive\n1 = active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='referensi kantor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `r_office`
--

LOCK TABLES `r_office` WRITE;
/*!40000 ALTER TABLE `r_office` DISABLE KEYS */;
INSERT INTO `r_office` (`id`, `kdmenteri`, `kdes1`, `kdes2`, `kdsatker`, `alamat`, `kodepos`, `telp`, `fax`, `email`, `website`, `smsgateway`, `active`) VALUES (2,'018','09','05','999135','Jalan Jambu',10710,'0217837483748','09090990','mtsn@yahoo.co.id','','',0),(3,'024','05','0501','614322','Jalan Jalak',12343,'02178789878','','','','',0),(5,'025','01','0104','423611','Jalan Jambu',52552,'02498473847','','','','',0),(6,'999','01','0103','999135','Jalan Jalan',57775,'024348374387','024348374387','tvri@tvri.org','tvri.org','024873284728',0),(7,'015','01','0103','413434','Jalan Pedro No. 5 Semarang',57587,'024871873847','024871873847','pertanian@gmail.com','pertanian.net','0234784378',0),(8,'020','02','0203','987223','Jalan Panca Marga V No. 45 Kupang',87100,'03987348378','03987348378','pancamarga@gmail.com','pancamarga.com','',0),(9,'020','04','0404','998113','Jalan Panca Marga IV Kupang',87551,'039384738478','039384738478','pancamarga@gmail.com','pancamarga.com','',0),(10,'020','04','0403','993144','Jalan Panca Marga V Kupang',57551,'039878738','039878738','pancamarga@gmail.com','pancarmarga.com','',0),(11,'018','01','0102','881443','Jalan Pudak Sari V No. 41',57551,'024873847837','024873847837','pertanian@gmail.com','pertanian.com','',0),(12,'018','04','0404','443551','Jalan Puspasari No. 54',57551,'0248347878','0248347878','pertanian@gmail.com','','',0),(13,'024','01','0103','443995','Jalan Saga No. 45',45667,'02198989898','02198989898','kesehatan@gmail.com','kesehatan.com','08113344',0);
/*!40000 ALTER TABLE `r_office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suratmasuk_respon`
--

DROP TABLE IF EXISTS `suratmasuk_respon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suratmasuk_respon` (
  `id_suratmasuk_respon` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_suratmasuk_data` mediumint(7) unsigned NOT NULL,
  `id_users` tinyint(3) unsigned NOT NULL,
  `time_respon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_respon` enum('0','1') NOT NULL COMMENT '0 = belum direspon\n1 = sudah direspon',
  PRIMARY KEY (`id_suratmasuk_respon`),
  KEY `fk_suratmasuk_respon_idsuratmasuk` (`id_suratmasuk_data`),
  KEY `fk_suratmasuk_respon_idusers` (`id_users`),
  CONSTRAINT `fk_suratmasuk_respon_idsuratmasuk` FOREIGN KEY (`id_suratmasuk_data`) REFERENCES `suratmasuk_data` (`id_suratmasuk_data`) ON UPDATE CASCADE,
  CONSTRAINT `fk_suratmasuk_respon_idusers` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='this table is useful for knowing the last process of let-pas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suratmasuk_respon`
--

LOCK TABLES `suratmasuk_respon` WRITE;
/*!40000 ALTER TABLE `suratmasuk_respon` DISABLE KEYS */;
/*!40000 ALTER TABLE `suratmasuk_respon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suratmasuk_disposisi_namaseksi`
--

DROP TABLE IF EXISTS `suratmasuk_disposisi_namaseksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suratmasuk_disposisi_namaseksi` (
  `id_suratmasuk_disposisi_namaseksi` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `id_suratmasuk_data` mediumint(7) unsigned NOT NULL,
  `setuju` enum('0','1') NOT NULL DEFAULT '0',
  `tolak` enum('0','1') NOT NULL DEFAULT '0',
  `telitipendapat` enum('0','1') NOT NULL DEFAULT '0',
  `untukdiketahui` enum('0','1') NOT NULL DEFAULT '0',
  `selesaikan` enum('0','1') NOT NULL DEFAULT '0',
  `sesuaicatatan` enum('0','1') NOT NULL DEFAULT '0',
  `untukperhatian` enum('0','1') NOT NULL DEFAULT '0',
  `edarkan` enum('0','1') NOT NULL DEFAULT '0',
  `jawab` enum('0','1') NOT NULL DEFAULT '0',
  `perbaiki` enum('0','1') NOT NULL DEFAULT '0',
  `bicarakandgsaya` enum('0','1') NOT NULL DEFAULT '0',
  `bicarakanbersama` enum('0','1') NOT NULL DEFAULT '0',
  `ingatkan` enum('0','1') NOT NULL DEFAULT '0',
  `simpan` enum('0','1') NOT NULL DEFAULT '0',
  `disiapkan` enum('0','1') NOT NULL DEFAULT '0',
  `harapdihadiridiwakili` enum('0','1') NOT NULL DEFAULT '0',
  `copy` smallint(3) unsigned NOT NULL DEFAULT '0',
  `catatan` varchar(200) NOT NULL,
  `batasselesai` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_suratmasuk_disposisi_namaseksi`),
  KEY `id_suratmasuk_data` (`id_suratmasuk_data`),
  CONSTRAINT `suratmasuk_disposisi_namaseksi_ibfk_1` FOREIGN KEY (`id_suratmasuk_data`) REFERENCES `suratmasuk_data` (`id_suratmasuk_data`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suratmasuk_disposisi_namaseksi`
--

LOCK TABLES `suratmasuk_disposisi_namaseksi` WRITE;
/*!40000 ALTER TABLE `suratmasuk_disposisi_namaseksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `suratmasuk_disposisi_namaseksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `r_level_process`
--

DROP TABLE IF EXISTS `r_level_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_level_process` (
  `id_r_level_process` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(20) NOT NULL,
  `level_num` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_r_level_process`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='showing level process';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `r_level_process`
--

LOCK TABLES `r_level_process` WRITE;
/*!40000 ALTER TABLE `r_level_process` DISABLE KEYS */;
/*!40000 ALTER TABLE `r_level_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `id_user` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'user' COMMENT 'nama_user',
  `password` varchar(40) CHARACTER SET latin1 NOT NULL COMMENT 'pass',
  `leveluser` smallint(5) NOT NULL COMMENT 'level user',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `r_seksi`
--

DROP TABLE IF EXISTS `r_seksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_seksi` (
  `id_r_seksi` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `kdsatker` varchar(6) NOT NULL,
  `namaseksi` varchar(75) NOT NULL,
  `kdseksi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_r_seksi`),
  KEY `kdsatker` (`kdsatker`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `r_seksi`
--

LOCK TABLES `r_seksi` WRITE;
/*!40000 ALTER TABLE `r_seksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `r_seksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `r_privilege`
--

DROP TABLE IF EXISTS `r_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_privilege` (
  `id_r_privilege` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `privilege` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_r_privilege`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `r_privilege`
--

LOCK TABLES `r_privilege` WRITE;
/*!40000 ALTER TABLE `r_privilege` DISABLE KEYS */;
INSERT INTO `r_privilege` (`id_r_privilege`, `privilege`) VALUES (1,'administrator'),(2,'pimpinan1'),(3,'pimpinan2'),(4,'pimpinan3'),(5,'pelaksana'),(6,'sekretaris'),(7,'loket');
/*!40000 ALTER TABLE `r_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `r_sifat_surat`
--

DROP TABLE IF EXISTS `r_sifat_surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_sifat_surat` (
  `id_r_sifat_surat` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
  `sifat_surat` varchar(45) NOT NULL,
  PRIMARY KEY (`id_r_sifat_surat`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `r_sifat_surat`
--

LOCK TABLES `r_sifat_surat` WRITE;
/*!40000 ALTER TABLE `r_sifat_surat` DISABLE KEYS */;
INSERT INTO `r_sifat_surat` (`id_r_sifat_surat`, `sifat_surat`) VALUES (1,'biasa'),(2,'segera'),(3,'sangat segera'),(4,'rahasia');
/*!40000 ALTER TABLE `r_sifat_surat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-23  9:38:26
