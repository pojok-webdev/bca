-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: bca
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regid` varchar(12) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `createuser` varchar(50) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeesrecords`
--

DROP TABLE IF EXISTS `employeesrecords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employeesrecords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` smallint(6) DEFAULT NULL,
  `description` text,
  `rmonth` varchar(2) DEFAULT NULL,
  `ryear` varchar(4) DEFAULT NULL,
  `createuser` varchar(50) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeesrecords`
--

LOCK TABLES `employeesrecords` WRITE;
/*!40000 ALTER TABLE `employeesrecords` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeesrecords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recorddetails`
--

DROP TABLE IF EXISTS `recorddetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recorddetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` int(11) DEFAULT NULL,
  `tipedetail` varchar(1) DEFAULT 'D',
  `akun` varchar(11) DEFAULT NULL,
  `matauang` varchar(3) DEFAULT NULL,
  `jumlah` decimal(13,2) DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `nomorpelanggan` varchar(18) DEFAULT NULL,
  `berita` varchar(18) DEFAULT NULL,
  `filler` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recorddetails`
--

LOCK TABLES `recorddetails` WRITE;
/*!40000 ALTER TABLE `recorddetails` DISABLE KEYS */;
INSERT INTO `recorddetails` VALUES (59,1,'D','12345678901','IDR',7000000.00,'AMIR','989765498','TRANSFER JUL 2017',NULL),(60,1,'D','2345678902','IDR',7000000.00,'AYU','854354543','TRANSFER JUL 2017',NULL),(61,1,'D','12345678903','IDR',7000000.00,'ADI','123456789','TRANSFER JUL 2017',NULL),(62,1,'D','345678904','IDR',4500000.45,'DWI','123456790','TRANSFER JUL 2017',NULL),(63,1,'D','12345678905','IDR',4000000.00,'RATIH','123456791','TRANSFER JUL 2017',NULL),(64,1,'D','12345678906','IDR',4000000.00,'YUDI','123456792','TRANSFER JUL 2017',NULL),(65,1,'D','12345678907','IDR',4000000.00,'ALEX','123456793','TRANSFER JUL 2017',NULL),(66,1,'D','12345678908','IDR',4000000.00,'JOKO','123456794','TRANSFER JUL 2017',NULL),(67,1,'D','45678909','IDR',4000000.00,'BAMBANG','123456795','TRANSFER JUL 2017',NULL),(68,1,'D','12345678910','IDR',4000005.76,'TOFIK','123456796','TRANSFER JUL 2017',NULL),(69,1,'D','12345678911','IDR',4000000.00,'BIMO','123456797','TRANSFER JUL 2017',NULL),(70,1,'D','12345678912','IDR',8000000.00,'SUSI','123456798','TRANSFER JUL 2017',NULL),(71,1,'D','12345678913','IDR',5000000.00,'ARYA','123456799','TRANSFER JUL 2017',NULL),(72,1,'D','12345678914','IDR',5600000.00,'ARDI','123456800','TRANSFER JUL 2017',NULL),(73,1,'D','12345678915','IDR',3750000.00,'INDRA','123456801','TRANSFER JUL 2017',NULL),(74,1,'D','12345678916','IDR',3750000.00,'ARIS','123456802','TRANSFER JUL 2017',NULL),(75,1,'D','345678917','IDR',3750000.00,'SODIK','123456803','TRANSFER JUL 2017',NULL),(76,1,'D','12345678918','IDR',3750000.00,'JOJON','123456804','TRANSFER JUL 2017',NULL),(77,1,'D','12345678919','IDR',3750000.00,'YAYA','123456805','TRANSFER JUL 2017',NULL),(78,1,'D','12345678920','IDR',3750000.00,'MINI','123456806','TRANSFER JUL 2017',NULL),(79,1,'D','12345678921','IDR',3750000.00,'YANTO','123456807','TRANSFER JUL 2017',NULL),(80,1,'D','12345678922','IDR',3750000.00,'IWAN','123456808','TRANSFER JUL 2017',NULL),(81,1,'D','12345678923','IDR',3750000.00,'AGUS','123456809','TRANSFER JUL 2017',NULL),(82,1,'D','12345678924','IDR',3750000.00,'BUDI','123456810','TRANSFER JUL 2017',NULL),(83,1,'D','12345678925','IDR',3750000.00,'IMAM','123456811','TRANSFER JUL 2017',NULL),(84,1,'D','12345678926','IDR',3750000.00,'KOLIS','123456812','TRANSFER JUL 2017',NULL),(85,1,'D','12345678927','IDR',3750000.00,'MELI','123456813','TRANSFER JUL 2017',NULL),(86,1,'D','12345678928','IDR',4500000.45,'ERWIN','123456814','TRANSFER JUL 2017',NULL),(87,1,'D','12345678929','IDR',3600000.00,'ARIF','123456815','TRANSFER JUL 2017',NULL);
/*!40000 ALTER TABLE `recorddetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hdr_rec_type` varchar(1) DEFAULT 'H',
  `hdr_data` varchar(1) DEFAULT 'D',
  `kodeperusahaan` varchar(8) DEFAULT NULL,
  `matauang` varchar(3) DEFAULT NULL,
  `totaldata` varchar(7) DEFAULT NULL,
  `totalnominal` decimal(15,2) DEFAULT NULL,
  `tanggalefektifad` varchar(8) DEFAULT NULL,
  `filler` varchar(101) DEFAULT NULL,
  `createuser` varchar(50) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (1,'H','D','00100628','IDR','0001632',864552400.00,'20170701','',NULL,'2017-07-19 06:28:47');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeperusahaan` varchar(8) DEFAULT NULL,
  `matauang` varchar(3) DEFAULT NULL,
  `totaldata` varchar(7) DEFAULT NULL,
  `totalnominal` decimal(15,2) DEFAULT NULL,
  `tanggalefektifad` varchar(8) DEFAULT NULL,
  `filler` varchar(101) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'00100628','IDR','0001632',864552400.00,'20170701',NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `createuser` varchar(50) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mini','mini@padi.net.id','949fd727fdfe91c0f5d0e82af9545347781cdef62dcac5e8358d7f98cdaa57da','3SROmYiV',NULL,'2017-07-18 06:58:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-20 16:38:09
