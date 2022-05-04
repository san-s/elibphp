-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: web
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) DEFAULT NULL,
  `book_desc` varchar(512) DEFAULT NULL,
  `book_author` varchar(64) DEFAULT NULL,
  `book_file` varchar(255) DEFAULT NULL,
  `uploader_id` int(11) NOT NULL,
  `book_cover` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_uploader_fk` (`uploader_id`),
  CONSTRAINT `book_uploader_fk` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (7,'Myanma Love Stories','Myanma Love Stories','Loe','2022-04-20-625f30fd0de85.pdf',1,'2022-04-20-625f30fd0deaf.jpeg'),(8,'Booth','Booth','Bot','2022-04-20-625f3165cf3d0.pdf',1,'2022-04-20-625f3165cf3f1.jpeg'),(9,'A Boy In Winter','A Boy In Winter Book','Rachel Seifert','2022-04-20-625f31ba4c963.pdf',1,'2022-04-20-625f31ba4c988.jpeg'),(10,'The Edge','The Edge book','Nathan Narrington','2022-04-20-625f31f4db8cc.pdf',1,'2022-04-20-625f31f4db8eb.jpeg'),(11,'What the ground can\'t hold','Description','Shady Cosgrove','2022-04-20-625f33581097b.pdf',1,'2022-04-20-625f33581099a.jpeg'),(12,'Harry Potter','A series of Harry Potter books','J.K Rowling','2022-04-20-625f338de467a.pdf',1,'2022-04-20-625f338de469e.jpeg'),(13,'She Who Cried','Book she who cried ','John Smith','2022-04-20-625f33c57f3ff.pdf',1,'2022-04-20-625f33c57f42b.jpeg'),(14,'Very Nice','Very nice book','Marcy Dermansky','2022-04-20-625f33fa26738.pdf',1,'2022-04-20-625f33fa26759.jpeg'),(15,'Tarot','Tarot','Josh','2022-04-20-625f342a06b1c.pdf',1,'2022-04-20-625f342a06b3e.jpeg'),(16,'Sample ','A sample book','Author','2022-04-20-625f344e35252.pdf',1,'2022-04-20-625f344e35288.jpeg'),(17,'The Way Of The Nameless','The Way Of The Nameless from Graham Douglass','Graham Douglass','2022-04-20-625f348aeaa68.pdf',1,'2022-04-20-625f348aeaa8c.jpeg'),(18,'The Secret Of Colors','The colors book','Your name','2022-04-20-625f34b74ba5f.pdf',1,'2022-04-20-625f34b74ba83.jpeg');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `phone` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_fk` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Guys','$2y$10$5i/zht2S9H01iWsL8oS9meWhRCHXGW9f6GQUiCASpqXv9cGr5aiNK','guys@gmail.com',1,'0120499232');
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

-- Dump completed on 2022-04-19 14:16:55
-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: web
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selector` char(12) DEFAULT NULL,
  `validator` char(64) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_tokens`
--

LOCK TABLES `auth_tokens` WRITE;
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
INSERT INTO `auth_tokens` VALUES (11,'bL8gHXf5HO6u','31b5dcceea231115a6fda7a16cfcbe4945d612215a1ae3e4cd3124db2effb8d2',1,'2022-05-10 01:06:36');
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) DEFAULT NULL,
  `book_desc` varchar(512) DEFAULT NULL,
  `book_author` varchar(64) DEFAULT NULL,
  `book_file` varchar(255) DEFAULT NULL,
  `uploader_id` int(11) NOT NULL,
  `book_cover` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_uploader_fk` (`uploader_id`),
  CONSTRAINT `book_uploader_fk` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (7,'Myanma Love Stories','Myanma Love Stories','Loe','2022-04-20-625f30fd0de85.pdf',1,'2022-04-20-625f30fd0deaf.jpeg'),(8,'Booth','Booth','Bot','2022-04-20-625f3165cf3d0.pdf',1,'2022-04-20-625f3165cf3f1.jpeg'),(9,'A Boy In Winter','A Boy In Winter Book','Rachel Seifert','2022-04-20-625f31ba4c963.pdf',1,'2022-04-20-625f31ba4c988.jpeg'),(10,'The Edge','The Edge book','Nathan Narrington','2022-04-20-625f31f4db8cc.pdf',1,'2022-04-20-625f31f4db8eb.jpeg'),(11,'What the ground can\'t hold','Description','Shady Cosgrove','2022-04-20-625f33581097b.pdf',1,'2022-04-20-625f33581099a.jpeg'),(12,'Harry Potter','A series of Harry Potter books','J.K Rowling','2022-04-20-625f338de467a.pdf',1,'2022-04-20-625f338de469e.jpeg'),(13,'She Who Cried','Book she who cried ','John Smith','2022-04-20-625f33c57f3ff.pdf',1,'2022-04-20-625f33c57f42b.jpeg'),(14,'Very Nice','Very nice book','Marcy Dermansky','2022-04-20-625f33fa26738.pdf',1,'2022-04-20-625f33fa26759.jpeg'),(15,'Tarot','Tarot','Josh','2022-04-20-625f342a06b1c.pdf',1,'2022-04-20-625f342a06b3e.jpeg'),(16,'Sample ','A sample book','Author','2022-04-20-625f344e35252.pdf',1,'2022-04-20-625f344e35288.jpeg'),(17,'The Way Of The Nameless','The Way Of The Nameless from Graham Douglass','Graham Douglass','2022-04-20-625f348aeaa68.pdf',1,'2022-04-20-625f348aeaa8c.jpeg'),(18,'The Secret Of Colors','The colors book','Your name','2022-04-20-625f34b74ba5f.pdf',1,'2022-04-20-625f34b74ba83.jpeg');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `phone` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_fk` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Guys','$2y$10$5i/zht2S9H01iWsL8oS9meWhRCHXGW9f6GQUiCASpqXv9cGr5aiNK','guys@gmail.com',1,'0120499232');
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

-- Dump completed on 2022-05-03 18:12:46
