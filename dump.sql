-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: delivery
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `api_tokens`
--

DROP TABLE IF EXISTS `api_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `api_tokens_customer_id_foreign` (`customer_id`),
  CONSTRAINT `api_tokens_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `_lft` int(10) unsigned NOT NULL,
  `_rgt` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  KEY `categories_restaurant_id_foreign` (`restaurant_id`),
  KEY `categories_city_id_foreign` (`city_id`),
  CONSTRAINT `categories_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `categories_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4525 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `city_user`
--

DROP TABLE IF EXISTS `city_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city_user` (
  `city_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `city_user_city_id_foreign` (`city_id`),
  KEY `city_user_user_id_foreign` (`user_id`),
  CONSTRAINT `city_user_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `city_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `loyalty_points` int(11) NOT NULL DEFAULT '0',
  `loyalty_reward` int(11) NOT NULL DEFAULT '0',
  `ordered_money_left` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `customers_city_id_foreign` (`city_id`),
  CONSTRAINT `customers_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `delivery_areas`
--

DROP TABLE IF EXISTS `delivery_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_areas_city_id_foreign` (`city_id`),
  CONSTRAINT `delivery_areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2722 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `delivery_boy_api_tokens`
--

DROP TABLE IF EXISTS `delivery_boy_api_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_boy_api_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `delivery_boy_id` int(10) unsigned NOT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `push_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_boy_api_tokens_delivery_boy_id_foreign` (`delivery_boy_id`),
  CONSTRAINT `delivery_boy_api_tokens_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `delivery_boy_messages`
--

DROP TABLE IF EXISTS `delivery_boy_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_boy_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_id` int(10) unsigned NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_boy_messages_delivery_boy_id_foreign` (`delivery_boy_id`),
  CONSTRAINT `delivery_boy_messages_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `delivery_boys`
--

DROP TABLE IF EXISTS `delivery_boys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_boys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_03_30_180306_create_categories_table',1),(4,'2017_03_31_124009_add_image_to_categories',1),(5,'2017_04_03_134750_create_products_table',1),(6,'2017_04_03_140913_create_product_images_table',1),(7,'2017_04_07_145559_create_orders_table',1),(8,'2017_04_07_145619_create_ordered_products_table',1),(9,'2017_04_09_101351_create_news_items_table',1),(10,'2017_04_09_140135_create_settings_table',1),(11,'2017_04_09_180814_create_push_messages_table',1),(12,'2017_04_09_192319_add_gcm_project_to_settings',1),(13,'2017_04_13_081723_change_news_feed_texts',2),(14,'2017_04_19_182522_create_delivery_areas_table',3),(15,'2017_04_20_054541_add_delivery_area_id_to_orders',4),(16,'2017_05_11_074026_add_notification_email_to_settings',5),(17,'2017_05_13_134349_create_promo_codes_table',6),(18,'2017_05_13_140716_add_promo_code_to_orders',6),(19,'2018_03_09_125327_add_stripe_fields_to_settings',7),(20,'2018_03_09_125955_add_payment_method_to_orders',7),(21,'2018_03_11_082151_add_paypal_to_settings',7),(22,'2018_03_12_120831_add_paypal_id_to_orders',7),(23,'2018_03_26_103140_create_tax_groups_table',8),(24,'2018_03_26_105638_add_tax_group_id_to_products',8),(25,'2018_03_26_112646_add_total_tax_to_orders',8),(26,'2018_03_26_113257_add_tax_included_to_settings',8),(27,'2018_03_27_090932_create_cities_table',8),(28,'2018_03_27_091215_create_restaurants_table',8),(29,'2018_03_27_094031_add_restaurant_id_to_categories',8),(30,'2018_03_27_094521_add_multiple_restaurants_to_settings',8),(31,'2018_03_27_121400_add_city_to_orders',8),(32,'2018_03_27_123051_add_city_to_delivery_areas',8),(33,'2018_03_27_140351_add_city_to_promo_codes',8),(34,'2018_03_28_071528_create_customers_table',8),(35,'2018_03_28_073738_add_customer_id_to_orders',8),(36,'2018_03_28_080253_add_signup_required_to_settings',8),(37,'2018_03_28_090304_create_api_tokens',8),(38,'2018_03_30_013810_create_cities_users_table',8),(39,'2018_03_30_015454_add_access_fields_to_users',8),(40,'2018_04_02_104602_create_delivery_boys_table',8),(41,'2018_04_02_104728_add_delivery_boy_id_to_orders',8),(42,'2018_04_02_110159_add_access_delivery_boys_to_users',8),(43,'2018_04_04_075520_add_paypal_production_to_settings',8),(44,'2018_04_06_071254_add_city_id_to_news_items',8),(45,'2018_04_20_123420_create_order_statuses_table',9),(46,'2018_04_20_123528_add_order_status_id_to_orders',9),(47,'2018_04_20_124947_add_access_order_statuses_to_users',9),(48,'2018_04_21_145653_add_date_format_backend_to_setings',10),(49,'2018_04_21_171950_add_date_format_app_to_settings',10),(50,'2018_05_02_105736_add_login_to_delivery_boys',11),(51,'2018_05_02_110837_create_delivery_boy_api_tokens',11),(52,'2018_05_07_114438_create_delivery_boy_messages_table',11),(53,'2018_05_16_142852_add_driver_onesignal_id_to_settings',11),(54,'2018_05_17_144726_add_available_to_delivery_boy_to_order_statuses',11),(55,'2018_06_08_171206_add_products_layout_to_settings',12),(56,'2018_06_13_144931_add_comment_to_orders',13),(57,'2018_08_08_091600_add_sort_to_products',14),(58,'2018_08_08_092135_create_vendors_table',15),(59,'2018_08_08_093904_add_access_vendors_to_users',15),(60,'2018_08_08_094500_add_vendor_id_to_products',16),(64,'2018_08_08_104656_add_loyalty_program_to_settings',17),(65,'2018_08_08_104829_add_loyalty_program_to_customers',17),(66,'2018_08_08_104917_add_loyalty_program_to_orders',17);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_items`
--

DROP TABLE IF EXISTS `news_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `announce` text COLLATE utf8mb4_unicode_ci,
  `full_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_items_city_id_foreign` (`city_id`),
  CONSTRAINT `news_items_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2741 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `available_to_delivery_boy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1768 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES (1763,'Created',1,1,'2018-05-28 11:11:47','2018-05-28 11:11:47','0'),(1764,'Processing',500,0,'2018-05-28 11:11:47','2018-05-28 11:11:47','0'),(1765,'En Route',550,0,'2018-05-28 11:11:47','2018-05-28 11:11:47','0'),(1766,'Delivered',600,0,'2018-05-28 11:11:47','2018-05-28 11:11:47','1'),(1767,'Cancelled',650,0,'2018-05-28 11:11:47','2018-05-28 11:11:47','1');
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordered_products`
--

DROP TABLE IF EXISTS `ordered_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordered_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `product_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double(8,2) DEFAULT NULL,
  `lng` double(8,2) DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery_area_id` int(10) unsigned DEFAULT NULL,
  `delivery_price` double(8,2) NOT NULL DEFAULT '0.00',
  `promo_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `promo_code_id` int(11) DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'cash',
  `stripe_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `paypal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `total_with_tax` double(8,2) NOT NULL DEFAULT '0.00',
  `restaurant_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `delivery_boy_id` int(10) unsigned DEFAULT NULL,
  `order_status_id` int(10) unsigned DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `loyalty` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `orders_restaurant_id_foreign` (`restaurant_id`),
  KEY `orders_city_id_foreign` (`city_id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_delivery_boy_id_foreign` (`delivery_boy_id`),
  KEY `orders_order_status_id_foreign` (`order_status_id`),
  CONSTRAINT `orders_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8993 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) NOT NULL,
  `price_old` double(8,2) DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tax_group_id` int(10) unsigned DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '500',
  `vendor_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_tax_group_id_foreign` (`tax_group_id`),
  KEY `products_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `products_tax_group_id_foreign` FOREIGN KEY (`tax_group_id`) REFERENCES `tax_groups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8961 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `discount_in_percent` tinyint(1) NOT NULL,
  `min_price` double(8,2) NOT NULL DEFAULT '0.00',
  `limit_use_count` int(11) NOT NULL,
  `times_used` int(11) NOT NULL DEFAULT '0',
  `active_from` datetime NOT NULL,
  `active_to` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `restaurant_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promo_codes_restaurant_id_foreign` (`restaurant_id`),
  KEY `promo_codes_city_id_foreign` (`city_id`),
  CONSTRAINT `promo_codes_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `promo_codes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1779 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `push_messages`
--

DROP TABLE IF EXISTS `push_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0',
  `error` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `city_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=368 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pushwoosh_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `pushwoosh_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `date_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'd/m/Y H:i',
  `currency_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `delivery_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gcm_project_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `notification_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `notification_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail_from_mail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail_from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail_from_new_order_subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `stripe_publishable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `stripe_private` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `paypal_client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `paypal_client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `paypal_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `tax_included` tinyint(1) NOT NULL DEFAULT '0',
  `multiple_restaurants` tinyint(1) NOT NULL DEFAULT '0',
  `multiple_cities` tinyint(1) NOT NULL DEFAULT '0',
  `signup_required` tinyint(1) NOT NULL DEFAULT '0',
  `paypal_production` tinyint(1) NOT NULL DEFAULT '0',
  `time_format_backend` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'd/M/Y H:i',
  `time_format_app` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dd/MM/yyyy HH:mm',
  `date_format_app` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dd/MM/yyyy',
  `driver_onesignal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `driver_onesignal_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `products_layout` int(11) NOT NULL DEFAULT '0',
  `categories_layout` int(11) NOT NULL DEFAULT '0',
  `loyalty_points_per_order` int(11) NOT NULL DEFAULT '10',
  `loyalty_points_for_reward` int(11) NOT NULL DEFAULT '100',
  `loyalty_reward_amount` double(8,2) NOT NULL DEFAULT '16.00',
  `loyalty_points_per_amount` int(11) NOT NULL DEFAULT '16',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=903 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tax_groups`
