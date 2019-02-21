-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: clubapp
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clubtag`
--

DROP TABLE IF EXISTS `clubtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `clubtag` (
  `TagID` int(11) NOT NULL,
  `ClubID` int(11) NOT NULL,
  KEY `clubtag_ibfk_1` (`ClubID`),
  KEY `TagID` (`TagID`),
  CONSTRAINT `clubtag_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ClubID`),
  CONSTRAINT `clubtag_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tag` (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubtag`
--

LOCK TABLES `clubtag` WRITE;
/*!40000 ALTER TABLE `clubtag` DISABLE KEYS */;
INSERT INTO `clubtag` VALUES (1,1),(2,2),(2,3),(3,4),(3,5),(4,6),(2,7),(3,8),(4,9),(5,10),(6,11),(7,12),(3,13),(3,14),(5,15),(3,16),(3,17),(9,18),(5,19),(5,20),(2,21),(6,22),(9,23),(3,24),(4,25),(3,26),(1,27),(6,28),(9,29),(3,30),(3,31),(8,32),(1,33),(8,34),(8,35),(8,36),(1,37),(7,38),(8,39),(8,40),(3,41),(4,42),(8,43),(9,44),(6,45),(3,46),(5,47),(3,48),(9,49),(3,50),(1,51),(2,52),(3,53),(6,54),(3,55),(7,56),(1,57);
/*!40000 ALTER TABLE `clubtag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-21 16:12:27
