-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: news_feed
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.12.04.1

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
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (15,'news asfsafs','rgr3g4g4dsgsdgdgds\nsdgsdgsdgdsgadga\nadsgasdgadsgdsagds\nadgadsgasdgads','2015-08-11 01:24:24','2015-08-10 22:24:33'),(3,'news3','dsgdsgdsgsdgdsg','2015-08-09 22:35:30','2015-08-09 19:35:30'),(4,'news4','dsgdsgdsgsdgdsg','2015-08-09 22:36:01','2015-08-09 19:36:01'),(5,'news5','dsgdsgdsgsdgdsg safafafaf asfasf asfasfasfasfasfa','2015-08-09 22:36:09','2015-08-09 19:36:09'),(6,' rsrfsd fsdfds dsf','dsgdsgdsgsdgdsg safafafaf asfasf asfasfasfasfasfa\n12123231dsfsdfds\nsdgds dsgdsg','2015-08-09 22:36:12','2015-08-10 21:54:07'),(8,'sdg','sdgsdg','2015-08-11 01:04:54','2015-08-10 22:04:54'),(16,'hihihi','fasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgwegfasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgwegfasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgwegfasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgwegfasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgwegfasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgwegfasgfgnui3golp;3[ r3ginm okpglr4[pg44[445t edggsdgeqwgweg','2015-08-11 01:31:42','2015-08-10 22:31:42'),(10,'sdgsdgds','sdgsdgsdgsdg','2015-08-11 01:06:20','2015-08-10 22:06:20'),(11,'dsfsdfsd','dsgdf','2015-08-11 01:07:22','2015-08-10 22:07:22'),(12,'dsfdsf','sdgsd\n1231','2015-08-11 01:17:04','2015-08-10 22:18:31'),(14,'brrtntn','rnrtntrnrt','2015-08-11 01:22:45','2015-08-10 22:22:45');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-11  1:34:46