--

DROP TABLE IF EXISTS `tax_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `value` double(8,2) NOT NULL DEFAULT '0.00',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `access_full` tinyint(1) NOT NULL DEFAULT '1',
  `access_news` tinyint(1) NOT NULL DEFAULT '1',
  `access_categories` tinyint(1) NOT NULL DEFAULT '1',
  `access_products` tinyint(1) NOT NULL DEFAULT '1',
  `access_orders` tinyint(1) NOT NULL DEFAULT '1',
  `access_customers` tinyint(1) NOT NULL DEFAULT '1',
  `access_pushes` tinyint(1) NOT NULL DEFAULT '1',
  `access_delivery_areas` tinyint(1) NOT NULL DEFAULT '1',
  `access_promo_codes` tinyint(1) NOT NULL DEFAULT '1',
  `access_tax_groups` tinyint(1) NOT NULL DEFAULT '1',
  `access_cities` tinyint(1) NOT NULL DEFAULT '1',
  `access_restaurants` tinyint(1) NOT NULL DEFAULT '1',
  `access_settings` tinyint(1) NOT NULL DEFAULT '1',
  `access_users` tinyint(1) NOT NULL DEFAULT '1',
  `access_delivery_boys` tinyint(1) NOT NULL DEFAULT '1',
  `access_order_statuses` tinyint(1) NOT NULL DEFAULT '1',
  `access_vendors` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@example.com','$2y$10$53uwVUb9HqczhzipXnP2U..EkAhgY6xPFqHd0CUp6oSZXKfIFAx22','BEPEd5FWZFWenlVbwmmBqen7r55nyboSyuKq1EI4ZZDnaWwkYVQIkxAqUQfG','2017-04-13 07:47:13','2017-04-13 07:47:13',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),(4,'test','test@email.com','$2y$10$abOdsrB1RuhbgtN2Rxo7j.aseAxQbcAw7pxX3apavJNv/sCCqVadi','CNyJDcev3ioGwa8LfwGHo4TXdX95Fq8Y255Q7ReetacGhp3BqqT6IrP0LvRO','2018-05-03 03:56:54','2018-05-27 20:23:21',0,1,1,1,1,1,0,0,0,0,0,1,0,0,1,1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '500',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-08 22:44:12
