-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: bulletinboard
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_01_13_052836_create_posts_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(10) unsigned NOT NULL,
  `updated_user_id` int(10) unsigned NOT NULL,
  `deleted_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_create_user_id_foreign` (`create_user_id`),
  KEY `posts_updated_user_id_foreign` (`updated_user_id`),
  CONSTRAINT `posts_create_user_id_foreign` FOREIGN KEY (`create_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `posts_updated_user_id_foreign` FOREIGN KEY (`updated_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Synchronised interactive application','Dignissimos ut non enim est explicabo. Et dolore repellat qui. Eum quibusdam aliquid voluptas maiores qui. Aperiam asperiores corrupti rerum. Laborum dicta est et repellendus aut.',0,2,15,20,'2020-01-15 01:00:18','2020-01-15 01:00:18','1979-10-28 17:30:00'),(2,'Optional didactic website','Occaecati voluptatem praesentium et aliquam quo eius. Et aperiam hic voluptatibus repudiandae ea quia. Aliquid ut nesciunt quia earum perferendis nulla.',0,14,9,21,'2020-01-15 01:00:18','2020-01-15 01:00:18','1986-08-05 17:30:00'),(3,'Organized radical algorithm','Quia minus dolorem vel reprehenderit aut. Itaque qui quo in hic qui reprehenderit autem. Ipsum eligendi optio tempora autem.',0,19,14,9,'2020-01-15 01:00:18','2020-01-15 01:00:18','1995-08-20 17:30:00'),(4,'Enterprise-wide context-sensitive website','Laboriosam doloribus nam a dolores neque vel molestias. Iure consequatur rerum soluta ipsam distinctio molestiae accusantium. Ratione debitis aliquam ipsum vero maiores voluptatem enim.',0,4,21,2,'2020-01-15 01:00:18','2020-01-15 01:00:18','1972-09-01 17:30:00'),(5,'Future-proofed multi-tasking frame','Minus incidunt magni reprehenderit assumenda autem. Earum quia ut distinctio aut dignissimos qui et et.',0,11,12,17,'2020-01-15 01:00:18','2020-01-15 01:00:18','2002-09-24 17:30:00'),(6,'Quality-focused 4thgeneration access','Id earum magni ut eum qui sed. Temporibus doloribus alias delectus quis explicabo molestiae. Tenetur aliquid eos nobis praesentium molestiae dolores.',0,5,5,11,'2020-01-15 01:00:18','2020-01-15 01:00:18','1996-12-27 17:30:00'),(7,'Proactive client-driven approach','Labore amet est voluptatem quia provident doloribus quibusdam neque. Fugiat omnis laudantium ut sunt est omnis et.',0,23,7,15,'2020-01-15 01:00:18','2020-01-15 01:00:18','2004-11-15 17:30:00'),(8,'Exclusive impactful algorithm','Culpa eligendi veritatis ipsum at nostrum nobis. Quis quidem quas reiciendis. Vel sit eum doloribus. Occaecati corrupti eum suscipit et omnis.',0,12,20,11,'2020-01-15 01:00:18','2020-01-15 01:00:18','1989-06-03 17:30:00'),(9,'Pre-emptive asynchronous securedline','Magni quis quas odio cupiditate. Rerum ex est vitae. Consequatur modi eos sit repellat iusto veniam vitae laborum.',0,12,2,18,'2020-01-15 01:00:18','2020-01-15 01:00:18','1996-02-25 17:30:00'),(10,'Synergized radical GraphicalUserInterface','Architecto placeat eius omnis itaque. Hic numquam impedit vel. Alias quis dolorem officia voluptatem fuga ut voluptatem.',0,17,4,5,'2020-01-15 01:00:18','2020-01-15 01:00:18','2000-12-06 17:30:00'),(11,'Progressive directional policy','Voluptatem corrupti deleniti deserunt sint eum quaerat. Rerum quia non sit quo et quas. Repellat eligendi voluptate facere nostrum minus.',0,3,17,23,'2020-01-15 01:00:18','2020-01-15 01:00:18','1985-04-07 17:30:00'),(12,'Team-oriented asynchronous moderator','Ab maiores cupiditate dolores hic. Quia dolores recusandae doloremque quis adipisci. Quia velit aperiam mollitia.',0,14,9,14,'2020-01-15 01:00:18','2020-01-15 01:00:18','1976-04-14 17:30:00'),(13,'Implemented fault-tolerant methodology','Accusamus facilis aspernatur rerum veritatis excepturi accusantium iste molestiae. Sint non suscipit nostrum aut labore sit repudiandae. Repellat aut et fugit dignissimos porro ut quasi praes',0,7,9,9,'2020-01-15 01:00:18','2020-01-15 01:00:18','1991-05-16 17:30:00'),(14,'Total value-added utilisation','Quam inventore sit iure non praesentium. Nulla iure est ducimus autem voluptas quia. Velit nisi libero esse dolor quo voluptatibus aperiam.',0,13,11,16,'2020-01-15 01:00:18','2020-01-15 01:00:18','2011-12-08 17:30:00'),(15,'Persistent asynchronous architecture','Voluptas voluptatem saepe eos necessitatibus. Cupiditate officiis natus quae.',0,16,3,14,'2020-01-15 01:00:18','2020-01-15 01:00:18','2013-03-26 17:30:00'),(16,'Virtual nextgeneration systemengine','At tempore minima sed ut autem sint minima totam. Perferendis sunt esse ea odit exercitationem. Ab odio asperiores iure commodi quis excepturi at. Ex rerum consequuntur hic quo.',0,10,3,5,'2020-01-15 01:00:18','2020-01-15 01:00:18','2016-11-04 17:30:00'),(17,'Pre-emptive uniform workforce','Illo recusandae quisquam soluta. Eius aut error beatae eum dolorem. Iusto necessitatibus aut sint architecto.',0,10,12,3,'2020-01-15 01:00:18','2020-01-15 01:00:18','2016-06-13 17:30:00'),(18,'De-engineered 5thgeneration info-mediaries','Dolor consequatur eos qui animi ipsam odit. Quis odit vero consectetur sit.',0,15,20,20,'2020-01-15 01:00:18','2020-01-15 01:00:18','1999-10-10 17:30:00'),(19,'Managed exuding middleware','Doloribus quis voluptatem est necessitatibus. Minima porro repellendus et. Ipsam expedita voluptatem non earum illo officia.',0,6,23,4,'2020-01-15 01:00:18','2020-01-15 01:00:18','2015-08-24 17:30:00'),(20,'Team-oriented bandwidth-monitored leverage','Nisi nihil repellat maiores consequuntur. Dignissimos itaque numquam velit numquam consequatur provident saepe. Et cumque ut rerum. Officiis numquam delectus dolor et delectus excepturi quia.',0,19,18,21,'2020-01-15 01:00:18','2020-01-15 01:00:18','1976-03-22 17:30:00'),(21,'Customer-focused tangible info-mediaries','Autem rem nulla est tenetur cum consequatur. Nisi exercitationem quia consequatur quod. Reprehenderit quia eius ut minus.',0,12,8,2,'2020-01-15 01:00:18','2020-01-15 01:00:18','2010-02-01 17:30:00'),(22,'Visionary impactful groupware','Fugit officia praesentium voluptate. Quisquam illo aliquam perferendis. Maiores nobis et eius ut dolorem explicabo.',0,7,6,12,'2020-01-15 01:00:18','2020-01-15 01:00:18','1980-11-22 17:30:00'),(23,'Seamless 4thgeneration pricingstructure','Commodi delectus quaerat et est. Dolorem omnis ea voluptatem est sunt qui. Iusto earum debitis est molestias et asperiores a.',0,13,18,10,'2020-01-15 01:00:18','2020-01-15 01:00:18','1994-09-28 17:30:00'),(24,'Implemented 5thgeneration pricingstructure','Dolor voluptas eum necessitatibus et dolore accusamus numquam. Nam dolorum doloribus et aut. Voluptatibus ab aut quos. Ea animi quisquam iure quos repellat.',0,22,23,23,'2020-01-15 01:00:18','2020-01-15 01:00:18','2006-07-12 17:30:00'),(25,'Ergonomic secondary GraphicalUserInterface','Quo nam rem deleniti recusandae. Odio dolorem doloribus illo aut. Molestiae dolore libero nesciunt facere.',0,15,23,6,'2020-01-15 01:00:18','2020-01-15 01:00:18','2018-02-04 17:30:00'),(26,'Public-key bottom-line groupware','Animi et rem temporibus vel sunt. Ut tempora neque cum. Aut deserunt velit occaecati ut fuga exercitationem. Et eius velit qui et quis. Earum eos laborum laborum eum voluptatibus qui.',0,21,7,17,'2020-01-15 01:00:18','2020-01-15 01:00:18','1987-04-04 17:30:00'),(27,'Adaptive tertiary localareanetwork','Voluptatem soluta quas in aperiam et aliquid laboriosam. Tempore amet aliquam repellat nihil. Molestiae quibusdam est deleniti molestias dicta.',0,12,17,13,'2020-01-15 01:00:18','2020-01-15 01:00:18','2002-05-13 17:30:00'),(28,'Re-contextualized methodical productivity','Est quas earum sed. Rerum aliquid ea animi asperiores et. Totam aut omnis aperiam.',0,23,19,13,'2020-01-15 01:00:18','2020-01-15 01:00:18','1978-12-07 17:30:00'),(29,'Business-focused bandwidth-monitored standardization','Odit pariatur quisquam officiis ex sed. Voluptatem est non est error. Est nihil enim consectetur et quis. Quia velit dolore tempore ratione quibusdam nam.',0,2,14,2,'2020-01-15 01:00:18','2020-01-15 01:00:18','2016-04-17 17:30:00'),(30,'Versatile attitude-oriented product','Quisquam velit praesentium consequatur quisquam. Nesciunt at odit dignissimos explicabo. Error quo beatae explicabo sint nostrum quia. Quos sed natus dolores officia.',0,20,23,23,'2020-01-15 01:00:18','2020-01-15 01:00:18','1981-04-09 17:30:00'),(31,'Configurable analyzing contingency','Quis id voluptas aut. Quo aut voluptatem repellat corporis et.',0,11,4,8,'2020-01-15 01:00:18','2020-01-15 01:00:18','1980-02-23 17:30:00'),(32,'Business-focused client-driven product','Qui voluptas voluptatibus consequuntur quas nihil. Deserunt nobis est rem ab ea officia. Omnis officia omnis ut eos est.',0,9,19,17,'2020-01-15 01:00:18','2020-01-15 01:00:18','2005-05-22 17:30:00'),(33,'Organic encompassing database','Et repellendus quos et velit. Voluptatum et maxime molestias consequuntur molestias iusto aliquam. Dolore illo officiis vel vel et. Illum iste fugit qui error tempora nulla.',0,3,7,4,'2020-01-15 01:00:18','2020-01-15 01:00:18','2010-06-10 17:30:00'),(34,'Robust static conglomeration','Quidem totam sint voluptas repellat aut qui incidunt deserunt. Quia recusandae ut ipsum ratione harum. Aut incidunt aliquam autem aut eius ipsa. Sint facilis vel nisi quaerat quia aut invento',0,14,19,22,'2020-01-15 01:00:18','2020-01-15 01:00:18','1998-10-04 17:30:00'),(35,'Persevering reciprocal toolset','Repellendus magni consequatur voluptatem quidem odit. A ut qui doloribus aut odio eum. Accusamus et accusamus dolore sit. Quis alias quis illo enim aut magni occaecati molestias.',0,15,23,4,'2020-01-15 01:00:18','2020-01-15 01:00:18','2007-09-18 17:30:00'),(36,'Compatible hybrid moratorium','Vel quisquam soluta ut deserunt. Corrupti aut sunt maxime debitis dicta. Voluptas dicta dicta tempora asperiores ut. Numquam aliquam est fugit doloribus.',0,20,21,19,'2020-01-15 01:00:18','2020-01-15 01:00:18','2012-04-23 17:30:00'),(37,'Right-sized asynchronous product','Et et aut atque cum. Itaque nisi sed iure quo aperiam laborum porro enim. Sequi iure quibusdam dolores iste. Et eum sunt accusantium tenetur impedit velit ut.',0,14,12,12,'2020-01-15 01:00:18','2020-01-15 01:00:18','2015-05-27 17:30:00'),(38,'Ergonomic leadingedge algorithm','Expedita quos a et quaerat minima cumque sunt. Aspernatur deleniti id voluptatem. Consequatur quia ad ut eos aut placeat. Accusantium illum facere eum.',0,20,3,7,'2020-01-15 01:00:18','2020-01-15 01:00:18','2017-10-20 17:30:00'),(39,'Realigned global project','Et aspernatur sed veniam aliquam aut quae. Quod tenetur et sit saepe veritatis. Dolor provident sequi qui nesciunt vitae minus. Molestias minus iure minima amet odit.',0,12,4,3,'2020-01-15 01:00:18','2020-01-15 01:00:18','2000-04-27 17:30:00'),(40,'Automated solution-oriented strategy','Magnam nemo ducimus assumenda fugit. Voluptas quibusdam soluta autem laudantium. Maiores voluptate similique nemo dolores sunt excepturi magnam. Neque molestiae odio non aut sit quos doloremq',0,12,21,13,'2020-01-15 01:00:18','2020-01-15 01:00:18','2002-10-18 17:30:00'),(41,'Inverse heuristic task-force','Occaecati consequatur nostrum itaque non et. Corrupti et saepe dolor dolor minus quo ut. Dolore est aspernatur perferendis quaerat.',0,9,11,10,'2020-01-15 01:00:18','2020-01-15 01:00:18','2017-12-14 17:30:00'),(42,'Decentralized clear-thinking access','Voluptates ex omnis maiores distinctio repudiandae alias laborum. Quod ex qui aperiam recusandae unde. Quo repellat voluptatem hic omnis illum.',0,7,6,12,'2020-01-15 01:00:18','2020-01-15 01:00:18','2014-06-25 17:30:00'),(43,'Persistent foreground opensystem','Illo ex odio iure iusto tenetur tempora quisquam. Deleniti sunt voluptatem sit voluptatem est. Ipsum non incidunt libero et eos aut eaque.',0,21,18,16,'2020-01-15 01:00:18','2020-01-15 01:00:18','2016-11-15 17:30:00'),(44,'Integrated bifurcated systemengine','Odit quia sed et velit doloribus. In laboriosam accusamus et dolores aut vero. Sed harum recusandae qui ipsa. Aut est placeat fugiat.',0,14,14,17,'2020-01-15 01:00:18','2020-01-15 01:00:18','2003-06-15 17:30:00'),(45,'Upgradable disintermediate instructionset','Aut ut sed omnis reiciendis est praesentium. In quos architecto consequatur est excepturi expedita incidunt. Magnam eum distinctio modi aut ea illum dolore ut. Voluptatem rem iste neque.',0,4,9,9,'2020-01-15 01:00:18','2020-01-15 01:00:18','2010-07-19 17:30:00'),(46,'Object-based directional knowledgeuser','Commodi eligendi at veniam vitae ratione velit beatae. Vero eos maxime ut tempora. Dolorem et provident vel est quod dolorum sit. Quis magnam quia natus praesentium recusandae corrupti quia.',0,5,15,3,'2020-01-15 01:00:18','2020-01-15 01:00:18','1995-02-05 17:30:00'),(47,'Mandatory zeroadministration installation','Dolores id ut rerum omnis odio ipsum libero. In sit quasi blanditiis unde. Iure harum officia aut ut. Explicabo aliquid et nisi facere.',0,2,18,10,'2020-01-15 01:00:18','2020-01-15 01:00:18','1976-03-14 17:30:00'),(48,'Re-engineered empowering installation','Aut at vero dolore deserunt. Est doloribus quos voluptas et esse dignissimos. Ut neque fugit fugit quia cumque libero et molestiae.',0,10,2,12,'2020-01-15 01:00:18','2020-01-15 01:00:18','1983-07-21 17:30:00'),(49,'Multi-tiered context-sensitive utilisation','Ratione dignissimos incidunt mollitia. Ab voluptatem dolores ex mollitia. Consequatur recusandae error omnis provident.',0,7,8,21,'2020-01-15 01:00:18','2020-01-15 01:00:18','1984-07-25 17:30:00'),(50,'Re-contextualized systemic software','Quae impedit fugit voluptatibus voluptatum placeat. Numquam ipsum omnis qui est et sint aspernatur accusantium.',0,4,15,13,'2020-01-15 01:00:18','2020-01-15 01:00:18','2002-12-16 17:30:00'),(54,'Road to Success V2333','asdfasdfasdfasdfasdfadf',1,2,2,NULL,'2020-01-15 01:28:26','2020-01-15 01:28:26',NULL),(55,'Road to Success V2333','asdfasdfasdfasdfasdfadf',1,2,2,NULL,'2020-01-15 01:28:53','2020-01-15 01:28:53',NULL),(56,'Road to Success V2333','asdfasdfasdfasdfasdfadf',1,2,2,NULL,'2020-01-15 01:29:15','2020-01-15 01:29:15',NULL),(57,'Road to Success V2333','asdfasdfasdfasdfasdfadf',1,2,2,NULL,'2020-01-15 01:29:20','2020-01-15 01:29:20',NULL),(58,'Road to Success V2333','asdfasdfasdfasdfasdfadf',1,2,2,NULL,'2020-01-15 01:29:42','2020-01-15 01:29:42',NULL),(59,'Road to Success V2333','asdfasdfasdfasdfasdfadf',1,2,2,NULL,'2020-01-15 01:29:54','2020-01-15 01:29:54',NULL),(60,'Meet to the top','lorem lorem lorem lorem',1,1,2,3,'2020-01-15 04:24:56','2020-01-15 04:24:56',NULL),(61,'Meet to the top','lorem lorem lorem lorem',1,1,2,3,'2020-01-15 04:31:13','2020-01-15 04:31:13',NULL),(62,'How to learn html5','lorem lorem lorasdfasdfem lorem',1,1,2,3,'2020-01-15 04:33:14','2020-01-15 04:33:14',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `create_user_id` int(10) unsigned NOT NULL,
  `updated_user_id` int(10) unsigned NOT NULL,
  `deleted_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_create_user_id_foreign` (`create_user_id`),
  KEY `users_updated_user_id_foreign` (`updated_user_id`),
  CONSTRAINT `users_create_user_id_foreign` FOREIGN KEY (`create_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `users_updated_user_id_foreign` FOREIGN KEY (`updated_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','ekF2KJFeN3.jpg','0','(865) 461-6533 x8248','4245 Yost Turnpike\nKoeppmouth, GA 79986-5970','1980-09-03',1,1,2,'2020-01-15 00:45:50','2020-01-15 00:45:50','1993-12-25 17:30:00','MCrcGvSd6L'),(2,'user01','user01@gmail.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','bsYcObWHiD.jpg','1','483.612.7496','23112 Satterfield Port\nLake Melodyland, SC 55930-1913','2005-11-28',1,1,1,'2020-01-15 00:46:22','2020-01-15 00:46:22','1992-07-15 17:30:00','y4xugX7l7m'),(3,'user02','user02@gmail.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','Lm7aYYS8ns.jpg','1','1-392-631-0676 x9373','75577 Ratke Station Suite 380\nNew Barrettburgh, MO 17534-9242','2008-06-03',1,1,1,'2020-01-15 00:47:07','2020-01-15 00:47:07','2013-01-08 17:30:00','CrGlvr2w84'),(4,'Prof. Rod Jaskolski I','torey.boyer@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','L3mUvt4sbw.jpg','1','(568) 594-1258','690 Elda Ports Suite 256\nAlvismouth, NY 37792','2005-01-03',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1977-09-11 17:30:00','ET0KgYK3wV'),(5,'Vidal Kertzmann IV','david68@example.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','ji71i3VuwZ.jpg','1','759.648.2459 x275','961 Laila Forges Suite 486\nMireilleborough, CA 48281-5170','2001-05-09',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1971-07-20 17:30:00','1ntbT9xo5Q'),(6,'William Blick','arvilla05@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','VGOZlVcI04.jpg','1','1-575-986-9103 x284','31822 Jasen Meadow Apt. 613\nKohlerhaven, ID 24130','1992-03-16',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','2015-10-11 17:30:00','vTisL6EzwP'),(7,'Hershel Weber','zdare@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','QOukWuTzBY.jpg','1','1-921-902-0204 x5080','13603 Ramona Lane Apt. 921\nTravonport, MD 80176-3398','1970-05-15',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1970-03-03 17:30:00','NLptoNZTWw'),(8,'Arielle Metz','fritsch.erik@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','LerY56ZDDR.jpg','1','(843) 776-6487','50956 Nels Corners\nAlvinachester, MT 47183','1984-12-27',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1971-11-10 17:30:00','TLDHQ67LYQ'),(9,'Dr. Zechariah Kertzmann MD','elvera.schneider@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','tidjSarN0p.jpg','1','819.693.0749 x247','147 Cronin Crossroad Apt. 275\nAishamouth, NE 11348','1992-10-11',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1994-12-17 17:30:00','q3MlE7PJiW'),(10,'Jaylin Schoen','xcorwin@example.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','KpoRB3yGIT.jpg','1','+1 (340) 777-7311','7682 Hansen Throughway Apt. 373\nLabadiemouth, SD 30511-2765','1982-10-08',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','2000-04-20 17:30:00','Evr0b8l4Q1'),(11,'Camryn Tillman','alfreda.goldner@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','ObojTQsYkk.jpg','1','243-963-1445 x7479','9165 Conn Turnpike\nKertzmannfort, ME 47269','1970-03-02',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1975-02-11 17:30:00','wyHDbLNEBb'),(12,'Katlyn Hudson','jrobel@example.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','e8C6s0RR6E.jpg','1','1-848-392-2040','26125 Wiza Parks\nLake Vivien, AL 13935-2695','2001-10-06',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','2004-06-03 17:30:00','qokkWSWsl1'),(13,'Elenora Lueilwitz Sr.','jwiza@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','6gTIpmD0k2.jpg','1','915.446.9827 x02725','244 Walter Roads Suite 809\nNorth Nehaland, CT 94410','2007-05-03',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1993-10-25 17:30:00','U5Vh7U6rw8'),(14,'Miss Madaline King','amueller@example.net','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','pMuWV5mOXw.jpg','1','1-860-339-5146','75913 Agustina Roads Apt. 865\nWest Carleyfort, IN 77441','2013-03-06',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','2013-05-15 17:30:00','9FJttrnItJ'),(15,'Mr. Augustus Doyle PhD','tromp.maribel@example.net','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','tZPTfbTCVN.jpg','1','479.926.9533 x3253','264 Reilly Shores\nSouth Maximusview, SC 52494','1994-03-29',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1996-12-10 17:30:00','LImGFWSTiD'),(16,'Mervin Torp','altenwerth.sylvan@example.net','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','ryCVfPHLqq.jpg','1','1-581-937-5021 x5451','67520 Kory Green\nHerzoghaven, NY 71187','2013-09-04',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1987-12-25 17:30:00','oDUTrWfI5H'),(17,'Melissa Kutch','vschinner@example.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','4bdkq1jF0b.jpg','1','374-706-4033 x071','495 Maude Coves Suite 490\nSouth Noemyfort, VT 42380','2009-05-26',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1979-02-17 17:30:00','dh6BVkACnq'),(18,'Cordelia Emmerich','yolanda.cole@example.net','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','V1LtPWV6JO.jpg','1','+1 (361) 430-2339','21607 Miller Curve\nDeanbury, NE 78632','2019-06-12',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1997-02-26 17:30:00','Sk5UjpRNMK'),(19,'Jaquelin Moen','dare.giles@example.com','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','esjY2vXvRD.jpg','1','1-825-793-3018 x6955','5534 Lawson Dale\nCaleberg, WY 82927-8740','1997-02-07',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','2012-05-16 17:30:00','OgE1YazE1c'),(20,'Emmy Reichert','sipes.cathryn@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','SHMdMbXwFl.jpg','1','(914) 973-2334','6069 Macey Mission Suite 953\nMacieland, ND 20200','1976-10-12',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','2015-08-18 17:30:00','1qFatJM0lQ'),(21,'Brennon Buckridge','ursula.hammes@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','2RQmSMDork.jpg','1','245.880.7879','367 Wanda Port\nRutherfordland, WI 70685-9676','2002-04-29',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1976-08-05 17:30:00','2ZknJv95Vd'),(22,'Miss Abigail Kunze','qhoppe@example.net','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','32DRdRzQXm.jpg','1','907-449-3656','685 Mohr Junction Suite 326\nWest Karolann, VT 88360','1980-10-16',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1977-09-28 17:30:00','EYuXxkfG6Y'),(23,'Mr. Archibald Rosenbaum','turner14@example.org','$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju','yzqzqfpBws.jpg','1','+1 (658) 924-7067','600 Blick Junction Suite 940\nTrompmouth, WA 14287','1970-12-14',1,1,1,'2020-01-15 00:48:44','2020-01-15 00:48:44','1990-12-21 17:30:00','azGbP9RWlm');
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

-- Dump completed on 2020-01-15 17:37:32
