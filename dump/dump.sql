-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: test_comment
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Петя Краш','https://pbs.twimg.com/media/D3PgF8LWkAAPX8R.jpg'),(2,'Леша Кринж','https://static.giga.de/wp-content/uploads/2018/01/Cringe-Bedeutung-Titelbild.jpg'),(3,'Артемий Златовласый','https://sun9-58.userapi.com/c627327/v627327926/32abd/SXP6gDKgmzc.jpg?ava=1'),(4,'Саша Македонский','https://avatars.mds.yandex.net/get-zen_doc/1712061/pub_5edb0abde0d56115d6547df5_5edb0c0cb9e66247de83b69c/scale_1200');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  `body` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `author_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_author_id_author_id` (`author_id`),
  KEY `fk_comment_topic_id_topic_id` (`topic_id`),
  CONSTRAINT `fk_comment_author_id_author_id` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  CONSTRAINT `fk_comment_topic_id_topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,0,1,'ddsadasdasdasdasdasdasdasdasdas','2021-03-08 03:10:32',1),(2,0,1,'fsfsfsdfdfsdrwer2234234234','2021-03-08 03:11:31',2),(3,0,1,'324234234werwerwerwer','2021-03-08 03:11:31',3),(4,0,1,'erwerwer423423424rrerewerwerewrwrewerwer','2021-03-08 03:11:31',4),(5,0,1,'2erwerewr4fsdfsdf','2021-03-08 03:11:31',1),(6,0,1,'3ewqeqw','2021-03-08 03:11:31',2),(7,6,1,'343344','2021-03-08 03:12:25',3),(8,6,1,'43232343','2021-03-08 03:12:25',1),(9,5,1,'1424fdsfsdf','2021-03-08 03:12:25',2),(10,5,1,'313123qweqe','2021-03-08 03:12:25',3),(11,3,1,'vvxcvx','2021-03-08 03:12:25',2),(12,3,1,'vccvxcvxcv','2021-03-08 03:12:25',3),(13,12,1,'ewewe','2021-03-08 03:12:57',1),(14,12,1,'ew','2021-03-08 03:12:57',3),(15,11,1,'wewe','2021-03-08 03:12:57',3),(16,11,1,'ewewe','2021-03-08 03:12:57',1),(32,0,1,'dsadasdasdasdasdas','2021-03-09 02:31:03',NULL),(33,1,1,'dsadasdasdasd','2021-03-09 02:35:06',NULL),(34,33,1,'sdasdasdasd','2021-03-09 02:35:30',NULL),(35,0,1,'','2021-03-09 02:39:05',NULL),(36,0,1,'fdsfsdfsdf','2021-03-09 03:06:06',NULL),(37,1,1,'fsdfsdfsdfds','2021-03-09 03:07:32',NULL),(38,1,1,'fsdfsdfsdfds fdsfsdfsd','2021-03-09 03:07:39',NULL),(39,38,1,'fdsfsdfsfsd','2021-03-09 03:08:11',NULL),(40,39,1,'fsdfsdfsdfds','2021-03-09 03:08:57',NULL),(41,40,1,'sadasdasd','2021-03-09 03:10:10',NULL),(42,7,1,'fdsfsdfsd','2021-03-09 03:10:30',NULL),(43,8,1,'fsdfdsfsdfsd','2021-03-09 03:11:06',NULL),(44,32,1,'dsadasdasd','2021-03-09 03:11:39',NULL),(47,0,1,'4232423423423423432','2021-03-09 03:13:57',NULL);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1615157268),('m210307_223400_add_comment_table',1615157270),('m210308_101641_add_author_table',1615199124),('m210308_102107_add_author_id_column_comment_table',1615199125),('m210308_204359_add_topic_table',1615236605);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'Луший топик','ылалдывалываолвыалываолыарлорцугкацушгкрцуатамьроралоцуаораыватываыва','2021-03-08 23:49:47','2021-03-08 23:49:47');
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-09  3:22:49
