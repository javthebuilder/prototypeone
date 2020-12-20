-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: tercet_pos
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `pk_categories` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `type` char(15) DEFAULT NULL COMMENT 'category type= EX, PR',
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_categories`),
  UNIQUE KEY `description` (`description`,`type`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Salad','products','2017-12-02 13:45:41',1000,'2017-12-02 13:45:41',NULL,1),(2,'Drinks','products','2017-12-02 13:45:49',1000,'2017-12-02 13:45:49',NULL,1),(3,'Invoice','expense','2017-12-02 13:45:56',1000,'2019-06-23 17:11:19',1013,1),(4,'Stock','expense','2017-12-02 13:46:06',1000,'2017-12-02 13:48:02',1000,1),(5,'Others','products','2017-12-06 15:20:55',1000,'2017-12-06 15:20:55',NULL,1),(6,'IT','products','2019-04-09 06:49:42',1000,'2019-04-09 06:49:42',NULL,1),(7,'Essential Oils','products','2019-09-27 22:26:51',1013,'2019-09-27 22:26:51',NULL,1),(8,'water','expense','2019-09-30 11:01:42',1013,'2019-09-30 11:01:42',NULL,1),(9,'office supplies','products','2019-09-30 11:04:17',1013,'2019-09-30 11:04:17',NULL,1),(10,'One Stop Soap','products','2019-09-30 11:53:14',1013,'2019-09-30 11:53:14',NULL,1),(11,'J&J Items','products','2019-10-03 16:23:31',1013,'2019-10-03 16:23:31',NULL,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `pk_company` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `vat` double(10,2) DEFAULT '0.00',
  `pictx` text,
  `receiptheader` varchar(255) DEFAULT NULL,
  `receiptfooter` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk_company`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1000,'Sample Digital','Digital Solutions','Cebu City','099','tercet@gmail.com','Sample Owner','Sample','322123',12.00,'company/TqBEYrAcbXQDXGrgjR62vHQx88exj3TkPcjKZZbo.jpeg','Tercet','Tercet 1','2017-11-23 14:10:22','2019-10-08 00:38:36');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `pk_discounts` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_discounts`),
  UNIQUE KEY `description` (`description`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `discounts_ibfk_2` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (2,'PWD',20,'2017-12-02 13:44:10',1000,'2017-12-08 14:39:46',1000,1),(3,'Basic',10,'2017-12-08 14:40:31',1000,'2019-06-04 02:14:37',1000,1),(4,'Senior Citizen',20,'2019-06-04 02:15:34',1000,'2019-06-04 02:15:34',NULL,1),(5,'premium reseller',20,'2019-09-30 11:15:45',1013,'2019-09-30 11:15:45',NULL,1);
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense` (
  `pk_expense` int(11) NOT NULL AUTO_INCREMENT,
  `docdate` date DEFAULT NULL COMMENT 'required',
  `docno` varchar(255) DEFAULT NULL COMMENT 'required',
  `fk_categories` int(11) DEFAULT NULL,
  `fk_stores` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `attachment` text,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_expense`),
  KEY `fk_categories` (`fk_categories`),
  KEY `fk_stores` (`fk_stores`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`fk_categories`) REFERENCES `categories` (`pk_categories`),
  CONSTRAINT `expense_ibfk_2` FOREIGN KEY (`fk_stores`) REFERENCES `stores` (`pk_stores`),
  CONSTRAINT `expense_ibfk_3` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `expense_ibfk_4` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
INSERT INTO `expense` VALUES (2,'2017-12-05','0032123',4,1001,1500.00,'newly purchased stocks',NULL,'2017-12-05 11:15:15',1000,'2017-12-05 11:15:15',NULL,1),(3,'2017-12-13','443234',3,1000,1000.00,'printer paper',NULL,'2017-12-13 11:27:21',1000,'2017-12-13 11:27:21',NULL,1),(4,'2017-12-15','332123',3,1000,100.00,'expense invoice',NULL,'2017-12-15 14:50:27',1000,'2017-12-19 17:13:35',1000,1),(5,'2017-12-15','42323',3,1000,2000.00,'test',NULL,'2017-12-15 14:50:39',1000,'2017-12-15 14:50:39',NULL,1),(6,'2017-12-15','34342134',3,1001,500.00,'test',NULL,'2017-12-15 15:36:17',1013,'2017-12-15 15:36:17',NULL,1),(7,'2017-12-15','34432',4,1001,1000.00,'sample',NULL,'2017-12-15 15:38:42',1013,'2019-06-04 08:47:24',1000,1),(8,'2017-10-19','665342345',3,1001,5000.00,'first expense','expense/pxk3F0qvkE6PUQUDVS5rKgeaY1hUj0PmTtG8jGT3.png','2017-12-19 10:25:36',1000,'2019-06-04 08:33:16',1000,1),(9,'2019-06-04','test',3,1005,1.00,'12312',NULL,'2019-06-04 08:50:02',1000,'2019-06-04 08:50:02',NULL,1),(10,'2019-06-04','21312',3,1000,1.00,'sadfsad','expense/eHaiLtS8MX0jGSr4f7FzXWTwz54wA3aLRu0NzBu6.png','2019-06-04 08:50:09',1000,'2019-06-04 08:50:09',NULL,1),(11,'2019-06-04','123',3,1000,1.00,'123',NULL,'2019-06-04 08:50:23',1000,'2019-06-04 08:50:23',NULL,1),(12,'2019-09-30','3040',8,1000,100.00,'4 gallons of water',NULL,'2019-09-30 12:11:50',1013,'2019-09-30 12:12:19',1013,1);
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_10_06_003042_add_remarks_on_products_qty',1),(2,'2019_10_06_011908_add_sku_in_products_table',1),(3,'2019_10_06_042953_add_description2_on_permalink_table',1),(4,'2019_10_06_164812_create_products_prices_history_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permadivider`
--

DROP TABLE IF EXISTS `permadivider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permadivider` (
  `pk_divider` int(11) NOT NULL AUTO_INCREMENT,
  `fk_permalink` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_divider`),
  KEY `fk_permalink` (`fk_permalink`),
  CONSTRAINT `permadivider_ibfk_1` FOREIGN KEY (`fk_permalink`) REFERENCES `permalink` (`pk_permalink`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permadivider`
--

LOCK TABLES `permadivider` WRITE;
/*!40000 ALTER TABLE `permadivider` DISABLE KEYS */;
INSERT INTO `permadivider` VALUES (1001,1530);
/*!40000 ALTER TABLE `permadivider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permalink`
--

DROP TABLE IF EXISTS `permalink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permalink` (
  `pk_permalink` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` char(50) DEFAULT NULL,
  `ngclick` char(50) DEFAULT NULL,
  `icon` char(50) DEFAULT NULL,
  `class` char(50) DEFAULT NULL,
  `type` char(1) DEFAULT NULL COMMENT 'A=parent,B=child,C=options',
  `family` char(50) DEFAULT NULL,
  `indexno` int(11) DEFAULT NULL COMMENT 'order for display',
  `stat` tinyint(1) DEFAULT NULL,
  `newdescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pk_permalink`)
) ENGINE=InnoDB AUTO_INCREMENT=2031 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permalink`
--

LOCK TABLES `permalink` WRITE;
/*!40000 ALTER TABLE `permalink` DISABLE KEYS */;
INSERT INTO `permalink` VALUES (1000,'Home','/home',NULL,NULL,'fas fa-home',NULL,'A','Home',0,0,NULL),(1200,'POS','/pos',NULL,NULL,'fas fa-shopping-cart',NULL,'A','POS',1,1,NULL),(1300,'Finance','#',NULL,NULL,'fas fa-money-check-alt',NULL,'A','Finance',2,1,NULL),(1301,'Sales','/sales',NULL,NULL,NULL,NULL,'B','Finance',1,1,NULL),(1302,'Add New Sales','/pos',NULL,NULL,NULL,NULL,'C','/sales',1,0,NULL),(1303,'View Receipt','#',NULL,'ViewReceipt','fas fa-search',NULL,'C','/sales',2,1,NULL),(1304,'Update Status','#',NULL,'Edit','fas fa-edit',NULL,'C','/sales',3,1,NULL),(1305,'Cancel','#',NULL,'Delete','fas fa-not-equal',NULL,'C','/sales',4,1,NULL),(1306,'Show Payments','#',NULL,'ShowPayments','fas fa-search-dollar',NULL,'C','/sales',5,1,NULL),(1307,'Remove Payments','#',NULL,'DeletePayments','fas fa-trash-alt',NULL,'C','/sales',6,1,NULL),(1308,'Add Payments','#',NULL,'AddPayments','fas fa-address-card',NULL,'C','/sales',6,1,NULL),(1310,'Expense','/expense',NULL,NULL,NULL,NULL,'B','Finance',2,1,NULL),(1311,'Add New Expense','/expense/create',NULL,NULL,NULL,NULL,'C','/expense',1,1,NULL),(1312,'View','/expense/show','_blank',NULL,'fas fa-search',NULL,'C','/expense',2,1,NULL),(1313,'Edit','/expense/edit',NULL,NULL,'fas fa-edit',NULL,'C','/expense',3,1,NULL),(1314,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/expense',4,1,NULL),(1400,'Master Files','#',NULL,NULL,'fas fa-database',NULL,'A','Master Files',3,1,NULL),(1401,'Products','/products',NULL,NULL,NULL,NULL,'B','Master Files',1,1,NULL),(1402,'Add New Product','/products/create',NULL,NULL,NULL,NULL,'C','/products',1,1,NULL),(1403,'View','/products/show','_blank',NULL,'fas fa-search',NULL,'C','/products',2,1,NULL),(1404,'Edit','/products/edit',NULL,NULL,'fas fa-edit',NULL,'C','/products',3,1,NULL),(1405,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/products',4,1,NULL),(1406,'Manage Prices & Discounts','#',NULL,'SetPrices','fas fa-money-bill-wave',NULL,'C','/products',5,1,NULL),(1407,'Manage Qty','#',NULL,'SetQty','fas fa-chart-line',NULL,'C','/products',6,1,NULL),(1408,'Manage Visibility','#',NULL,'SetVisibility','fas fa-eye',NULL,'C','/products',7,1,NULL),(1409,'Print Barcode','#',NULL,'PrintBarcode','fas fa-barcode',NULL,'C','/products',8,1,NULL),(1410,'Customers.Suppliers','/persons',NULL,NULL,NULL,NULL,'B','Master Files',2,1,NULL),(1411,'Add New Customer.Supplier','/persons/create',NULL,NULL,NULL,NULL,'C','/persons',1,1,NULL),(1412,'View','/persons/show','_blank',NULL,'fas fa-search',NULL,'C','/persons',2,1,NULL),(1413,'Edit','/persons/edit',NULL,NULL,'fas fa-edit',NULL,'C','/persons',3,1,NULL),(1414,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/persons',4,1,NULL),(1420,'Compositions','/products/compositions',NULL,NULL,'fas fa-sitemap',NULL,'C','/products',2,1,NULL),(1500,'Settings','#',NULL,NULL,'fas fa-cogs',NULL,'A','Settings',5,1,NULL),(1510,'Discounts','/discounts',NULL,NULL,NULL,NULL,'B','Settings',1,1,NULL),(1511,'Add New Discounts','/discounts/create',NULL,NULL,NULL,NULL,'C','/discounts',1,1,NULL),(1512,'View','/discounts/show','_blank',NULL,'fas fa-search',NULL,'C','/discounts',2,1,NULL),(1513,'Edit','/discounts/edit',NULL,NULL,'fas fa-edit',NULL,'C','/discounts',3,1,NULL),(1514,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/discounts',4,1,NULL),(1520,'Categories','/categories',NULL,NULL,NULL,NULL,'B','Settings',2,1,NULL),(1521,'Add New Categories','/categories/create',NULL,NULL,NULL,NULL,'C','/categories',1,1,NULL),(1522,'View','/categories/show','_blank',NULL,'fas fa-search',NULL,'C','/categories',2,1,NULL),(1523,'Edit','/categories/edit',NULL,NULL,'fas fa-edit',NULL,'C','/categories',3,1,NULL),(1524,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/categories',4,1,NULL),(1530,'Stores','/stores',NULL,NULL,NULL,NULL,'B','Settings',3,1,NULL),(1531,'Add New Store','/stores/create',NULL,NULL,NULL,NULL,'C','/stores',1,1,NULL),(1532,'View','/stores/show','_blank',NULL,'fas fa-search',NULL,'C','/stores',2,1,NULL),(1533,'Edit','/stores/edit',NULL,NULL,'fas fa-edit',NULL,'C','/stores',3,1,NULL),(1534,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/stores',4,1,NULL),(1540,'Users','/users',NULL,NULL,NULL,NULL,'B','Settings',4,1,NULL),(1541,'Add New User','/users/create',NULL,NULL,NULL,NULL,'C','/users',1,1,NULL),(1542,'View','/users/show','_blank',NULL,'fas fa-search',NULL,'C','/users',2,1,NULL),(1543,'Edit','/users/edit',NULL,NULL,'fas fa-edit',NULL,'C','/users',3,1,NULL),(1544,'Delete','#',NULL,'Delete','fas fa-trash-alt',NULL,'C','/users',4,1,NULL),(1545,'Accessiblity','/users/accessibility',NULL,NULL,'fas fa-user-cog',NULL,'C','/users',5,1,NULL),(1550,'Company','/company',NULL,NULL,NULL,NULL,'B','Settings',5,1,NULL),(1555,'Rename Reports','/rename-reports',NULL,NULL,NULL,NULL,'B','Settings',6,1,NULL),(1700,'Reports','/reports',NULL,NULL,'fas fa-poll',NULL,'A','Reports',10,1,NULL),(1701,'Electronic Stock Card','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',1,1,'Electronic Stock Card'),(1702,'Sales Ledger','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',2,1,'Sales Ledger'),(1703,'Top Selling Products','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',3,1,'Top Selling Products'),(1704,'Inventory Critical Level','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',4,1,'Inventory Critical Level'),(1705,'General Ledger','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',5,1,'General Ledger'),(1706,'Inventory Stock on hand','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',6,1,'Inventory Stock on hand'),(1707,'Cashier\'s Report','/reports/show','_blank',NULL,NULL,NULL,'B','Reports',7,1,'Cashier\'s Report'),(1708,'Audit Trail History','reports/show','_blank',NULL,NULL,NULL,'B','Reports',8,1,'Audit Trail History'),(2000,'Accounting','#',NULL,NULL,' fab fa-monero',NULL,'A','Accounting',20,1,NULL),(2001,'Chart of Accounts','#',NULL,NULL,NULL,NULL,'B','Accounting',0,1,NULL),(2010,'Bank of Accounts','#',NULL,NULL,NULL,NULL,'B','Accounting',1,1,NULL),(2020,'Journal Entry','#',NULL,NULL,NULL,NULL,'B','Accounting',2,1,NULL),(2030,'Reimbursement','#',NULL,NULL,NULL,NULL,'B','Accounting',3,1,NULL);
/*!40000 ALTER TABLE `permalink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persons` (
  `pk_persons` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(500) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `iscustomer` tinyint(1) DEFAULT NULL,
  `issupplier` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_persons`),
  UNIQUE KEY `fullname` (`fullname`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `persons_ibfk_2` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,'Benjamin Bratt',NULL,NULL,'Cebu City','0032321234',NULL,1,1,'2017-12-02 13:42:59',1000,'2019-06-04 02:33:44',1000,1),(2,'Lending Group Inc.','lend@gmail.com','0032123','Cebu City','0032321234',NULL,0,1,'2017-12-02 13:43:25',1000,'2017-12-02 13:43:25',NULL,1),(6,'Alfred Reloj','alfred.suiterx@gmail.com',NULL,'0297 Nivel Hills Lahug',NULL,NULL,1,0,'2019-06-26 22:46:48',1013,'2019-06-26 22:46:48',NULL,1),(7,'Kevin Andrin','alfred.suiterx@gmail.com',NULL,'0297 Nivel Hills Lahug',NULL,NULL,1,0,'2019-06-26 22:47:08',1013,'2019-06-26 22:47:08',NULL,1),(8,'Procter',NULL,NULL,NULL,NULL,NULL,0,1,'2019-09-27 22:37:53',1013,'2019-09-27 22:37:53',NULL,1),(9,'S7',NULL,NULL,NULL,NULL,NULL,0,1,'2019-10-03 16:25:00',1013,'2019-10-05 16:46:36',1013,1);
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `pk_products` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(255) NOT NULL COMMENT 'if null then barcode is equals to pk_products',
  `type` char(10) NOT NULL COMMENT 'inventory, service',
  `name` varchar(255) DEFAULT NULL,
  `fk_categories` int(11) DEFAULT NULL,
  `fk_supplier` int(11) DEFAULT NULL COMMENT 'from persons table, hide if type = service',
  `cost` double(10,2) DEFAULT NULL COMMENT 'hide if type = service',
  `tax` char(3) NOT NULL COMMENT 'inc = inclusive, exc = esclusive',
  `uom` char(15) DEFAULT NULL COMMENT 'pcs,box,etc, hide if type = service',
  `alertqty` double(10,2) DEFAULT NULL COMMENT 'system warning low inventory, hide if type = service',
  `pictx` text,
  `background` char(10) DEFAULT NULL COMMENT 'grey,purple,blue,green',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` int(11) DEFAULT NULL,
  `ispos` tinyint(1) DEFAULT '1',
  `sku` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pk_products`),
  UNIQUE KEY `barcode` (`barcode`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_categories` (`fk_categories`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  KEY `fk_supplier` (`fk_supplier`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`fk_categories`) REFERENCES `categories` (`pk_categories`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `products_ibfk_3` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`),
  CONSTRAINT `products_ibfk_4` FOREIGN KEY (`fk_supplier`) REFERENCES `persons` (`pk_persons`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (17,'inv1220992541','inventory','Computer (1keyboard, 1mouse, 1cpu)',6,NULL,0.00,'inc','pcs',10.00,'products/UA2u1oVLtFqR5HzZz9umQHHf0BRgZdJSEKrRUG9y.jpeg','grey',NULL,'2017-12-06 15:12:43',1000,'2019-06-06 08:22:02',1000,1,1,NULL),(18,'ser1651838971','service','Menu A',1,NULL,0.00,'inc',NULL,0.00,'products/ZmUf0vkqwXHQPWwQoeWlriiVItDRHZM9QPsA0ifl.jpeg','grey',NULL,'2017-12-06 15:14:57',1000,'2019-06-06 08:22:51',1000,1,1,NULL),(20,'opic','inventory','Keyboard',6,NULL,10.00,'exc','pcs',20.00,'products/RiKlX7RlyEHwZFZeqh2PiAIvk9OYbxKOAAyMocyg.jpeg','grey',NULL,'2017-12-06 15:19:47',1000,'2019-06-06 08:22:13',1000,1,1,NULL),(21,'ser284356691','service','Menu C',5,NULL,0.00,'inc',NULL,0.00,'products/ODExnCs2auCtdDoNHFWH7zjtge2ylt7AtrGOIz04.jpeg','grey','testing remarks','2017-12-09 15:28:04',1000,'2019-06-06 08:23:04',1000,1,1,NULL),(22,'inv847797465','inventory','Oishi',5,NULL,50.00,'inc','pcs',10.00,'products/31vWp6RPfLhpmBUM12xMAJRcNUCR1JD0rd6MK6Vw.jpeg','grey',NULL,'2017-12-09 15:39:39',1000,'2019-06-07 01:17:55',1013,1,1,NULL),(23,'6002-81010063R','inventory','TUNA PANDESAL',5,NULL,60.00,'inc','pcs',10.00,'products/q42WdinjlqeUvwSWh6HlBIiydRoE5xEdRzBOdCjZ.jpeg','grey',NULL,'2017-12-09 15:40:14',1000,'2019-06-26 23:49:53',1013,1,1,NULL),(24,'inv956479008','inventory','Vitamilk',2,2,20.00,'inc','btl',10.00,'products/cT9KWhQyO8kFuDM0aUOwkRBy6D6IzGCZZqWH8z1K.jpeg','grey',NULL,'2017-12-09 15:40:47',1000,'2019-06-07 01:19:06',1013,1,1,NULL),(25,'inv1152813045','inventory','palmolive sh15ml',5,NULL,0.00,'inc','pcs',0.00,'products/jHuB1ZvRcSrRXLaMed5ibxuljjBqBwDcJ0JxTKir.jpeg','grey',NULL,'2017-12-09 15:43:54',1000,'2019-07-02 03:04:49',1013,1,1,NULL),(26,'inv186317457','inventory','safeguard clnsr acne',5,NULL,0.00,'inc','pcs',0.00,'products/HuWoo4kt0shheSyEaGjd1VvzDMJKgxoYrf5voa26.jpeg','grey',NULL,'2017-12-09 15:44:13',1000,'2019-07-02 03:05:24',1013,1,1,NULL),(27,'32','inventory','colgate tp reg asdf asdf asdf',5,1,12.00,'inc','pcs',10.00,'products/gpKwToeHzso63adopIUxMsEfcSPho1cZSMfjRviG.jpeg','grey','test','2017-12-09 15:44:28',1000,'2019-07-02 05:37:40',1013,1,1,NULL),(28,'inv212526972','inventory','mouse',6,NULL,0.00,'inc',NULL,0.00,'products/ZAK5YiKhjjxGiCAgkKzTHbJVKHJboxE87TrVqAUz.jpeg',NULL,NULL,'2019-04-09 06:23:08',1000,'2019-06-06 08:23:36',1000,1,1,NULL),(29,'test','inventory','test',2,NULL,0.00,'inc',NULL,2.00,NULL,NULL,NULL,'2019-06-05 06:51:58',1000,'2019-06-05 06:52:25',1000,1,1,NULL),(30,'inv166427802','inventory','Burger Yum (1patty, 1bread)',5,NULL,0.00,'inc','pcs',10.00,'products/4sPewJs6e2CqPhkWn24iCNgYq1vI411lXfYwcLW2.jpeg',NULL,'item composition\r\n1 bread\r\n1 patty','2019-06-06 08:28:03',1000,'2019-09-30 11:42:40',1013,1,1,NULL),(31,'inv1248561209','inventory','Bread',5,1,0.00,'inc',NULL,10.00,'products/tOJYCJLUQMAf6UVJCIGe0uT1EdJzIbyx3OmXNAlb.jpeg',NULL,NULL,'2019-06-06 08:29:18',1000,'2019-06-07 06:14:40',1013,1,1,NULL),(32,'9781599185057','inventory','beef patty',5,NULL,0.00,'inc','pcs',10.00,'products/P8pSxM3F1K3kHXrtfAXpllLEmAYrzk2Tb8NGdULk.jpeg',NULL,NULL,'2019-06-06 08:29:49',1000,'2019-06-26 23:43:37',1013,1,1,NULL),(33,'inv1417941097','service','Menu Q',5,NULL,50.00,'exc',NULL,0.00,'products/apple-icon.png',NULL,NULL,'2019-06-18 07:44:01',1013,'2019-06-18 07:54:28',1013,1,1,NULL),(34,'ser1507995829','service','Reflexology',5,NULL,0.00,'inc',NULL,0.00,'products/apple-icon.png',NULL,NULL,'2019-06-25 06:30:59',1013,'2019-06-25 06:37:52',1013,1,1,NULL),(35,'inv8242346','inventory','Tea',2,NULL,20.00,'inc','pcs',9.99,'products/JWra8YDnwImKQQMgD2VAvhMjzyp4qaIkmU45qXMC.jpeg',NULL,NULL,'2019-06-25 07:10:47',1013,'2019-07-02 05:43:01',1013,1,1,NULL),(36,'inv1716556465','inventory','House Special',2,NULL,50.00,'inc',NULL,0.00,'products/yYMHt0xtC3imsfHFat8IoLdJMdr4uEqVOqojJez2.jpeg',NULL,NULL,'2019-06-26 00:21:14',1013,'2019-07-02 05:39:43',1013,1,1,NULL),(37,'ser794129255','service','Aircon Cleaning',5,NULL,350.00,'inc','0',0.00,'products/apple-icon.png',NULL,NULL,'2019-06-26 04:29:46',1013,'2019-06-26 04:30:20',1013,1,1,NULL),(38,'ser1248733342','service','Burger Burger Regular',5,NULL,10.00,'inc',NULL,0.00,'products/apple-icon.png',NULL,NULL,'2019-06-26 23:28:16',1013,'2019-06-26 23:29:55',1013,1,1,NULL),(40,'inv1888382606','inventory','Black Coffee',2,1,30.00,'inc',NULL,0.00,'products/SLe86ftf5G0JLs2b76oSNQlPoZqsj6gNj3R8Ad1e.jpeg',NULL,NULL,'2019-07-02 02:57:15',1013,'2019-07-02 05:36:29',1013,1,1,NULL),(41,'inv1116651321','inventory','Cappuccino',2,NULL,80.00,'inc',NULL,0.00,'products/p5X4ihsGwLMWaInR3njdQPGPNbC3ebBX2Zcbiylo.jpeg',NULL,NULL,'2019-07-02 02:59:14',1013,'2019-07-02 05:36:05',1013,1,1,NULL),(42,'inv1611403182','inventory','MilkTea',2,NULL,50.00,'inc',NULL,0.00,'products/EJCtRmTuxFyvqFejQq7vYdU6xNkzujndMlFf96Ua.jpeg',NULL,NULL,'2019-07-02 05:47:16',1013,'2019-07-02 05:47:16',NULL,1,1,NULL),(43,'inv1467072292','inventory','Essential Oil Lavender',7,NULL,50.00,'inc','50ml',10.00,'products/apple-icon.png',NULL,NULL,'2019-09-27 22:23:16',1013,'2019-09-27 22:59:44',1013,1,1,NULL),(44,'inv1027550972','inventory','stapler',9,NULL,50.00,'inc','pc',5.00,'products/hlI9DMYnxRSIwHNjJK5PtlSgkOKEufkqdNhWo7FA.jpeg',NULL,NULL,'2019-09-30 11:07:18',1013,'2019-09-30 11:07:18',NULL,1,1,NULL),(45,'inv1146098741','inventory','cheese',5,NULL,30.00,'inc','pc',10.00,'products/apple-icon.png',NULL,NULL,'2019-09-30 11:20:30',1013,'2019-09-30 11:20:30',NULL,1,1,NULL),(46,'ser741761630','service','cheese burger',5,NULL,100.00,'inc',NULL,0.00,'products/PEaL09zQDp3YMBbzcuiVCD7d1jYHbEKmDMbsIoZU.png',NULL,NULL,'2019-09-30 11:22:22',1013,'2019-09-30 23:30:02',1013,1,1,NULL),(47,'ser1245029891','service','New Cheese Burger',5,NULL,100.00,'inc',NULL,0.00,'products/apple-icon.png',NULL,NULL,'2019-09-30 11:36:28',1013,'2019-09-30 11:36:28',NULL,1,1,NULL),(48,'inv519300421','inventory','Dish washing Liquid',10,NULL,100.00,'inc','5 gallon',10.00,'products/apple-icon.png',NULL,NULL,'2019-09-30 11:55:09',1013,'2019-09-30 11:58:09',1013,1,1,NULL),(49,'inv125919270','inventory','Disinfectant',10,NULL,0.00,'inc',NULL,0.00,'products/apple-icon.png',NULL,NULL,'2019-10-01 13:24:21',1013,'2019-10-01 13:24:21',NULL,1,1,NULL),(50,'inv1144710158','inventory','2 Eye Sensor w/ Indicator',11,9,850.00,'inc',NULL,0.00,'products/rlaXN10lPHuJ2SVedu4YXvgZChKYj9yYK5Cat9Bm.png',NULL,NULL,'2019-10-03 16:28:23',1013,'2019-10-07 12:49:15',1000,1,1,'111'),(51,'inv387486679','inventory','4 Eye Sensor w/ Indicator',11,9,1700.00,'inc',NULL,0.00,'products/A9Uj5evT9ahXwV4KL8ecb6DEEMeX18usa8LK2VBJ.png',NULL,NULL,'2019-10-05 16:51:49',1013,'2019-10-05 16:51:49',NULL,1,1,NULL),(52,'inv539826007','inventory','Business Book',5,8,50.00,'inc','pc',10.00,'products/apple-icon.png',NULL,NULL,'2019-10-08 00:32:39',1013,'2019-10-08 00:32:39',NULL,1,1,'SAMPLE');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_prices_history`
--

DROP TABLE IF EXISTS `products_prices_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_prices_history` (
  `fk_products` int(11) NOT NULL,
  `fk_stores` int(11) NOT NULL,
  `price` double(10,2) DEFAULT NULL,
  `oldprice` double(10,2) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `olddiscount` double(10,2) DEFAULT NULL,
  `fk_createdby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_prices_history`
--

LOCK TABLES `products_prices_history` WRITE;
/*!40000 ALTER TABLE `products_prices_history` DISABLE KEYS */;
INSERT INTO `products_prices_history` VALUES (50,1000,850.00,850.00,0.00,0.00,1000,'2019-10-07 04:49:00','2019-10-07 04:49:00'),(50,1002,850.00,850.00,0.00,0.00,1000,'2019-10-07 04:49:00','2019-10-07 04:49:00'),(50,1001,850.00,850.00,0.00,0.00,1000,'2019-10-07 04:49:00','2019-10-07 04:49:00'),(50,1005,0.00,0.00,0.00,0.00,1000,'2019-10-07 04:49:00','2019-10-07 04:49:00'),(40,1000,100.00,0.00,0.00,0.00,1013,'2019-10-07 07:05:40','2019-10-07 07:05:40'),(40,1002,100.00,100.00,0.00,0.00,1013,'2019-10-07 07:05:40','2019-10-07 07:05:40'),(40,1001,100.00,100.00,0.00,0.00,1013,'2019-10-07 07:05:40','2019-10-07 07:05:40'),(40,1005,0.00,0.00,0.00,0.00,1013,'2019-10-07 07:05:40','2019-10-07 07:05:40'),(40,1000,1000.00,100.00,0.00,0.00,1013,'2019-10-07 16:28:40','2019-10-07 16:28:40'),(40,1002,100.00,100.00,0.00,0.00,1013,'2019-10-07 16:28:40','2019-10-07 16:28:40'),(40,1001,100.00,100.00,0.00,0.00,1013,'2019-10-07 16:28:40','2019-10-07 16:28:40'),(40,1005,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:28:40','2019-10-07 16:28:40'),(45,1000,100.00,30.00,0.00,0.00,1013,'2019-10-07 16:30:42','2019-10-07 16:30:42'),(45,1002,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:30:42','2019-10-07 16:30:42'),(45,1001,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:30:42','2019-10-07 16:30:42'),(45,1005,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:30:42','2019-10-07 16:30:42'),(52,1000,1000.00,0.00,0.00,0.00,1013,'2019-10-07 16:34:43','2019-10-07 16:34:43'),(52,1002,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:34:43','2019-10-07 16:34:43'),(52,1001,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:34:43','2019-10-07 16:34:43'),(52,1005,0.00,0.00,0.00,0.00,1013,'2019-10-07 16:34:43','2019-10-07 16:34:43');
/*!40000 ALTER TABLE `products_prices_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productscomposition`
--

DROP TABLE IF EXISTS `productscomposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productscomposition` (
  `fk_products` int(11) DEFAULT NULL,
  `fk_compositions` int(11) DEFAULT NULL,
  `qty` double(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_updatedby` int(11) DEFAULT NULL,
  KEY `fk_products` (`fk_products`),
  KEY `fk_composition` (`fk_compositions`),
  CONSTRAINT `productscomposition_ibfk_1` FOREIGN KEY (`fk_products`) REFERENCES `products` (`pk_products`),
  CONSTRAINT `productscomposition_ibfk_2` FOREIGN KEY (`fk_compositions`) REFERENCES `products` (`pk_products`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productscomposition`
--

LOCK TABLES `productscomposition` WRITE;
/*!40000 ALTER TABLE `productscomposition` DISABLE KEYS */;
INSERT INTO `productscomposition` VALUES (18,27,10.00,'2019-04-08 21:25:55',1000,'2019-04-08 21:25:55',NULL),(18,22,3.00,'2019-04-08 21:25:55',1000,'2019-04-08 21:25:55',NULL),(17,20,1.00,'2019-06-05 11:47:22',1000,'2019-06-05 11:47:22',NULL),(17,28,1.00,'2019-06-05 11:47:22',1000,'2019-06-05 11:47:22',NULL),(30,32,1.00,'2019-06-09 06:26:22',1013,'2019-06-09 06:26:22',NULL),(30,31,1.00,'2019-06-09 06:26:22',1013,'2019-06-09 06:26:22',NULL),(21,32,10.00,'2019-06-17 23:36:32',1013,'2019-06-17 23:36:32',NULL),(21,31,10.00,'2019-06-17 23:36:32',1013,'2019-06-17 23:36:32',NULL),(33,17,5.00,'2019-06-17 23:45:43',1013,'2019-06-17 23:45:43',NULL),(33,30,5.00,'2019-06-17 23:45:43',1013,'2019-06-17 23:45:43',NULL),(38,32,1.00,'2019-06-26 15:28:41',1013,'2019-06-26 15:28:41',NULL),(38,31,1.00,'2019-06-26 15:28:41',1013,'2019-06-26 15:28:41',NULL),(46,32,1.00,'2019-09-30 03:28:53',1013,'2019-09-30 03:28:53',NULL),(46,31,1.00,'2019-09-30 03:28:53',1013,'2019-09-30 03:28:53',NULL),(46,45,1.00,'2019-09-30 03:28:53',1013,'2019-09-30 03:28:53',NULL),(47,32,1.00,'2019-09-30 07:24:34',1000,'2019-09-30 07:24:34',NULL),(47,31,1.00,'2019-09-30 07:24:34',1000,'2019-09-30 07:24:34',NULL),(47,45,1.00,'2019-09-30 07:24:34',1000,'2019-09-30 07:24:34',NULL);
/*!40000 ALTER TABLE `productscomposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productsprices`
--

DROP TABLE IF EXISTS `productsprices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productsprices` (
  `fk_products` int(11) NOT NULL,
  `fk_stores` int(11) NOT NULL,
  `price` double(10,2) DEFAULT '0.00',
  `oldprice` double(10,2) DEFAULT '0.00' COMMENT 'price before adjustment',
  `discount` double(10,2) DEFAULT '0.00' COMMENT 'percentage',
  `olddiscount` double(10,2) DEFAULT '0.00' COMMENT 'discount before adjustment',
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  UNIQUE KEY `fk_products` (`fk_products`,`fk_stores`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  KEY `fk_stores` (`fk_stores`),
  CONSTRAINT `productsprices_ibfk_3` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `productsprices_ibfk_4` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`),
  CONSTRAINT `productsprices_ibfk_5` FOREIGN KEY (`fk_products`) REFERENCES `products` (`pk_products`),
  CONSTRAINT `productsprices_ibfk_6` FOREIGN KEY (`fk_stores`) REFERENCES `stores` (`pk_stores`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productsprices`
--

LOCK TABLES `productsprices` WRITE;
/*!40000 ALTER TABLE `productsprices` DISABLE KEYS */;
INSERT INTO `productsprices` VALUES (17,1000,10.00,10.00,50.00,50.00,'2017-12-08 11:17:15',NULL,'2017-12-08 11:17:15',NULL),(17,1001,30.00,30.00,10.00,1.00,'2017-12-08 11:17:15',NULL,'2017-12-08 11:17:15',NULL),(17,1002,20.00,20.00,10.00,10.00,'2017-12-08 11:17:15',NULL,'2017-12-08 11:17:15',NULL),(18,1000,1000.00,100.00,0.00,0.00,'2017-12-08 14:41:46',NULL,'2017-12-08 14:41:46',NULL),(18,1001,1000.00,100.00,0.00,0.00,'2017-12-08 14:41:46',NULL,'2017-12-08 14:41:46',NULL),(18,1002,1000.00,100.00,0.00,0.00,'2017-12-08 14:41:46',NULL,'2017-12-08 14:41:46',NULL),(20,1000,10.00,0.00,0.00,0.00,'2017-12-06 15:20:07',NULL,'2017-12-06 15:20:07',NULL),(20,1001,30.00,0.00,0.00,0.00,'2017-12-06 15:20:07',NULL,'2017-12-06 15:20:07',NULL),(20,1002,17.00,0.00,0.00,0.00,'2017-12-06 15:20:07',NULL,'2017-12-06 15:20:07',NULL),(21,1000,20.00,0.00,0.00,0.00,'2017-12-09 15:28:25',NULL,'2017-12-09 15:28:25',NULL),(21,1001,4.00,0.00,0.00,0.00,'2017-12-09 15:28:25',NULL,'2017-12-09 15:28:25',NULL),(21,1002,30.00,0.00,0.00,0.00,'2017-12-09 15:28:25',NULL,'2017-12-09 15:28:25',NULL),(22,1000,16.00,0.00,0.00,0.00,'2017-12-09 15:40:59',NULL,'2017-12-09 15:40:59',NULL),(22,1001,16.00,0.00,0.00,0.00,'2017-12-09 15:40:59',NULL,'2017-12-09 15:40:59',NULL),(22,1002,16.00,0.00,0.00,0.00,'2017-12-09 15:40:59',NULL,'2017-12-09 15:40:59',NULL),(23,1000,29.00,0.00,0.00,0.00,'2017-12-09 15:41:10',NULL,'2017-12-09 15:41:10',NULL),(23,1001,29.00,0.00,0.00,0.00,'2017-12-09 15:41:10',NULL,'2017-12-09 15:41:10',NULL),(23,1002,29.00,0.00,0.00,0.00,'2017-12-09 15:41:10',NULL,'2017-12-09 15:41:10',NULL),(24,1000,30.00,30.00,0.00,0.00,'2017-12-09 15:43:22',NULL,'2017-12-09 15:43:22',NULL),(24,1001,23.50,0.00,0.00,0.00,'2017-12-09 15:43:22',NULL,'2017-12-09 15:43:22',NULL),(24,1002,30.00,30.00,0.00,0.00,'2017-12-09 15:43:22',NULL,'2017-12-09 15:43:22',NULL),(25,1000,6.00,0.00,0.00,0.00,'2017-12-09 15:44:57',NULL,'2017-12-09 15:44:57',NULL),(25,1001,6.00,0.00,0.00,0.00,'2017-12-09 15:44:57',NULL,'2017-12-09 15:44:57',NULL),(25,1002,6.00,0.00,0.00,0.00,'2017-12-09 15:44:57',NULL,'2017-12-09 15:44:57',NULL),(26,1000,122.50,122.00,0.00,0.00,'2017-12-09 15:47:26',NULL,'2017-12-09 15:47:26',NULL),(26,1001,122.50,122.00,0.00,0.00,'2017-12-09 15:47:26',NULL,'2017-12-09 15:47:26',NULL),(26,1002,122.50,122.00,0.00,0.00,'2017-12-09 15:47:26',NULL,'2017-12-09 15:47:26',NULL),(27,1000,4.00,4.00,1.00,1.00,'2019-06-05 07:27:22',NULL,'2019-06-05 07:27:22',NULL),(27,1001,2.00,2.00,5.00,5.00,'2019-06-05 07:27:22',NULL,'2019-06-05 07:27:22',NULL),(27,1002,3.00,3.00,3.00,3.00,'2019-06-05 07:27:22',NULL,'2019-06-05 07:27:22',NULL),(27,1005,1.00,10.00,7.00,7.00,'2019-06-05 07:27:22',NULL,'2019-06-05 07:27:22',NULL),(28,1000,500.00,0.00,0.00,0.00,'2019-04-09 06:23:25',NULL,'2019-04-09 06:23:25',NULL),(28,1001,500.00,0.00,0.00,0.00,'2019-04-09 06:23:25',NULL,'2019-04-09 06:23:25',NULL),(28,1002,500.00,0.00,0.00,0.00,'2019-04-09 06:23:25',NULL,'2019-04-09 06:23:25',NULL),(28,1005,500.00,0.00,0.00,0.00,'2019-04-09 06:23:25',NULL,'2019-04-09 06:23:25',NULL),(30,1000,130.00,0.00,0.00,0.00,'2019-06-06 08:33:36',NULL,'2019-06-06 08:33:36',NULL),(30,1001,130.00,0.00,0.00,0.00,'2019-06-06 08:33:36',NULL,'2019-06-06 08:33:36',NULL),(30,1002,130.00,0.00,0.00,0.00,'2019-06-06 08:33:36',NULL,'2019-06-06 08:33:36',NULL),(30,1005,0.00,0.00,0.00,0.00,'2019-06-06 08:33:36',NULL,'2019-06-06 08:33:36',NULL),(31,1000,20.00,0.00,0.00,0.00,'2019-06-06 08:32:46',NULL,'2019-06-06 08:32:46',NULL),(31,1001,20.00,0.00,0.00,0.00,'2019-06-06 08:32:46',NULL,'2019-06-06 08:32:46',NULL),(31,1002,20.00,0.00,0.00,0.00,'2019-06-06 08:32:46',NULL,'2019-06-06 08:32:46',NULL),(31,1005,0.00,0.00,0.00,0.00,'2019-06-06 08:32:46',NULL,'2019-06-06 08:32:46',NULL),(32,1000,100.00,100.00,0.00,50.00,'2019-07-10 23:29:23',NULL,'2019-07-10 23:29:23',NULL),(32,1001,100.00,100.00,0.00,0.00,'2019-07-10 23:29:23',NULL,'2019-07-10 23:29:23',NULL),(32,1002,100.00,100.00,0.00,0.00,'2019-07-10 23:29:23',NULL,'2019-07-10 23:29:23',NULL),(32,1005,0.00,0.00,0.00,0.00,'2019-07-10 23:29:23',NULL,'2019-07-10 23:29:23',NULL),(33,1000,100.00,0.00,0.00,0.00,'2019-06-18 07:49:52',NULL,'2019-06-18 07:49:52',NULL),(33,1001,100.00,0.00,0.00,0.00,'2019-06-18 07:49:52',NULL,'2019-06-18 07:49:52',NULL),(33,1002,100.00,0.00,0.00,0.00,'2019-06-18 07:49:52',NULL,'2019-06-18 07:49:52',NULL),(33,1005,100.00,0.00,0.00,0.00,'2019-06-18 07:49:52',NULL,'2019-06-18 07:49:52',NULL),(34,1000,500.00,0.00,0.00,0.00,'2019-06-25 06:42:24',NULL,'2019-06-25 06:42:24',NULL),(34,1001,0.00,0.00,0.00,0.00,'2019-06-25 06:42:24',NULL,'2019-06-25 06:42:24',NULL),(34,1002,0.00,0.00,0.00,0.00,'2019-06-25 06:42:24',NULL,'2019-06-25 06:42:24',NULL),(34,1005,0.00,0.00,0.00,0.00,'2019-06-25 06:42:24',NULL,'2019-06-25 06:42:24',NULL),(35,1000,0.00,0.00,0.00,0.00,'2019-06-27 00:05:12',NULL,'2019-06-27 00:05:12',NULL),(35,1001,0.00,0.00,0.00,0.00,'2019-06-27 00:05:12',NULL,'2019-06-27 00:05:12',NULL),(35,1002,0.00,0.00,0.00,0.00,'2019-06-27 00:05:12',NULL,'2019-06-27 00:05:12',NULL),(35,1005,0.00,0.00,0.00,0.00,'2019-06-27 00:05:12',NULL,'2019-06-27 00:05:12',NULL),(36,1000,180.00,0.00,0.00,0.00,'2019-07-02 05:40:45',NULL,'2019-07-02 05:40:45',NULL),(36,1001,180.00,0.00,0.00,0.00,'2019-07-02 05:40:45',NULL,'2019-07-02 05:40:45',NULL),(36,1002,180.00,0.00,0.00,0.00,'2019-07-02 05:40:45',NULL,'2019-07-02 05:40:45',NULL),(36,1005,0.00,0.00,0.00,0.00,'2019-07-02 05:40:45',NULL,'2019-07-02 05:40:45',NULL),(38,1000,20.00,0.00,0.00,0.00,'2019-06-26 23:29:31',NULL,'2019-06-26 23:29:31',NULL),(38,1001,0.00,0.00,0.00,0.00,'2019-06-26 23:29:31',NULL,'2019-06-26 23:29:31',NULL),(38,1002,0.00,0.00,0.00,0.00,'2019-06-26 23:29:31',NULL,'2019-06-26 23:29:31',NULL),(38,1005,0.00,0.00,0.00,0.00,'2019-06-26 23:29:31',NULL,'2019-06-26 23:29:31',NULL),(40,1000,1000.00,100.00,0.00,0.00,'2019-10-08 00:28:40',1013,'2019-10-08 00:28:40',NULL),(40,1001,100.00,100.00,0.00,0.00,'2019-10-08 00:28:40',1013,'2019-10-08 00:28:40',NULL),(40,1002,100.00,100.00,0.00,0.00,'2019-10-08 00:28:40',1013,'2019-10-08 00:28:40',NULL),(40,1005,0.00,0.00,0.00,0.00,'2019-10-08 00:28:40',1013,'2019-10-08 00:28:40',NULL),(41,1000,150.00,0.00,0.00,0.00,'2019-07-02 05:35:43',NULL,'2019-07-02 05:35:43',NULL),(41,1001,150.00,0.00,0.00,0.00,'2019-07-02 05:35:43',NULL,'2019-07-02 05:35:43',NULL),(41,1002,150.00,0.00,0.00,0.00,'2019-07-02 05:35:43',NULL,'2019-07-02 05:35:43',NULL),(41,1005,0.00,0.00,0.00,0.00,'2019-07-02 05:35:43',NULL,'2019-07-02 05:35:43',NULL),(42,1000,120.00,0.00,0.00,0.00,'2019-07-02 05:49:45',NULL,'2019-07-02 05:49:45',NULL),(42,1001,120.00,0.00,0.00,0.00,'2019-07-02 05:49:45',NULL,'2019-07-02 05:49:45',NULL),(42,1002,120.00,0.00,0.00,0.00,'2019-07-02 05:49:45',NULL,'2019-07-02 05:49:45',NULL),(42,1005,0.00,0.00,0.00,0.00,'2019-07-02 05:49:45',NULL,'2019-07-02 05:49:45',NULL),(43,1000,100.00,0.00,0.00,0.00,'2019-09-27 22:32:21',NULL,'2019-09-27 22:32:21',NULL),(43,1001,0.00,0.00,0.00,0.00,'2019-09-27 22:32:21',NULL,'2019-09-27 22:32:21',NULL),(43,1002,0.00,0.00,0.00,0.00,'2019-09-27 22:32:21',NULL,'2019-09-27 22:32:21',NULL),(43,1005,0.00,0.00,0.00,0.00,'2019-09-27 22:32:21',NULL,'2019-09-27 22:32:21',NULL),(44,1000,100.00,0.00,0.00,0.00,'2019-09-30 11:09:27',NULL,'2019-09-30 11:09:27',NULL),(44,1001,0.00,0.00,0.00,0.00,'2019-09-30 11:09:27',NULL,'2019-09-30 11:09:27',NULL),(44,1002,0.00,0.00,0.00,0.00,'2019-09-30 11:09:27',NULL,'2019-09-30 11:09:27',NULL),(44,1005,0.00,0.00,0.00,0.00,'2019-09-30 11:09:27',NULL,'2019-09-30 11:09:27',NULL),(45,1000,100.00,30.00,0.00,0.00,'2019-10-08 00:30:42',1013,'2019-10-08 00:30:42',NULL),(45,1001,0.00,0.00,0.00,0.00,'2019-10-08 00:30:42',1013,'2019-10-08 00:30:42',NULL),(45,1002,0.00,0.00,0.00,0.00,'2019-10-08 00:30:42',1013,'2019-10-08 00:30:42',NULL),(45,1005,0.00,0.00,0.00,0.00,'2019-10-08 00:30:42',1013,'2019-10-08 00:30:42',NULL),(46,1000,150.00,150.00,0.00,0.00,'2019-09-30 11:28:30',NULL,'2019-09-30 11:28:30',NULL),(46,1001,0.00,0.00,0.00,0.00,'2019-09-30 11:28:30',NULL,'2019-09-30 11:28:30',NULL),(46,1002,0.00,0.00,0.00,0.00,'2019-09-30 11:28:30',NULL,'2019-09-30 11:28:30',NULL),(46,1005,0.00,0.00,0.00,0.00,'2019-09-30 11:28:30',NULL,'2019-09-30 11:28:30',NULL),(47,1000,150.00,0.00,0.00,0.00,'2019-09-30 11:37:28',NULL,'2019-09-30 11:37:28',NULL),(47,1001,0.00,0.00,0.00,0.00,'2019-09-30 11:37:28',NULL,'2019-09-30 11:37:28',NULL),(47,1002,0.00,0.00,0.00,0.00,'2019-09-30 11:37:28',NULL,'2019-09-30 11:37:28',NULL),(47,1005,0.00,0.00,0.00,0.00,'2019-09-30 11:37:28',NULL,'2019-09-30 11:37:28',NULL),(48,1000,0.00,15.00,0.00,0.00,'2019-09-30 11:59:44',NULL,'2019-09-30 11:59:44',NULL),(48,1001,0.00,0.00,0.00,0.00,'2019-09-30 11:59:44',NULL,'2019-09-30 11:59:44',NULL),(48,1002,0.00,0.00,0.00,0.00,'2019-09-30 11:59:44',NULL,'2019-09-30 11:59:44',NULL),(48,1005,0.00,0.00,0.00,0.00,'2019-09-30 11:59:44',NULL,'2019-09-30 11:59:44',NULL),(50,1000,850.00,850.00,0.00,0.00,'2019-10-07 12:49:00',1000,'2019-10-07 12:49:00',NULL),(50,1001,850.00,850.00,0.00,0.00,'2019-10-07 12:49:00',1000,'2019-10-07 12:49:00',NULL),(50,1002,850.00,850.00,0.00,0.00,'2019-10-07 12:49:00',1000,'2019-10-07 12:49:00',NULL),(50,1005,0.00,0.00,0.00,0.00,'2019-10-07 12:49:00',1000,'2019-10-07 12:49:00',NULL),(52,1000,1000.00,0.00,0.00,0.00,'2019-10-08 00:34:43',1013,'2019-10-08 00:34:43',NULL),(52,1001,0.00,0.00,0.00,0.00,'2019-10-08 00:34:43',1013,'2019-10-08 00:34:43',NULL),(52,1002,0.00,0.00,0.00,0.00,'2019-10-08 00:34:43',1013,'2019-10-08 00:34:43',NULL),(52,1005,0.00,0.00,0.00,0.00,'2019-10-08 00:34:43',1013,'2019-10-08 00:34:43',NULL);
/*!40000 ALTER TABLE `productsprices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productsqty`
--

DROP TABLE IF EXISTS `productsqty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productsqty` (
  `fk_products` int(11) DEFAULT NULL,
  `fk_stores` int(11) DEFAULT NULL,
  `qty` double(10,2) DEFAULT NULL COMMENT 'positive,negative',
  `oldqty` double(10,2) DEFAULT NULL COMMENT 'qty before adjustment',
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  KEY `fk_products` (`fk_products`),
  KEY `fk_stores` (`fk_stores`),
  CONSTRAINT `productsqty_ibfk_3` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `productsqty_ibfk_4` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`),
  CONSTRAINT `productsqty_ibfk_5` FOREIGN KEY (`fk_products`) REFERENCES `products` (`pk_products`),
  CONSTRAINT `productsqty_ibfk_6` FOREIGN KEY (`fk_stores`) REFERENCES `stores` (`pk_stores`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productsqty`
--

LOCK TABLES `productsqty` WRITE;
/*!40000 ALTER TABLE `productsqty` DISABLE KEYS */;
INSERT INTO `productsqty` VALUES (27,1000,10.00,0.00,'2017-12-14 17:08:42',NULL,'2017-12-14 17:08:42',NULL,NULL),(27,1001,0.00,0.00,'2017-12-14 17:08:42',NULL,'2017-12-14 17:08:42',NULL,NULL),(27,1002,0.00,0.00,'2017-12-14 17:08:42',NULL,'2017-12-14 17:08:42',NULL,NULL),(27,1000,2.00,3.00,'2017-12-14 17:09:41',NULL,'2017-12-14 17:09:41',NULL,NULL),(27,1001,0.00,0.00,'2017-12-14 17:09:41',NULL,'2017-12-14 17:09:41',NULL,NULL),(27,1002,0.00,0.00,'2017-12-14 17:09:41',NULL,'2017-12-14 17:09:41',NULL,NULL),(17,1000,5.00,0.00,'2017-12-14 17:13:00',NULL,'2017-12-14 17:13:00',NULL,NULL),(17,1001,0.00,0.00,'2017-12-14 17:13:00',NULL,'2017-12-14 17:13:00',NULL,NULL),(17,1002,0.00,0.00,'2017-12-14 17:13:00',NULL,'2017-12-14 17:13:00',NULL,NULL),(27,1000,0.00,3.00,'2017-12-14 17:57:57',NULL,'2017-12-14 17:57:57',NULL,NULL),(27,1001,0.00,0.00,'2017-12-14 17:57:57',NULL,'2017-12-14 17:57:57',NULL,NULL),(27,1002,0.00,0.00,'2017-12-14 17:57:57',NULL,'2017-12-14 17:57:57',NULL,NULL),(20,1000,10.00,0.00,'2017-12-15 09:58:45',NULL,'2017-12-15 09:58:45',NULL,NULL),(20,1001,11.00,0.00,'2017-12-15 09:58:45',NULL,'2017-12-15 09:58:45',NULL,NULL),(20,1002,12.00,0.00,'2017-12-15 09:58:45',NULL,'2017-12-15 09:58:45',NULL,NULL),(22,1000,50.00,0.00,'2017-12-15 10:02:07',NULL,'2017-12-15 10:02:07',NULL,NULL),(22,1001,51.00,0.00,'2017-12-15 10:02:07',NULL,'2017-12-15 10:02:07',NULL,NULL),(22,1002,52.00,0.00,'2017-12-15 10:02:07',NULL,'2017-12-15 10:02:07',NULL,NULL),(27,1000,10.00,0.00,'2017-12-19 13:28:34',NULL,'2017-12-19 13:28:34',NULL,NULL),(27,1001,10.00,0.00,'2017-12-19 13:28:34',NULL,'2017-12-19 13:28:34',NULL,NULL),(27,1002,10.00,0.00,'2017-12-19 13:28:34',NULL,'2017-12-19 13:28:34',NULL,NULL),(17,1000,10.00,1.00,'2017-12-19 13:28:45',NULL,'2017-12-19 13:28:45',NULL,NULL),(17,1001,10.00,0.00,'2017-12-19 13:28:45',NULL,'2017-12-19 13:28:45',NULL,NULL),(17,1002,10.00,0.00,'2017-12-19 13:28:45',NULL,'2017-12-19 13:28:45',NULL,NULL),(25,1000,10.00,0.00,'2017-12-19 13:29:06',NULL,'2017-12-19 13:29:06',NULL,NULL),(25,1001,10.00,0.00,'2017-12-19 13:29:06',NULL,'2017-12-19 13:29:06',NULL,NULL),(25,1002,10.00,0.00,'2017-12-19 13:29:06',NULL,'2017-12-19 13:29:06',NULL,NULL),(26,1000,10.00,0.00,'2017-12-19 13:29:18',NULL,'2017-12-19 13:29:18',NULL,NULL),(26,1001,10.00,0.00,'2017-12-19 13:29:18',NULL,'2017-12-19 13:29:18',NULL,NULL),(26,1002,0.00,0.00,'2017-12-19 13:29:18',NULL,'2017-12-19 13:29:18',NULL,NULL),(26,1000,10.00,10.00,'2017-12-19 13:29:34',NULL,'2017-12-19 13:29:34',NULL,NULL),(26,1001,10.00,10.00,'2017-12-19 13:29:34',NULL,'2017-12-19 13:29:34',NULL,NULL),(26,1002,0.00,0.00,'2017-12-19 13:29:34',NULL,'2017-12-19 13:29:34',NULL,NULL),(26,1000,0.00,20.00,'2017-12-19 13:29:46',NULL,'2017-12-19 13:29:46',NULL,NULL),(26,1001,0.00,20.00,'2017-12-19 13:29:46',NULL,'2017-12-19 13:29:46',NULL,NULL),(26,1002,10.00,0.00,'2017-12-19 13:29:46',NULL,'2017-12-19 13:29:46',NULL,NULL),(23,1000,20.00,0.00,'2017-12-19 13:29:54',NULL,'2017-12-19 13:29:54',NULL,NULL),(23,1001,20.00,0.00,'2017-12-19 13:29:54',NULL,'2017-12-19 13:29:54',NULL,NULL),(23,1002,20.00,0.00,'2017-12-19 13:29:54',NULL,'2017-12-19 13:29:54',NULL,NULL),(24,1000,20.00,0.00,'2017-12-19 13:30:03',NULL,'2017-12-19 13:30:03',NULL,NULL),(24,1001,20.00,0.00,'2017-12-19 13:30:03',NULL,'2017-12-19 13:30:03',NULL,NULL),(24,1002,20.00,0.00,'2017-12-19 13:30:03',NULL,'2017-12-19 13:30:03',NULL,NULL),(25,1000,1.00,9.00,'2017-12-23 10:00:00',NULL,'2017-12-23 10:00:00',NULL,NULL),(25,1001,0.00,10.00,'2017-12-23 10:00:00',NULL,'2017-12-23 10:00:00',NULL,NULL),(25,1002,0.00,10.00,'2017-12-23 10:00:00',NULL,'2017-12-23 10:00:00',NULL,NULL),(27,1000,6.00,9.00,'2017-12-23 17:36:37',NULL,'2017-12-23 17:36:37',NULL,NULL),(27,1001,0.00,10.00,'2017-12-23 17:36:37',NULL,'2017-12-23 17:36:37',NULL,NULL),(27,1002,0.00,10.00,'2017-12-23 17:36:37',NULL,'2017-12-23 17:36:37',NULL,NULL),(27,1005,10.00,0.00,'2019-03-24 18:13:31',NULL,'2019-03-24 18:13:31',NULL,NULL),(27,1000,0.00,13.00,'2019-03-24 18:13:31',NULL,'2019-03-24 18:13:31',NULL,NULL),(27,1001,0.00,8.00,'2019-03-24 18:13:31',NULL,'2019-03-24 18:13:31',NULL,NULL),(27,1002,0.00,10.00,'2019-03-24 18:13:31',NULL,'2019-03-24 18:13:31',NULL,NULL),(27,1000,-13.00,13.00,'2019-03-25 11:42:32',NULL,'2019-03-25 11:42:32',NULL,NULL),(27,1001,0.00,8.00,'2019-03-25 11:42:32',NULL,'2019-03-25 11:42:32',NULL,NULL),(27,1002,0.00,10.00,'2019-03-25 11:42:32',NULL,'2019-03-25 11:42:32',NULL,NULL),(27,1005,0.00,5.00,'2019-03-25 11:42:32',NULL,'2019-03-25 11:42:32',NULL,NULL),(27,1000,13.00,0.00,'2019-03-25 11:42:51',NULL,'2019-03-25 11:42:51',NULL,NULL),(27,1001,0.00,8.00,'2019-03-25 11:42:51',NULL,'2019-03-25 11:42:51',NULL,NULL),(27,1002,0.00,10.00,'2019-03-25 11:42:51',NULL,'2019-03-25 11:42:51',NULL,NULL),(27,1005,-5.00,5.00,'2019-03-25 11:42:51',NULL,'2019-03-25 11:42:51',NULL,NULL),(27,1000,0.00,13.00,'2019-03-25 11:43:09',NULL,'2019-03-25 11:43:09',NULL,NULL),(27,1001,0.00,8.00,'2019-03-25 11:43:09',NULL,'2019-03-25 11:43:09',NULL,NULL),(27,1002,0.00,10.00,'2019-03-25 11:43:09',NULL,'2019-03-25 11:43:09',NULL,NULL),(27,1005,10.00,0.00,'2019-03-25 11:43:09',NULL,'2019-03-25 11:43:09',NULL,NULL),(28,1000,100.00,0.00,'2019-04-09 06:23:35',1000,'2019-04-09 06:23:35',NULL,NULL),(28,1001,100.00,0.00,'2019-04-09 06:23:35',1000,'2019-04-09 06:23:35',NULL,NULL),(28,1002,100.00,0.00,'2019-04-09 06:23:35',1000,'2019-04-09 06:23:35',NULL,NULL),(28,1005,100.00,0.00,'2019-04-09 06:23:35',1000,'2019-04-09 06:23:35',NULL,NULL),(27,1000,10.00,13.00,'2019-06-05 07:27:52',1000,'2019-06-05 07:27:52',NULL,NULL),(27,1001,0.00,8.00,'2019-06-05 07:27:52',1000,'2019-06-05 07:27:52',NULL,NULL),(27,1002,0.00,10.00,'2019-06-05 07:27:52',1000,'2019-06-05 07:27:52',NULL,NULL),(27,1005,0.00,9.00,'2019-06-05 07:27:52',1000,'2019-06-05 07:27:52',NULL,NULL),(27,1000,-20.00,23.00,'2019-06-05 07:27:59',1000,'2019-06-05 07:27:59',NULL,NULL),(27,1001,0.00,8.00,'2019-06-05 07:27:59',1000,'2019-06-05 07:27:59',NULL,NULL),(27,1002,0.00,10.00,'2019-06-05 07:27:59',1000,'2019-06-05 07:27:59',NULL,NULL),(27,1005,0.00,9.00,'2019-06-05 07:27:59',1000,'2019-06-05 07:27:59',NULL,NULL),(29,1000,10.00,0.00,'2019-06-05 07:31:10',1000,'2019-06-05 07:31:10',NULL,NULL),(29,1001,11.00,0.00,'2019-06-05 07:31:10',1000,'2019-06-05 07:31:10',NULL,NULL),(29,1002,12.00,0.00,'2019-06-05 07:31:10',1000,'2019-06-05 07:31:10',NULL,NULL),(29,1005,15.00,0.00,'2019-06-05 07:31:10',1000,'2019-06-05 07:31:10',NULL,NULL),(32,1000,100.00,0.00,'2019-06-06 08:32:29',1000,'2019-06-06 08:32:29',NULL,NULL),(32,1001,100.00,0.00,'2019-06-06 08:32:29',1000,'2019-06-06 08:32:29',NULL,NULL),(32,1002,100.00,0.00,'2019-06-06 08:32:29',1000,'2019-06-06 08:32:29',NULL,NULL),(32,1005,0.00,0.00,'2019-06-06 08:32:29',1000,'2019-06-06 08:32:29',NULL,NULL),(31,1000,100.00,0.00,'2019-06-06 08:33:09',1000,'2019-06-06 08:33:09',NULL,NULL),(31,1001,100.00,0.00,'2019-06-06 08:33:09',1000,'2019-06-06 08:33:09',NULL,NULL),(31,1002,100.00,0.00,'2019-06-06 08:33:09',1000,'2019-06-06 08:33:09',NULL,NULL),(31,1005,0.00,0.00,'2019-06-06 08:33:09',1000,'2019-06-06 08:33:09',NULL,NULL),(30,1000,100.00,0.00,'2019-06-06 08:33:53',1000,'2019-06-06 08:33:53',NULL,NULL),(30,1001,100.00,0.00,'2019-06-06 08:33:53',1000,'2019-06-06 08:33:53',NULL,NULL),(30,1002,100.00,0.00,'2019-06-06 08:33:53',1000,'2019-06-06 08:33:53',NULL,NULL),(30,1005,0.00,0.00,'2019-06-06 08:33:53',1000,'2019-06-06 08:33:53',NULL,NULL),(32,1000,-93.00,93.00,'2019-06-18 07:31:21',1013,'2019-06-18 07:31:21',NULL,NULL),(32,1001,0.00,100.00,'2019-06-18 07:31:21',1013,'2019-06-18 07:31:21',NULL,NULL),(32,1002,0.00,100.00,'2019-06-18 07:31:21',1013,'2019-06-18 07:31:21',NULL,NULL),(32,1005,0.00,0.00,'2019-06-18 07:31:21',1013,'2019-06-18 07:31:21',NULL,NULL),(32,1000,100.00,0.00,'2019-06-18 07:33:39',1013,'2019-06-18 07:33:39',NULL,NULL),(32,1001,0.00,100.00,'2019-06-18 07:33:39',1013,'2019-06-18 07:33:39',NULL,NULL),(32,1002,0.00,100.00,'2019-06-18 07:33:39',1013,'2019-06-18 07:33:39',NULL,NULL),(32,1005,0.00,0.00,'2019-06-18 07:33:39',1013,'2019-06-18 07:33:39',NULL,NULL),(32,1000,10.00,8.00,'2019-06-18 08:49:06',1013,'2019-06-18 08:49:06',NULL,NULL),(32,1001,0.00,100.00,'2019-06-18 08:49:06',1013,'2019-06-18 08:49:06',NULL,NULL),(32,1002,0.00,100.00,'2019-06-18 08:49:06',1013,'2019-06-18 08:49:06',NULL,NULL),(32,1005,0.00,0.00,'2019-06-18 08:49:06',1013,'2019-06-18 08:49:06',NULL,NULL),(17,1005,21.00,0.00,'2019-06-18 08:49:40',1013,'2019-06-18 08:49:40',NULL,NULL),(17,1000,0.00,4.00,'2019-06-18 08:49:40',1013,'2019-06-18 08:49:40',NULL,NULL),(17,1001,0.00,10.00,'2019-06-18 08:49:40',1013,'2019-06-18 08:49:40',NULL,NULL),(17,1002,0.00,10.00,'2019-06-18 08:49:40',1013,'2019-06-18 08:49:40',NULL,NULL),(17,1000,10.00,4.00,'2019-06-18 08:50:31',1013,'2019-06-18 08:50:31',NULL,NULL),(17,1001,0.00,10.00,'2019-06-18 08:50:31',1013,'2019-06-18 08:50:31',NULL,NULL),(17,1002,0.00,10.00,'2019-06-18 08:50:31',1013,'2019-06-18 08:50:31',NULL,NULL),(17,1005,0.00,21.00,'2019-06-18 08:50:31',1013,'2019-06-18 08:50:31',NULL,NULL),(32,1000,0.00,16.00,'2019-06-25 07:05:59',1013,'2019-06-25 07:05:59',NULL,NULL),(32,1001,0.00,100.00,'2019-06-25 07:05:59',1013,'2019-06-25 07:05:59',NULL,NULL),(32,1002,0.00,100.00,'2019-06-25 07:05:59',1013,'2019-06-25 07:05:59',NULL,NULL),(32,1005,-1.00,0.00,'2019-06-25 07:05:59',1013,'2019-06-25 07:05:59',NULL,NULL),(35,1000,-1.00,0.00,'2019-06-25 07:12:43',1013,'2019-06-25 07:12:43',NULL,NULL),(35,1001,0.00,0.00,'2019-06-25 07:12:43',1013,'2019-06-25 07:12:43',NULL,NULL),(35,1002,0.00,0.00,'2019-06-25 07:12:43',1013,'2019-06-25 07:12:43',NULL,NULL),(35,1005,0.00,0.00,'2019-06-25 07:12:43',1013,'2019-06-25 07:12:43',NULL,NULL),(17,1000,1.00,9.00,'2019-06-25 07:16:15',1013,'2019-06-25 07:16:15',NULL,NULL),(17,1001,0.00,10.00,'2019-06-25 07:16:15',1013,'2019-06-25 07:16:15',NULL,NULL),(17,1002,0.00,10.00,'2019-06-25 07:16:15',1013,'2019-06-25 07:16:15',NULL,NULL),(17,1005,0.00,21.00,'2019-06-25 07:16:15',1013,'2019-06-25 07:16:15',NULL,NULL),(17,1000,1.00,10.00,'2019-06-25 07:16:55',1013,'2019-06-25 07:16:55',NULL,NULL),(17,1001,0.00,10.00,'2019-06-25 07:16:55',1013,'2019-06-25 07:16:55',NULL,NULL),(17,1002,0.00,10.00,'2019-06-25 07:16:55',1013,'2019-06-25 07:16:55',NULL,NULL),(17,1005,0.00,21.00,'2019-06-25 07:16:55',1013,'2019-06-25 07:16:55',NULL,NULL),(17,1000,0.00,3.00,'2019-06-25 07:41:38',1013,'2019-06-25 07:41:38',NULL,NULL),(17,1001,5.00,10.00,'2019-06-25 07:41:38',1013,'2019-06-25 07:41:38',NULL,NULL),(17,1002,5.00,10.00,'2019-06-25 07:41:38',1013,'2019-06-25 07:41:38',NULL,NULL),(17,1005,0.00,21.00,'2019-06-25 07:41:38',1013,'2019-06-25 07:41:38',NULL,NULL),(17,1000,0.00,3.00,'2019-06-25 07:47:40',1013,'2019-06-25 07:47:40',NULL,NULL),(17,1001,0.00,15.00,'2019-06-25 07:47:40',1013,'2019-06-25 07:47:40',NULL,NULL),(17,1002,0.00,15.00,'2019-06-25 07:47:40',1013,'2019-06-25 07:47:40',NULL,NULL),(17,1005,-100.00,21.00,'2019-06-25 07:47:40',1013,'2019-06-25 07:47:40',NULL,NULL),(17,1000,0.00,3.00,'2019-06-25 07:47:58',1013,'2019-06-25 07:47:58',NULL,NULL),(17,1001,0.00,15.00,'2019-06-25 07:47:58',1013,'2019-06-25 07:47:58',NULL,NULL),(17,1002,0.00,15.00,'2019-06-25 07:47:58',1013,'2019-06-25 07:47:58',NULL,NULL),(17,1005,100.00,-79.00,'2019-06-25 07:47:58',1013,'2019-06-25 07:47:58',NULL,NULL),(32,1000,5.00,0.00,'2019-06-25 07:56:11',1013,'2019-06-25 07:56:11',NULL,NULL),(32,1001,0.00,100.00,'2019-06-25 07:56:11',1013,'2019-06-25 07:56:11',NULL,NULL),(32,1002,0.00,100.00,'2019-06-25 07:56:11',1013,'2019-06-25 07:56:11',NULL,NULL),(32,1005,0.00,-1.00,'2019-06-25 07:56:11',1013,'2019-06-25 07:56:11',NULL,NULL),(17,1000,20.00,3.00,'2019-06-25 08:11:26',1013,'2019-06-25 08:11:26',NULL,NULL),(17,1001,0.00,15.00,'2019-06-25 08:11:26',1013,'2019-06-25 08:11:26',NULL,NULL),(17,1002,0.00,15.00,'2019-06-25 08:11:26',1013,'2019-06-25 08:11:26',NULL,NULL),(17,1005,0.00,21.00,'2019-06-25 08:11:26',1013,'2019-06-25 08:11:26',NULL,NULL),(36,1000,100.00,0.00,'2019-06-26 01:30:39',1013,'2019-06-26 01:30:39',NULL,NULL),(36,1001,90.00,0.00,'2019-06-26 01:30:39',1013,'2019-06-26 01:30:39',NULL,NULL),(36,1002,80.00,0.00,'2019-06-26 01:30:39',1013,'2019-06-26 01:30:39',NULL,NULL),(36,1005,70.00,0.00,'2019-06-26 01:30:39',1013,'2019-06-26 01:30:39',NULL,NULL),(31,1000,100.00,0.00,'2019-06-26 23:20:51',1013,'2019-06-26 23:20:51',NULL,NULL),(31,1001,0.00,100.00,'2019-06-26 23:20:51',1013,'2019-06-26 23:20:51',NULL,NULL),(31,1002,0.00,100.00,'2019-06-26 23:20:51',1013,'2019-06-26 23:20:51',NULL,NULL),(31,1005,0.00,0.00,'2019-06-26 23:20:51',1013,'2019-06-26 23:20:51',NULL,NULL),(32,1000,100.00,0.00,'2019-06-26 23:21:18',1013,'2019-06-26 23:21:18',NULL,NULL),(32,1001,0.00,100.00,'2019-06-26 23:21:18',1013,'2019-06-26 23:21:18',NULL,NULL),(32,1002,0.00,100.00,'2019-06-26 23:21:18',1013,'2019-06-26 23:21:18',NULL,NULL),(32,1005,0.00,-1.00,'2019-06-26 23:21:18',1013,'2019-06-26 23:21:18',NULL,NULL),(27,1000,137.00,-37.00,'2019-06-26 23:34:40',1013,'2019-06-26 23:34:40',NULL,NULL),(27,1001,92.00,8.00,'2019-06-26 23:34:40',1013,'2019-06-26 23:34:40',NULL,NULL),(27,1002,1090.00,-990.00,'2019-06-26 23:34:40',1013,'2019-06-26 23:34:40',NULL,NULL),(27,1005,0.00,9.00,'2019-06-26 23:34:40',1013,'2019-06-26 23:34:40',NULL,NULL),(17,1000,77.00,23.00,'2019-06-26 23:35:39',1013,'2019-06-26 23:35:39',NULL,NULL),(17,1001,85.00,15.00,'2019-06-26 23:35:39',1013,'2019-06-26 23:35:39',NULL,NULL),(17,1002,85.00,15.00,'2019-06-26 23:35:39',1013,'2019-06-26 23:35:39',NULL,NULL),(17,1005,0.00,21.00,'2019-06-26 23:35:39',1013,'2019-06-26 23:35:39',NULL,NULL),(20,1005,100.00,0.00,'2019-06-26 23:36:31',1013,'2019-06-26 23:36:31',NULL,NULL),(20,1000,92.00,8.00,'2019-06-26 23:36:31',1013,'2019-06-26 23:36:31',NULL,NULL),(20,1001,89.00,11.00,'2019-06-26 23:36:31',1013,'2019-06-26 23:36:31',NULL,NULL),(20,1002,88.00,12.00,'2019-06-26 23:36:31',1013,'2019-06-26 23:36:31',NULL,NULL),(23,1005,100.00,0.00,'2019-06-26 23:36:56',1013,'2019-06-26 23:36:56',NULL,NULL),(23,1000,80.00,20.00,'2019-06-26 23:36:56',1013,'2019-06-26 23:36:56',NULL,NULL),(23,1001,80.00,20.00,'2019-06-26 23:36:56',1013,'2019-06-26 23:36:56',NULL,NULL),(23,1002,80.00,20.00,'2019-06-26 23:36:56',1013,'2019-06-26 23:36:56',NULL,NULL),(29,1000,90.00,10.00,'2019-06-26 23:37:36',1013,'2019-06-26 23:37:36',NULL,NULL),(29,1001,89.00,11.00,'2019-06-26 23:37:36',1013,'2019-06-26 23:37:36',NULL,NULL),(29,1002,88.00,12.00,'2019-06-26 23:37:36',1013,'2019-06-26 23:37:36',NULL,NULL),(29,1005,85.00,15.00,'2019-06-26 23:37:36',1013,'2019-06-26 23:37:36',NULL,NULL),(26,1005,100.00,0.00,'2019-06-26 23:37:59',1013,'2019-06-26 23:37:59',NULL,NULL),(26,1000,82.00,18.00,'2019-06-26 23:37:59',1013,'2019-06-26 23:37:59',NULL,NULL),(26,1001,80.00,20.00,'2019-06-26 23:37:59',1013,'2019-06-26 23:37:59',NULL,NULL),(26,1002,90.00,10.00,'2019-06-26 23:37:59',1013,'2019-06-26 23:37:59',NULL,NULL),(25,1005,100.00,0.00,'2019-06-26 23:41:34',1013,'2019-06-26 23:41:34',NULL,NULL),(25,1000,91.00,9.00,'2019-06-26 23:41:34',1013,'2019-06-26 23:41:34',NULL,NULL),(25,1001,90.00,10.00,'2019-06-26 23:41:34',1013,'2019-06-26 23:41:34',NULL,NULL),(25,1002,90.00,10.00,'2019-06-26 23:41:34',1013,'2019-06-26 23:41:34',NULL,NULL),(22,1005,100.00,0.00,'2019-06-26 23:42:02',1013,'2019-06-26 23:42:02',NULL,NULL),(22,1000,100.00,36.00,'2019-06-26 23:42:02',1013,'2019-06-26 23:42:02',NULL,NULL),(22,1001,100.00,51.00,'2019-06-26 23:42:02',1013,'2019-06-26 23:42:02',NULL,NULL),(22,1002,400.00,-248.00,'2019-06-26 23:42:02',1013,'2019-06-26 23:42:02',NULL,NULL),(35,1000,0.00,-1.00,'2019-06-27 00:04:03',1013,'2019-06-27 00:04:03',NULL,NULL),(35,1001,0.00,0.00,'2019-06-27 00:04:03',1013,'2019-06-27 00:04:03',NULL,NULL),(35,1002,0.00,0.00,'2019-06-27 00:04:03',1013,'2019-06-27 00:04:03',NULL,NULL),(35,1005,0.00,0.00,'2019-06-27 00:04:03',1013,'2019-06-27 00:04:03',NULL,NULL),(35,1000,10.00,-1.00,'2019-06-27 00:16:24',1013,'2019-06-27 00:16:24',NULL,NULL),(35,1001,10.00,0.00,'2019-06-27 00:16:24',1013,'2019-06-27 00:16:24',NULL,NULL),(35,1002,10.00,0.00,'2019-06-27 00:16:24',1013,'2019-06-27 00:16:24',NULL,NULL),(35,1005,10.00,0.00,'2019-06-27 00:16:24',1013,'2019-06-27 00:16:24',NULL,NULL),(27,1000,9.00,100.00,'2019-06-27 01:32:36',1013,'2019-06-27 01:32:36',NULL,NULL),(27,1001,0.00,100.00,'2019-06-27 01:32:36',1013,'2019-06-27 01:32:36',NULL,NULL),(27,1002,0.00,100.00,'2019-06-27 01:32:36',1013,'2019-06-27 01:32:36',NULL,NULL),(27,1005,0.00,9.00,'2019-06-27 01:32:36',1013,'2019-06-27 01:32:36',NULL,NULL),(27,1000,-100.00,109.00,'2019-06-27 01:32:54',1013,'2019-06-27 01:32:54',NULL,NULL),(27,1001,0.00,100.00,'2019-06-27 01:32:54',1013,'2019-06-27 01:32:54',NULL,NULL),(27,1002,0.00,100.00,'2019-06-27 01:32:54',1013,'2019-06-27 01:32:54',NULL,NULL),(27,1005,0.00,9.00,'2019-06-27 01:32:54',1013,'2019-06-27 01:32:54',NULL,NULL),(27,1000,-3.00,9.00,'2019-06-27 01:33:21',1013,'2019-06-27 01:33:21',NULL,NULL),(27,1001,0.00,100.00,'2019-06-27 01:33:21',1013,'2019-06-27 01:33:21',NULL,NULL),(27,1002,0.00,100.00,'2019-06-27 01:33:21',1013,'2019-06-27 01:33:21',NULL,NULL),(27,1005,0.00,9.00,'2019-06-27 01:33:21',1013,'2019-06-27 01:33:21',NULL,NULL),(40,1000,100.00,0.00,'2019-07-02 02:57:53',1013,'2019-07-02 02:57:53',NULL,NULL),(40,1001,100.00,0.00,'2019-07-02 02:57:53',1013,'2019-07-02 02:57:53',NULL,NULL),(40,1002,100.00,0.00,'2019-07-02 02:57:53',1013,'2019-07-02 02:57:53',NULL,NULL),(40,1005,0.00,0.00,'2019-07-02 02:57:53',1013,'2019-07-02 02:57:53',NULL,NULL),(41,1000,100.00,0.00,'2019-07-02 03:01:27',1013,'2019-07-02 03:01:27',NULL,NULL),(41,1001,100.00,0.00,'2019-07-02 03:01:27',1013,'2019-07-02 03:01:27',NULL,NULL),(41,1002,100.00,0.00,'2019-07-02 03:01:27',1013,'2019-07-02 03:01:27',NULL,NULL),(41,1005,100.00,0.00,'2019-07-02 03:01:27',1013,'2019-07-02 03:01:27',NULL,NULL),(27,1000,94.00,6.00,'2019-07-02 03:12:01',1013,'2019-07-02 03:12:01',NULL,NULL),(27,1001,0.00,100.00,'2019-07-02 03:12:01',1013,'2019-07-02 03:12:01',NULL,NULL),(27,1002,0.00,100.00,'2019-07-02 03:12:01',1013,'2019-07-02 03:12:01',NULL,NULL),(27,1005,91.00,9.00,'2019-07-02 03:12:01',1013,'2019-07-02 03:12:01',NULL,NULL),(35,1000,91.00,9.00,'2019-07-02 03:12:31',1013,'2019-07-02 03:12:31',NULL,NULL),(35,1001,90.00,10.00,'2019-07-02 03:12:31',1013,'2019-07-02 03:12:31',NULL,NULL),(35,1002,90.00,10.00,'2019-07-02 03:12:31',1013,'2019-07-02 03:12:31',NULL,NULL),(35,1005,90.00,10.00,'2019-07-02 03:12:31',1013,'2019-07-02 03:12:31',NULL,NULL),(42,1000,100.00,0.00,'2019-07-02 05:49:17',1013,'2019-07-02 05:49:17',NULL,NULL),(42,1001,100.00,0.00,'2019-07-02 05:49:17',1013,'2019-07-02 05:49:17',NULL,NULL),(42,1002,100.00,0.00,'2019-07-02 05:49:17',1013,'2019-07-02 05:49:17',NULL,NULL),(42,1005,100.00,0.00,'2019-07-02 05:49:17',1013,'2019-07-02 05:49:17',NULL,NULL),(32,1000,0.00,98.00,'2019-07-11 00:47:11',1013,'2019-07-11 00:47:11',NULL,NULL),(32,1001,0.00,100.00,'2019-07-11 00:47:11',1013,'2019-07-11 00:47:11',NULL,NULL),(32,1002,0.00,100.00,'2019-07-11 00:47:11',1013,'2019-07-11 00:47:11',NULL,NULL),(32,1005,101.00,-1.00,'2019-07-11 00:47:11',1013,'2019-07-11 00:47:11',NULL,NULL),(40,1000,0.00,100.00,'2019-07-11 00:47:47',1013,'2019-07-11 00:47:47',NULL,NULL),(40,1001,0.00,100.00,'2019-07-11 00:47:47',1013,'2019-07-11 00:47:47',NULL,NULL),(40,1002,0.00,100.00,'2019-07-11 00:47:47',1013,'2019-07-11 00:47:47',NULL,NULL),(40,1005,100.00,0.00,'2019-07-11 00:47:47',1013,'2019-07-11 00:47:47',NULL,NULL),(31,1000,0.00,100.00,'2019-07-11 00:48:01',1013,'2019-07-11 00:48:01',NULL,NULL),(31,1001,0.00,100.00,'2019-07-11 00:48:01',1013,'2019-07-11 00:48:01',NULL,NULL),(31,1002,0.00,100.00,'2019-07-11 00:48:01',1013,'2019-07-11 00:48:01',NULL,NULL),(31,1005,100.00,0.00,'2019-07-11 00:48:01',1013,'2019-07-11 00:48:01',NULL,NULL),(32,1000,-3.00,93.00,'2019-09-25 14:40:54',1013,'2019-09-25 14:40:54',NULL,NULL),(32,1001,0.00,100.00,'2019-09-25 14:40:54',1013,'2019-09-25 14:40:54',NULL,NULL),(32,1002,0.00,100.00,'2019-09-25 14:40:54',1013,'2019-09-25 14:40:54',NULL,NULL),(32,1005,0.00,100.00,'2019-09-25 14:40:54',1013,'2019-09-25 14:40:54',NULL,NULL),(43,1000,20.00,0.00,'2019-09-27 22:29:01',1013,'2019-09-27 22:29:01',NULL,NULL),(43,1001,0.00,0.00,'2019-09-27 22:29:01',1013,'2019-09-27 22:29:01',NULL,NULL),(43,1002,0.00,0.00,'2019-09-27 22:29:01',1013,'2019-09-27 22:29:01',NULL,NULL),(43,1005,0.00,0.00,'2019-09-27 22:29:01',1013,'2019-09-27 22:29:01',NULL,NULL),(44,1000,30.00,0.00,'2019-09-30 11:10:12',1013,'2019-09-30 11:10:12',NULL,NULL),(44,1001,20.00,0.00,'2019-09-30 11:10:12',1013,'2019-09-30 11:10:12',NULL,NULL),(44,1002,0.00,0.00,'2019-09-30 11:10:12',1013,'2019-09-30 11:10:12',NULL,NULL),(44,1005,0.00,0.00,'2019-09-30 11:10:12',1013,'2019-09-30 11:10:12',NULL,NULL),(45,1000,100.00,0.00,'2019-09-30 11:25:02',1013,'2019-09-30 11:25:02',NULL,NULL),(45,1001,0.00,0.00,'2019-09-30 11:25:02',1013,'2019-09-30 11:25:02',NULL,NULL),(45,1002,0.00,0.00,'2019-09-30 11:25:02',1013,'2019-09-30 11:25:02',NULL,NULL),(45,1005,0.00,0.00,'2019-09-30 11:25:02',1013,'2019-09-30 11:25:02',NULL,NULL),(50,1000,100.00,0.00,'2019-10-04 10:59:38',1013,'2019-10-04 10:59:38',NULL,NULL),(50,1001,100.00,0.00,'2019-10-04 10:59:38',1013,'2019-10-04 10:59:38',NULL,NULL),(50,1002,100.00,0.00,'2019-10-04 10:59:38',1013,'2019-10-04 10:59:38',NULL,NULL),(50,1005,100.00,0.00,'2019-10-04 10:59:38',1013,'2019-10-04 10:59:38',NULL,NULL),(50,1000,0.00,100.00,'2019-10-07 12:41:06',1000,'2019-10-07 12:41:06',NULL,'one remarks'),(50,1001,0.00,100.00,'2019-10-07 12:41:06',1000,'2019-10-07 12:41:06',NULL,'two remarks'),(50,1002,0.00,100.00,'2019-10-07 12:41:06',1000,'2019-10-07 12:41:06',NULL,NULL),(50,1005,0.00,100.00,'2019-10-07 12:41:06',1000,'2019-10-07 12:41:06',NULL,NULL),(50,1000,-10.00,100.00,'2019-10-07 12:48:42',1000,'2019-10-07 12:48:42',NULL,'test'),(50,1001,0.00,100.00,'2019-10-07 12:48:42',1000,'2019-10-07 12:48:42',NULL,NULL),(50,1002,0.00,100.00,'2019-10-07 12:48:42',1000,'2019-10-07 12:48:42',NULL,NULL),(50,1005,0.00,100.00,'2019-10-07 12:48:42',1000,'2019-10-07 12:48:42',NULL,NULL),(40,1000,-3.00,97.00,'2019-10-08 00:20:34',1013,'2019-10-08 00:20:34',NULL,'sample'),(40,1001,0.00,100.00,'2019-10-08 00:20:34',1013,'2019-10-08 00:20:34',NULL,NULL),(40,1002,0.00,100.00,'2019-10-08 00:20:34',1013,'2019-10-08 00:20:34',NULL,NULL),(40,1005,0.00,100.00,'2019-10-08 00:20:34',1013,'2019-10-08 00:20:34',NULL,NULL),(40,1000,-4.00,94.00,'2019-10-08 00:25:08',1013,'2019-10-08 00:25:08',NULL,'sample 1'),(40,1001,0.00,100.00,'2019-10-08 00:25:08',1013,'2019-10-08 00:25:08',NULL,NULL),(40,1002,0.00,100.00,'2019-10-08 00:25:08',1013,'2019-10-08 00:25:08',NULL,NULL),(40,1005,0.00,100.00,'2019-10-08 00:25:08',1013,'2019-10-08 00:25:08',NULL,NULL),(52,1000,100.00,0.00,'2019-10-08 00:35:00',1013,'2019-10-08 00:35:00',NULL,NULL),(52,1001,0.00,0.00,'2019-10-08 00:35:00',1013,'2019-10-08 00:35:00',NULL,NULL),(52,1002,0.00,0.00,'2019-10-08 00:35:00',1013,'2019-10-08 00:35:00',NULL,NULL),(52,1005,0.00,0.00,'2019-10-08 00:35:00',1013,'2019-10-08 00:35:00',NULL,NULL);
/*!40000 ALTER TABLE `productsqty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productsstore`
--

DROP TABLE IF EXISTS `productsstore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productsstore` (
  `fk_products` int(11) DEFAULT NULL,
  `fk_stores` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  UNIQUE KEY `fk_products` (`fk_products`,`fk_stores`),
  KEY `fk_stores` (`fk_stores`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `productsstore_ibfk_1` FOREIGN KEY (`fk_products`) REFERENCES `products` (`pk_products`),
  CONSTRAINT `productsstore_ibfk_2` FOREIGN KEY (`fk_stores`) REFERENCES `stores` (`pk_stores`),
  CONSTRAINT `productsstore_ibfk_3` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `productsstore_ibfk_4` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productsstore`
--

LOCK TABLES `productsstore` WRITE;
/*!40000 ALTER TABLE `productsstore` DISABLE KEYS */;
INSERT INTO `productsstore` VALUES (18,1000,'2017-12-06 15:14:57',1000,'2017-12-06 15:14:57',NULL),(18,1001,'2017-12-06 15:14:57',1000,'2017-12-06 15:14:57',NULL),(18,1002,'2017-12-06 15:14:57',1000,'2017-12-06 15:14:57',NULL),(21,1000,'2017-12-09 15:28:04',1000,'2017-12-09 15:28:04',NULL),(21,1001,'2017-12-09 15:28:04',1000,'2017-12-09 15:28:04',NULL),(21,1002,'2017-12-09 15:28:04',1000,'2017-12-09 15:28:04',NULL),(22,1000,'2017-12-09 15:39:39',1000,'2017-12-09 15:39:39',NULL),(22,1001,'2017-12-09 15:39:40',1000,'2017-12-09 15:39:40',NULL),(22,1002,'2017-12-09 15:39:40',1000,'2017-12-09 15:39:40',NULL),(23,1000,'2017-12-09 15:40:14',1000,'2017-12-09 15:40:14',NULL),(23,1001,'2017-12-09 15:40:14',1000,'2017-12-09 15:40:14',NULL),(23,1002,'2017-12-09 15:40:14',1000,'2017-12-09 15:40:14',NULL),(24,1000,'2017-12-09 15:40:47',1000,'2017-12-09 15:40:47',NULL),(24,1001,'2017-12-09 15:40:47',1000,'2017-12-09 15:40:47',NULL),(24,1002,'2017-12-09 15:40:47',1000,'2017-12-09 15:40:47',NULL),(28,1000,'2019-04-09 06:23:08',1000,'2019-04-09 06:23:08',NULL),(28,1001,'2019-04-09 06:23:08',1000,'2019-04-09 06:23:08',NULL),(28,1002,'2019-04-09 06:23:08',1000,'2019-04-09 06:23:08',NULL),(28,1005,'2019-04-09 06:23:08',1000,'2019-04-09 06:23:08',NULL),(29,1000,'2019-06-05 06:51:58',1000,'2019-06-05 06:51:58',NULL),(29,1001,'2019-06-05 06:51:58',1000,'2019-06-05 06:51:58',NULL),(29,1002,'2019-06-05 06:51:58',1000,'2019-06-05 06:51:58',NULL),(29,1005,'2019-06-05 06:51:58',1000,'2019-06-05 06:51:58',NULL),(27,1000,'2019-06-05 07:35:06',NULL,'2019-06-05 07:35:06',NULL),(27,1002,'2019-06-05 07:35:06',NULL,'2019-06-05 07:35:06',NULL),(27,1001,'2019-06-05 07:35:06',NULL,'2019-06-05 07:35:06',NULL),(27,1005,'2019-06-05 07:35:06',NULL,'2019-06-05 07:35:06',NULL),(17,1000,'2019-06-05 07:37:45',NULL,'2019-06-05 07:37:45',NULL),(17,1002,'2019-06-05 07:37:45',NULL,'2019-06-05 07:37:45',NULL),(17,1001,'2019-06-05 07:37:45',NULL,'2019-06-05 07:37:45',NULL),(30,1000,'2019-06-06 08:28:03',1000,'2019-06-06 08:28:03',NULL),(30,1001,'2019-06-06 08:28:03',1000,'2019-06-06 08:28:03',NULL),(30,1002,'2019-06-06 08:28:03',1000,'2019-06-06 08:28:03',NULL),(30,1005,'2019-06-06 08:28:03',1000,'2019-06-06 08:28:03',NULL),(31,1000,'2019-06-07 06:14:04',NULL,'2019-06-07 06:14:04',NULL),(31,1002,'2019-06-07 06:14:04',NULL,'2019-06-07 06:14:04',NULL),(31,1001,'2019-06-07 06:14:04',NULL,'2019-06-07 06:14:04',NULL),(31,1005,'2019-06-07 06:14:04',NULL,'2019-06-07 06:14:04',NULL),(26,1000,'2019-06-07 06:14:14',NULL,'2019-06-07 06:14:14',NULL),(26,1002,'2019-06-07 06:14:14',NULL,'2019-06-07 06:14:14',NULL),(26,1001,'2019-06-07 06:14:14',NULL,'2019-06-07 06:14:14',NULL),(33,1000,'2019-06-18 07:44:01',1013,'2019-06-18 07:44:01',NULL),(33,1001,'2019-06-18 07:44:01',1013,'2019-06-18 07:44:01',NULL),(33,1002,'2019-06-18 07:44:01',1013,'2019-06-18 07:44:01',NULL),(33,1005,'2019-06-18 07:44:01',1013,'2019-06-18 07:44:01',NULL),(34,1000,'2019-06-25 06:30:59',1013,'2019-06-25 06:30:59',NULL),(34,1001,'2019-06-25 06:30:59',1013,'2019-06-25 06:30:59',NULL),(34,1002,'2019-06-25 06:30:59',1013,'2019-06-25 06:30:59',NULL),(34,1005,'2019-06-25 06:30:59',1013,'2019-06-25 06:30:59',NULL),(35,1000,'2019-06-25 07:10:47',1013,'2019-06-25 07:10:47',NULL),(35,1001,'2019-06-25 07:10:47',1013,'2019-06-25 07:10:47',NULL),(35,1002,'2019-06-25 07:10:47',1013,'2019-06-25 07:10:47',NULL),(35,1005,'2019-06-25 07:10:47',1013,'2019-06-25 07:10:47',NULL),(20,1002,'2019-06-25 09:15:24',NULL,'2019-06-25 09:15:24',NULL),(20,1001,'2019-06-25 09:15:24',NULL,'2019-06-25 09:15:24',NULL),(32,1000,'2019-06-25 09:23:08',NULL,'2019-06-25 09:23:08',NULL),(32,1002,'2019-06-25 09:23:08',NULL,'2019-06-25 09:23:08',NULL),(32,1001,'2019-06-25 09:23:08',NULL,'2019-06-25 09:23:08',NULL),(32,1005,'2019-06-25 09:23:08',NULL,'2019-06-25 09:23:08',NULL),(36,1000,'2019-06-26 00:21:14',1013,'2019-06-26 00:21:14',NULL),(36,1001,'2019-06-26 00:21:14',1013,'2019-06-26 00:21:14',NULL),(36,1002,'2019-06-26 00:21:14',1013,'2019-06-26 00:21:14',NULL),(36,1005,'2019-06-26 00:21:14',1013,'2019-06-26 00:21:14',NULL),(37,1000,'2019-06-26 04:29:46',1013,'2019-06-26 04:29:46',NULL),(37,1001,'2019-06-26 04:29:46',1013,'2019-06-26 04:29:46',NULL),(37,1002,'2019-06-26 04:29:46',1013,'2019-06-26 04:29:46',NULL),(37,1005,'2019-06-26 04:29:46',1013,'2019-06-26 04:29:46',NULL),(38,1000,'2019-06-26 23:28:16',1013,'2019-06-26 23:28:16',NULL),(38,1001,'2019-06-26 23:28:16',1013,'2019-06-26 23:28:16',NULL),(38,1002,'2019-06-26 23:28:16',1013,'2019-06-26 23:28:16',NULL),(38,1005,'2019-06-26 23:28:16',1013,'2019-06-26 23:28:16',NULL),(41,1000,'2019-07-02 03:00:52',NULL,'2019-07-02 03:00:52',NULL),(41,1002,'2019-07-02 03:00:52',NULL,'2019-07-02 03:00:52',NULL),(41,1001,'2019-07-02 03:00:52',NULL,'2019-07-02 03:00:52',NULL),(41,1005,'2019-07-02 03:00:52',NULL,'2019-07-02 03:00:52',NULL),(25,1000,'2019-07-02 03:03:54',NULL,'2019-07-02 03:03:54',NULL),(25,1002,'2019-07-02 03:03:54',NULL,'2019-07-02 03:03:54',NULL),(25,1001,'2019-07-02 03:03:54',NULL,'2019-07-02 03:03:54',NULL),(42,1000,'2019-07-02 05:47:16',1013,'2019-07-02 05:47:16',NULL),(42,1001,'2019-07-02 05:47:16',1013,'2019-07-02 05:47:16',NULL),(42,1002,'2019-07-02 05:47:16',1013,'2019-07-02 05:47:16',NULL),(42,1005,'2019-07-02 05:47:16',1013,'2019-07-02 05:47:16',NULL),(43,1000,'2019-09-27 22:28:34',NULL,'2019-09-27 22:28:34',NULL),(43,1002,'2019-09-27 22:28:34',NULL,'2019-09-27 22:28:34',NULL),(43,1001,'2019-09-27 22:28:34',NULL,'2019-09-27 22:28:34',NULL),(43,1005,'2019-09-27 22:28:34',NULL,'2019-09-27 22:28:34',NULL),(44,1000,'2019-09-30 11:07:18',1013,'2019-09-30 11:07:18',NULL),(44,1001,'2019-09-30 11:07:18',1013,'2019-09-30 11:07:18',NULL),(44,1002,'2019-09-30 11:07:18',1013,'2019-09-30 11:07:18',NULL),(44,1005,'2019-09-30 11:07:18',1013,'2019-09-30 11:07:18',NULL),(45,1000,'2019-09-30 11:20:30',1013,'2019-09-30 11:20:30',NULL),(45,1001,'2019-09-30 11:20:30',1013,'2019-09-30 11:20:30',NULL),(45,1002,'2019-09-30 11:20:30',1013,'2019-09-30 11:20:30',NULL),(45,1005,'2019-09-30 11:20:30',1013,'2019-09-30 11:20:30',NULL),(46,1000,'2019-09-30 11:22:22',1013,'2019-09-30 11:22:22',NULL),(46,1001,'2019-09-30 11:22:22',1013,'2019-09-30 11:22:22',NULL),(46,1002,'2019-09-30 11:22:22',1013,'2019-09-30 11:22:22',NULL),(46,1005,'2019-09-30 11:22:22',1013,'2019-09-30 11:22:22',NULL),(47,1000,'2019-09-30 11:36:28',1013,'2019-09-30 11:36:28',NULL),(47,1001,'2019-09-30 11:36:28',1013,'2019-09-30 11:36:28',NULL),(47,1002,'2019-09-30 11:36:28',1013,'2019-09-30 11:36:28',NULL),(47,1005,'2019-09-30 11:36:28',1013,'2019-09-30 11:36:28',NULL),(40,1000,'2019-09-30 11:51:40',NULL,'2019-09-30 11:51:40',NULL),(40,1002,'2019-09-30 11:51:40',NULL,'2019-09-30 11:51:40',NULL),(40,1001,'2019-09-30 11:51:40',NULL,'2019-09-30 11:51:40',NULL),(40,1005,'2019-09-30 11:51:40',NULL,'2019-09-30 11:51:40',NULL),(48,1000,'2019-09-30 11:55:09',1013,'2019-09-30 11:55:09',NULL),(48,1001,'2019-09-30 11:55:09',1013,'2019-09-30 11:55:09',NULL),(48,1002,'2019-09-30 11:55:09',1013,'2019-09-30 11:55:09',NULL),(48,1005,'2019-09-30 11:55:09',1013,'2019-09-30 11:55:09',NULL),(49,1000,'2019-10-01 13:24:21',1013,'2019-10-01 13:24:21',NULL),(49,1001,'2019-10-01 13:24:21',1013,'2019-10-01 13:24:21',NULL),(49,1002,'2019-10-01 13:24:21',1013,'2019-10-01 13:24:21',NULL),(49,1005,'2019-10-01 13:24:21',1013,'2019-10-01 13:24:21',NULL),(50,1000,'2019-10-04 10:58:00',NULL,'2019-10-04 10:58:00',NULL),(50,1002,'2019-10-04 10:58:00',NULL,'2019-10-04 10:58:00',NULL),(50,1001,'2019-10-04 10:58:00',NULL,'2019-10-04 10:58:00',NULL),(50,1005,'2019-10-04 10:58:00',NULL,'2019-10-04 10:58:00',NULL),(51,1000,'2019-10-05 16:51:49',1013,'2019-10-05 16:51:49',NULL),(51,1001,'2019-10-05 16:51:49',1013,'2019-10-05 16:51:49',NULL),(51,1002,'2019-10-05 16:51:49',1013,'2019-10-05 16:51:49',NULL),(51,1005,'2019-10-05 16:51:49',1013,'2019-10-05 16:51:49',NULL),(52,1000,'2019-10-08 00:32:39',1013,'2019-10-08 00:32:39',NULL),(52,1001,'2019-10-08 00:32:39',1013,'2019-10-08 00:32:39',NULL),(52,1002,'2019-10-08 00:32:39',1013,'2019-10-08 00:32:39',NULL),(52,1005,'2019-10-08 00:32:39',1013,'2019-10-08 00:32:39',NULL);
/*!40000 ALTER TABLE `productsstore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salescompositions`
--

DROP TABLE IF EXISTS `salescompositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salescompositions` (
  `fk_salesmstr` int(11) DEFAULT NULL,
  `fk_products` int(11) DEFAULT NULL,
  `fk_compositions` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `uom` char(15) DEFAULT NULL,
  `unitcost` double(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fk_salesmstr` (`fk_salesmstr`),
  KEY `fk_products` (`fk_products`),
  KEY `fk_compositions` (`fk_compositions`),
  CONSTRAINT `salescompositions_ibfk_1` FOREIGN KEY (`fk_salesmstr`) REFERENCES `salesmstr` (`pk_salesmstr`),
  CONSTRAINT `salescompositions_ibfk_2` FOREIGN KEY (`fk_products`) REFERENCES `products` (`pk_products`),
  CONSTRAINT `salescompositions_ibfk_3` FOREIGN KEY (`fk_compositions`) REFERENCES `products` (`pk_products`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salescompositions`
--

LOCK TABLES `salescompositions` WRITE;
/*!40000 ALTER TABLE `salescompositions` DISABLE KEYS */;
INSERT INTO `salescompositions` VALUES (1,18,27,10,'pcs',12.00,'2019-06-06 00:26:33','2019-06-06 00:26:33'),(1,18,22,3,'pcs',50.00,'2019-06-06 00:26:33','2019-06-06 00:26:33'),(2,17,20,1,'pcs',10.00,'2019-06-06 01:03:43','2019-06-06 01:03:43'),(2,17,28,1,NULL,0.00,'2019-06-06 01:03:43','2019-06-06 01:03:43'),(4,18,27,1000,'pcs',12.00,'2019-06-06 15:54:29','2019-06-06 15:54:29'),(4,18,22,300,'pcs',50.00,'2019-06-06 15:54:29','2019-06-06 15:54:29'),(8,30,32,1,'pcs',0.00,'2019-06-06 22:07:23','2019-06-06 22:07:23'),(8,30,31,1,NULL,0.00,'2019-06-06 22:07:23','2019-06-06 22:07:23'),(9,30,32,1,'pcs',0.00,'2019-06-09 06:19:42','2019-06-09 06:19:42'),(9,30,31,1,NULL,0.00,'2019-06-09 06:19:42','2019-06-09 06:19:42'),(10,18,27,10,'pcs',12.00,'2019-06-09 06:24:09','2019-06-09 06:24:09'),(10,18,22,3,'pcs',50.00,'2019-06-09 06:24:09','2019-06-09 06:24:09'),(15,18,27,10,'pcs',12.00,'2019-06-13 23:50:17','2019-06-13 23:50:17'),(15,18,22,3,'pcs',50.00,'2019-06-13 23:50:17','2019-06-13 23:50:17'),(17,30,32,1,'pcs',0.00,'2019-06-17 21:31:01','2019-06-17 21:31:01'),(17,30,31,1,NULL,0.00,'2019-06-17 21:31:01','2019-06-17 21:31:01'),(17,18,27,10,'pcs',12.00,'2019-06-17 21:31:07','2019-06-17 21:31:07'),(17,18,22,3,'pcs',50.00,'2019-06-17 21:31:07','2019-06-17 21:31:07'),(21,30,32,1,'pcs',0.00,'2019-06-17 22:50:53','2019-06-17 22:50:53'),(21,30,31,1,NULL,0.00,'2019-06-17 22:50:53','2019-06-17 22:50:53'),(22,30,32,1,'pcs',0.00,'2019-06-17 23:33:43','2019-06-17 23:33:43'),(22,30,31,1,NULL,0.00,'2019-06-17 23:33:43','2019-06-17 23:33:43'),(23,21,32,90,'pcs',0.00,'2019-06-17 23:38:38','2019-06-17 23:38:38'),(23,21,31,90,NULL,0.00,'2019-06-17 23:38:38','2019-06-17 23:38:38'),(23,17,20,1,'pcs',10.00,'2019-06-17 23:41:11','2019-06-17 23:41:11'),(23,17,28,1,NULL,0.00,'2019-06-17 23:41:11','2019-06-17 23:41:11'),(23,30,32,1,'pcs',0.00,'2019-06-17 23:41:27','2019-06-17 23:41:27'),(23,30,31,1,NULL,0.00,'2019-06-17 23:41:27','2019-06-17 23:41:27'),(27,33,30,5,'pcs',0.00,'2019-06-18 00:52:59','2019-06-18 00:52:59'),(27,33,17,5,'pcs',0.00,'2019-06-18 00:52:59','2019-06-18 00:52:59'),(38,30,32,1,'pcs',0.00,'2019-06-26 14:47:45','2019-06-26 14:47:45'),(38,30,31,1,NULL,0.00,'2019-06-26 14:47:45','2019-06-26 14:47:45'),(41,33,30,5,'pcs',0.00,'2019-06-26 15:18:13','2019-06-26 15:18:13'),(41,33,17,5,'pcs',0.00,'2019-06-26 15:18:13','2019-06-26 15:18:13'),(52,18,27,10,'pcs',12.00,'2019-07-15 16:38:22','2019-07-15 16:38:22'),(52,18,22,3,'pcs',50.00,'2019-07-15 16:38:22','2019-07-15 16:38:22'),(61,18,27,10,'pcs',12.00,'2019-09-25 03:26:24','2019-09-25 03:26:24'),(61,18,22,3,'pcs',50.00,'2019-09-25 03:26:24','2019-09-25 03:26:24'),(79,38,32,1,'pcs',0.00,'2019-09-30 03:31:50','2019-09-30 03:31:50'),(79,38,31,1,NULL,0.00,'2019-09-30 03:31:50','2019-09-30 03:31:50'),(89,38,32,1,'pcs',0.00,'2019-09-30 15:35:35','2019-09-30 15:35:35'),(89,38,31,1,NULL,0.00,'2019-09-30 15:35:35','2019-09-30 15:35:35'),(89,30,32,1,'pcs',0.00,'2019-09-30 15:35:44','2019-09-30 15:35:44'),(89,30,31,1,NULL,0.00,'2019-09-30 15:35:44','2019-09-30 15:35:44'),(89,46,32,1,'pcs',0.00,'2019-09-30 15:35:47','2019-09-30 15:35:47'),(89,46,31,1,NULL,0.00,'2019-09-30 15:35:47','2019-09-30 15:35:47'),(89,46,45,1,'pc',30.00,'2019-09-30 15:35:47','2019-09-30 15:35:47'),(89,47,32,1,'pcs',0.00,'2019-09-30 15:35:58','2019-09-30 15:35:58'),(89,47,31,1,NULL,0.00,'2019-09-30 15:35:58','2019-09-30 15:35:58'),(89,47,45,1,'pc',30.00,'2019-09-30 15:35:58','2019-09-30 15:35:58'),(91,46,32,1,'pcs',0.00,'2019-10-02 01:52:23','2019-10-02 01:52:23'),(91,46,31,1,NULL,0.00,'2019-10-02 01:52:23','2019-10-02 01:52:23'),(91,46,45,1,'pc',30.00,'2019-10-02 01:52:23','2019-10-02 01:52:23');
/*!40000 ALTER TABLE `salescompositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesdtls`
--

DROP TABLE IF EXISTS `salesdtls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesdtls` (
  `fk_salesmstr` int(11) DEFAULT NULL,
  `fk_products` int(11) DEFAULT NULL,
  `qty` double(10,2) DEFAULT NULL,
  `uom` char(15) DEFAULT NULL,
  `unitprice` double(10,2) DEFAULT '0.00' COMMENT 'optional individual product discount',
  `unitcost` double(10,2) DEFAULT '0.00',
  `totalamount` double(10,2) DEFAULT '0.00' COMMENT 'partial',
  `discrate` double(10,2) DEFAULT '0.00' COMMENT 'base on salesmstr discount',
  `discamount` double(10,2) DEFAULT '0.00' COMMENT 'base on salesmstr discount',
  `netamount` double(10,2) DEFAULT '0.00' COMMENT 'final amount',
  `vatable` double(10,4) DEFAULT '0.0000' COMMENT 'amount without vat base on netamount',
  `vatamount` double(10,4) DEFAULT '0.0000' COMMENT 'additional vat base on netamount',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  UNIQUE KEY `fk_salesmstr` (`fk_salesmstr`,`fk_products`),
  KEY `fk_products` (`fk_products`),
  CONSTRAINT `salesdtls_ibfk_1` FOREIGN KEY (`fk_salesmstr`) REFERENCES `salesmstr` (`pk_salesmstr`),
  CONSTRAINT `salesdtls_ibfk_2` FOREIGN KEY (`fk_products`) REFERENCES `products` (`pk_products`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesdtls`
--

LOCK TABLES `salesdtls` WRITE;
/*!40000 ALTER TABLE `salesdtls` DISABLE KEYS */;
INSERT INTO `salesdtls` VALUES (1,18,1.00,NULL,1000.00,0.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-06-06 08:26:33','2019-06-06 08:26:33'),(2,17,1.00,'pcs',5.00,0.00,5.00,0.00,0.00,5.00,4.0000,0.0000,'2019-06-06 09:03:43','2019-06-06 09:03:43'),(4,18,100.00,NULL,1000.00,0.00,100000.00,0.00,0.00,100000.00,89285.0000,10714.0000,'2019-06-06 23:54:29','2019-06-06 23:54:29'),(5,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-06 23:57:53','2019-06-06 23:57:53'),(7,26,1.00,'pcs',122.00,0.00,122.00,0.00,0.00,122.00,109.0000,13.0000,'2019-06-07 01:13:18','2019-06-07 01:13:18'),(8,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-07 06:07:23','2019-06-07 06:07:23'),(9,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-09 14:19:42','2019-06-09 14:19:42'),(10,18,1.00,NULL,1000.00,0.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-06-09 14:24:09','2019-06-09 14:24:09'),(11,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-12 04:28:34','2019-06-12 04:28:34'),(12,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-12 04:31:22','2019-06-12 04:31:22'),(13,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-12 04:35:06','2019-06-12 04:35:06'),(14,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-14 06:43:36','2019-06-14 06:43:36'),(14,24,1.00,'btl',30.00,20.00,30.00,0.00,0.00,30.00,26.0000,3.0000,'2019-06-14 06:43:40','2019-06-14 06:43:40'),(15,18,1.00,NULL,1000.00,0.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-06-14 07:50:17','2019-06-14 07:50:17'),(17,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-17 14:28:50','2019-06-17 14:28:50'),(17,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-18 05:31:01','2019-06-18 05:31:01'),(17,18,1.00,NULL,1000.00,0.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-06-18 05:31:07','2019-06-18 05:31:07'),(18,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-18 06:40:32','2019-06-18 06:40:32'),(18,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-18 06:40:33','2019-06-18 06:40:33'),(19,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-18 06:48:17','2019-06-18 06:48:17'),(19,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-18 06:48:19','2019-06-18 06:48:19'),(20,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-18 06:50:35','2019-06-18 06:50:35'),(21,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-06-18 06:50:51','2019-06-18 06:50:51'),(21,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-18 06:50:53','2019-06-18 06:50:53'),(22,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-18 07:33:43','2019-06-18 07:33:43'),(23,21,9.00,NULL,20.00,0.00,180.00,0.00,0.00,180.00,160.0000,19.0000,'2019-06-18 07:38:38','2019-06-18 07:38:38'),(23,17,1.00,'pcs',5.00,0.00,5.00,0.00,0.00,5.00,4.0000,0.0000,'2019-06-18 07:41:11','2019-06-18 07:41:11'),(23,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-18 07:41:27','2019-06-18 07:41:27'),(23,24,1.00,'btl',30.00,20.00,30.00,0.00,0.00,30.00,26.0000,3.0000,'2019-06-18 07:41:35','2019-06-18 07:41:35'),(27,22,1.00,'pcs',16.00,50.00,16.00,0.00,0.00,16.00,14.0000,1.0000,'2019-06-18 07:55:05','2019-06-18 07:55:05'),(27,33,1.00,NULL,112.00,50.00,112.00,0.00,0.00,112.00,99.0000,12.0000,'2019-06-18 08:52:59','2019-06-18 08:52:59'),(28,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-18 10:07:18','2019-06-18 10:07:18'),(29,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-19 14:09:43','2019-06-19 14:09:43'),(30,28,1.00,NULL,500.00,0.00,500.00,0.00,0.00,500.00,446.0000,53.0000,'2019-06-23 19:11:35','2019-06-23 19:11:35'),(30,25,1.00,'pcs',6.00,0.00,6.00,0.00,0.00,6.00,5.0000,0.0000,'2019-06-23 19:11:40','2019-06-23 19:11:40'),(30,26,1.00,'pcs',122.00,0.00,122.00,0.00,0.00,122.00,109.0000,13.0000,'2019-06-23 19:11:46','2019-06-23 19:11:46'),(32,32,16.00,'pcs',100.00,0.00,1600.00,0.00,0.00,1600.00,1428.0000,171.0000,'2019-06-25 07:55:43','2019-06-25 07:55:43'),(33,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-26 02:56:30','2019-06-26 02:56:30'),(34,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-26 02:59:20','2019-06-26 02:59:20'),(35,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-26 03:08:07','2019-06-26 03:08:07'),(36,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-26 03:09:30','2019-06-26 03:09:30'),(37,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-26 03:10:13','2019-06-26 03:10:13'),(38,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-06-26 22:47:45','2019-06-26 22:47:45'),(38,28,1.00,NULL,500.00,0.00,500.00,0.00,0.00,500.00,446.0000,53.0000,'2019-06-26 22:48:24','2019-06-26 22:48:24'),(38,22,1.00,'pcs',16.00,50.00,16.00,0.00,0.00,16.00,14.0000,1.0000,'2019-06-26 23:11:37','2019-06-26 23:11:37'),(41,33,1.00,NULL,112.00,50.00,112.00,0.00,0.00,112.00,99.0000,12.0000,'2019-06-26 23:18:13','2019-06-26 23:18:13'),(44,23,1.00,'pcs',29.00,60.00,29.00,0.00,0.00,29.00,25.0000,3.0000,'2019-06-26 23:50:15','2019-06-26 23:50:15'),(44,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-26 23:50:30','2019-06-26 23:50:30'),(45,23,1.00,'pcs',29.00,60.00,29.00,0.00,0.00,29.00,25.0000,3.0000,'2019-06-26 23:52:06','2019-06-26 23:52:06'),(45,32,2.00,'pcs',100.00,0.00,200.00,0.00,0.00,200.00,178.0000,21.0000,'2019-06-26 23:52:28','2019-06-26 23:52:28'),(47,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-06-29 19:44:28','2019-06-29 19:44:28'),(48,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-07-01 23:17:08','2019-07-01 23:17:08'),(49,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-07-02 08:17:21','2019-07-02 08:17:21'),(50,32,1.00,'pcs',100.00,0.00,100.00,20.00,20.00,80.00,71.0000,8.0000,'2019-07-10 23:09:03','2019-07-10 23:18:11'),(51,32,2.00,'pcs',50.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-07-10 23:28:16','2019-07-10 23:28:16'),(52,18,1.00,NULL,1000.00,0.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-07-16 00:38:22','2019-07-16 00:38:22'),(53,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-08-08 10:45:18','2019-08-08 10:45:18'),(55,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-08-12 13:19:44','2019-08-12 13:19:44'),(56,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-08-31 09:40:09','2019-08-31 09:40:09'),(59,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-09 10:19:24','2019-09-09 10:19:24'),(60,41,1.00,NULL,150.00,80.00,150.00,0.00,0.00,150.00,133.0000,16.0000,'2019-09-14 11:40:08','2019-09-14 11:40:08'),(61,18,1.00,NULL,1000.00,0.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-09-25 11:26:24','2019-09-25 11:26:24'),(62,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-25 14:38:28','2019-09-25 14:38:28'),(64,43,1.00,'50ml',100.00,50.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-27 22:32:43','2019-09-27 22:32:43'),(65,43,1.00,'50ml',100.00,50.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-27 22:36:07','2019-09-27 22:36:07'),(66,43,1.00,'50ml',100.00,50.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-27 22:36:14','2019-09-27 22:36:14'),(67,43,1.00,'50ml',100.00,50.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-27 22:40:50','2019-09-27 22:40:50'),(68,43,2.00,'50ml',100.00,50.00,200.00,0.00,0.00,200.00,178.0000,21.0000,'2019-09-27 22:46:11','2019-09-27 22:46:11'),(69,43,2.00,'50ml',112.00,50.00,224.00,0.00,0.00,224.00,199.0000,24.0000,'2019-09-27 22:49:12','2019-09-27 22:49:12'),(70,43,1.00,'50ml',112.00,50.00,112.00,0.00,0.00,112.00,99.0000,12.0000,'2019-09-27 22:49:40','2019-09-27 22:49:40'),(71,43,1.00,'50ml',100.00,50.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-27 23:01:33','2019-09-27 23:01:33'),(72,44,1.00,'pc',100.00,50.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-30 11:10:44','2019-09-30 11:10:44'),(73,40,1.00,NULL,100.00,30.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-30 11:14:26','2019-09-30 11:14:26'),(74,40,1.00,NULL,100.00,30.00,100.00,20.00,20.00,80.00,71.0000,8.0000,'2019-09-30 11:16:16','2019-09-30 11:16:16'),(78,40,1.00,NULL,100.00,30.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-30 11:26:57','2019-09-30 11:26:57'),(79,38,1.00,NULL,20.00,10.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-09-30 11:31:50','2019-09-30 11:31:50'),(81,40,1.00,NULL,90.00,30.00,90.00,0.00,0.00,90.00,80.0000,9.0000,'2019-09-30 11:46:02','2019-09-30 11:46:02'),(84,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-30 12:05:59','2019-09-30 12:05:59'),(86,40,1.00,NULL,0.00,30.00,0.00,0.00,0.00,0.00,0.0000,0.0000,'2019-09-30 12:06:39','2019-09-30 12:06:39'),(89,38,1.00,NULL,20.00,10.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-09-30 23:35:35','2019-09-30 23:35:35'),(89,30,1.00,'pcs',130.00,0.00,130.00,0.00,0.00,130.00,116.0000,13.0000,'2019-09-30 23:35:44','2019-09-30 23:35:44'),(89,46,1.00,NULL,150.00,100.00,150.00,0.00,0.00,150.00,133.0000,16.0000,'2019-09-30 23:35:47','2019-09-30 23:35:47'),(89,47,1.00,NULL,150.00,100.00,150.00,0.00,0.00,150.00,133.0000,16.0000,'2019-09-30 23:35:58','2019-09-30 23:35:58'),(90,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-09-30 23:54:24','2019-09-30 23:54:24'),(91,46,1.00,NULL,150.00,100.00,150.00,0.00,0.00,150.00,133.0000,16.0000,'2019-10-02 09:52:23','2019-10-02 09:52:23'),(93,32,1.00,'pcs',100.00,0.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-10-03 11:12:05','2019-10-03 11:12:05'),(93,40,1.00,NULL,0.00,30.00,0.00,0.00,0.00,0.00,0.0000,0.0000,'2019-10-03 11:12:07','2019-10-03 11:12:07'),(93,31,1.00,NULL,20.00,0.00,20.00,0.00,0.00,20.00,17.0000,2.0000,'2019-10-03 11:12:17','2019-10-03 11:12:17'),(94,50,1.00,NULL,850.00,850.00,850.00,0.00,0.00,850.00,758.0000,91.0000,'2019-10-04 11:01:17','2019-10-04 11:01:17'),(95,40,1.00,NULL,0.00,30.00,0.00,0.00,0.00,0.00,0.0000,0.0000,'2019-10-07 15:04:21','2019-10-07 15:04:21'),(96,40,1.00,NULL,100.00,30.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-10-07 15:05:52','2019-10-07 15:05:52'),(97,40,1.00,NULL,100.00,30.00,100.00,0.00,0.00,100.00,89.0000,10.0000,'2019-10-08 00:15:53','2019-10-08 00:15:53'),(98,40,1.00,NULL,1000.00,30.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-10-08 00:39:16','2019-10-08 00:39:16'),(99,40,1.00,NULL,1000.00,30.00,1000.00,0.00,0.00,1000.00,892.0000,107.0000,'2019-10-08 00:45:21','2019-10-08 00:45:21');
/*!40000 ALTER TABLE `salesdtls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesmstr`
--

DROP TABLE IF EXISTS `salesmstr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesmstr` (
  `pk_salesmstr` int(11) NOT NULL AUTO_INCREMENT,
  `fk_stores` int(11) DEFAULT NULL,
  `docdate` date DEFAULT NULL,
  `docno` varchar(255) DEFAULT NULL,
  `doctype` char(6) DEFAULT 'sales' COMMENT 'sales or return',
  `fk_trxno` int(11) DEFAULT NULL COMMENT 'link for return',
  `fk_discounts` int(11) DEFAULT NULL,
  `discrate` double(10,2) DEFAULT '0.00',
  `fk_persons` int(11) DEFAULT NULL,
  `payername` varchar(255) DEFAULT '*Walk-in Customer*',
  `remarks` varchar(255) DEFAULT NULL,
  `totalitem` double(10,2) DEFAULT '0.00',
  `totalqty` double(10,2) DEFAULT '0.00',
  `totalamount` double(10,2) DEFAULT '0.00',
  `totaldisc` double(10,2) DEFAULT '0.00',
  `netamount` double(10,2) DEFAULT '0.00',
  `companyvat` double(10,2) DEFAULT '12.00',
  `vatexcempt` double(10,2) DEFAULT '0.00',
  `zerorated` double(10,2) DEFAULT '0.00',
  `vatable` double(10,2) DEFAULT '0.00',
  `vatamount` double(10,2) DEFAULT '0.00',
  `totalpayment` double(10,2) DEFAULT '0.00',
  `changeamount` double(10,2) DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `iscancel` tinyint(1) DEFAULT '0',
  `cancel_at` timestamp NULL DEFAULT NULL,
  `fk_cancelby` int(11) DEFAULT NULL,
  `cancelremarks` varchar(255) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT '1' COMMENT '1=open, 0=close',
  PRIMARY KEY (`pk_salesmstr`),
  KEY `fk_stores` (`fk_stores`),
  KEY `fk_discounts` (`fk_discounts`),
  KEY `fk_persons` (`fk_persons`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  KEY `fk_cancelby` (`fk_cancelby`),
  CONSTRAINT `salesmstr_ibfk_1` FOREIGN KEY (`fk_stores`) REFERENCES `stores` (`pk_stores`),
  CONSTRAINT `salesmstr_ibfk_2` FOREIGN KEY (`fk_discounts`) REFERENCES `discounts` (`pk_discounts`),
  CONSTRAINT `salesmstr_ibfk_3` FOREIGN KEY (`fk_persons`) REFERENCES `persons` (`pk_persons`),
  CONSTRAINT `salesmstr_ibfk_4` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `salesmstr_ibfk_5` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`),
  CONSTRAINT `salesmstr_ibfk_6` FOREIGN KEY (`fk_cancelby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesmstr`
--

LOCK TABLES `salesmstr` WRITE;
/*!40000 ALTER TABLE `salesmstr` DISABLE KEYS */;
INSERT INTO `salesmstr` VALUES (1,1000,'2019-06-06','00000000001','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,1000.00,0.00,'2019-06-06 08:26:28',1000,'2019-06-06 08:26:36',1000,0,NULL,NULL,NULL,0),(2,1000,'2019-06-06','00000000002','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,5.00,0.00,5.00,12.00,0.00,0.00,4.00,0.00,5.00,0.00,'2019-06-06 08:26:42',1000,'2019-06-06 09:03:56',1000,0,NULL,NULL,NULL,0),(3,1000,'2019-06-06','00000000003','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,130.00,0.00,'2019-06-06 09:04:05',1000,'2019-06-07 00:32:55',1013,1,'2019-06-06 16:32:55',1013,NULL,1),(4,1002,'2019-06-06','00000000004','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,100.00,100000.00,0.00,100000.00,12.00,0.00,0.00,89285.00,10714.00,0.00,0.00,'2019-06-06 23:47:14',1013,'2019-06-06 23:54:29',1013,0,NULL,NULL,NULL,1),(5,1000,'2019-06-06','00000000005','sales',NULL,NULL,0.00,1,'Benjamin Bratt',NULL,1.00,1.00,20.00,0.00,20.00,12.00,0.00,0.00,17.00,2.00,50.00,-30.00,'2019-06-06 23:56:48',1013,'2019-06-07 00:32:40',1013,1,'2019-06-06 16:32:40',1013,NULL,1),(6,1000,'2019-06-07','00000000006','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-07 00:00:27',1013,'2019-06-07 00:00:35',NULL,1,'2019-06-06 16:00:35',1013,NULL,1),(7,1000,'2019-06-07','00000000007','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,122.00,0.00,122.00,12.00,0.00,0.00,109.00,13.00,122.00,0.00,'2019-06-07 01:13:07',1013,'2019-06-07 01:13:24',1013,0,NULL,NULL,NULL,0),(8,1000,'2019-06-07','00000000008','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,130.00,0.00,130.00,12.00,0.00,0.00,116.00,13.00,130.00,0.00,'2019-06-07 02:35:43',1013,'2019-06-07 06:08:08',1013,0,NULL,NULL,NULL,0),(9,1000,'2019-06-07','00000000009','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,130.00,0.00,130.00,12.00,0.00,0.00,116.00,13.00,130.00,0.00,'2019-06-07 02:36:02',1013,'2019-06-09 14:20:16',1013,0,NULL,NULL,NULL,0),(10,1000,'2019-06-09','00000000010','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,1000.00,0.00,'2019-06-09 14:24:07',1013,'2019-06-09 14:24:50',1013,0,NULL,NULL,NULL,0),(11,1000,'2019-06-12','00000000011','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-12 04:28:33',1013,'2019-06-12 04:30:22',1013,1,'2019-06-11 20:30:22',1013,NULL,1),(12,1000,'2019-06-12','00000000012','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,20.00,0.00,20.00,12.00,0.00,0.00,17.00,2.00,20.00,0.00,'2019-06-12 04:31:19',1013,'2019-06-12 04:33:53',1013,1,'2019-06-11 20:33:53',1013,NULL,1),(13,1000,'2019-06-12','00000000013','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,20.00,0.00,20.00,12.00,0.00,0.00,17.00,2.00,0.00,20.00,'2019-06-12 04:35:04',1013,'2019-06-12 04:37:06',1013,1,'2019-06-11 20:37:06',1013,NULL,1),(14,1000,'2019-06-14','00000000014','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,2.00,2.00,130.00,0.00,130.00,12.00,0.00,0.00,115.00,13.00,130.00,0.00,'2019-06-14 06:43:34',1000,'2019-06-14 07:07:45',1000,1,'2019-06-13 23:07:45',1013,NULL,0),(15,1000,'2019-06-14','00000000015','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,1000.00,0.00,'2019-06-14 07:50:15',1013,'2019-06-14 07:50:25',1013,0,NULL,NULL,NULL,0),(16,1000,'2019-06-14','00000000016','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-14 07:56:10',1013,'2019-06-18 07:43:54',1013,1,'2019-06-17 23:43:54',1013,NULL,1),(17,1000,'2019-06-17','00000000017','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,3.00,3.00,1150.00,0.00,1150.00,12.00,0.00,0.00,1025.00,122.00,1150.00,0.00,'2019-06-17 14:28:39',1013,'2019-06-18 10:23:03',1013,0,NULL,NULL,NULL,0),(18,1000,'2019-06-18','00000000018','sales',NULL,NULL,0.00,1,'Benjamin Bratt',NULL,2.00,2.00,120.00,0.00,120.00,12.00,0.00,0.00,106.00,12.00,120.00,0.00,'2019-06-18 06:40:31',1013,'2019-06-26 03:05:44',1013,0,NULL,NULL,NULL,0),(19,1000,'2019-06-18','00000000019','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,2.00,2.00,120.00,0.00,120.00,12.00,0.00,0.00,106.00,12.00,0.00,0.00,'2019-06-18 06:48:15',1013,'2019-06-26 03:07:16',1013,1,'2019-06-25 19:07:16',1013,NULL,1),(20,1000,'2019-06-18','00000000020','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-18 06:50:33',1013,'2019-06-18 06:50:42',1013,0,NULL,NULL,NULL,0),(21,1000,'2019-06-18','00000000021','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,2.00,2.00,150.00,0.00,150.00,12.00,0.00,0.00,133.00,15.00,150.00,0.00,'2019-06-18 06:50:50',1013,'2019-06-18 06:50:57',1013,0,NULL,NULL,NULL,0),(22,1000,'2019-06-18','00000000022','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,130.00,0.00,130.00,12.00,0.00,0.00,116.00,13.00,130.00,0.00,'2019-06-18 07:32:14',1013,'2019-06-18 07:33:49',1013,0,NULL,NULL,NULL,0),(23,1000,'2019-06-18','00000000023','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,4.00,12.00,345.00,0.00,345.00,12.00,0.00,0.00,306.00,35.00,345.00,0.00,'2019-06-18 07:36:57',1013,'2019-06-18 07:41:45',1013,0,NULL,NULL,NULL,0),(24,1000,'2019-06-18','00000000024','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-18 07:44:14',1013,'2019-06-26 03:07:31',NULL,1,'2019-06-25 19:07:31',1013,NULL,1),(25,1000,'2019-06-18','00000000025','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-18 07:46:16',1013,'2019-06-26 03:07:37',NULL,1,'2019-06-25 19:07:37',1013,NULL,1),(26,1000,'2019-06-18','00000000026','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-18 07:50:06',1013,'2019-06-26 03:07:44',1013,1,'2019-06-25 19:07:44',1013,NULL,1),(27,1000,'2019-06-18','00000000027','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,2.00,2.00,128.00,0.00,128.00,12.00,0.00,0.00,113.00,13.00,128.00,0.00,'2019-06-18 07:54:42',1013,'2019-06-23 17:09:04',1013,0,NULL,NULL,NULL,0),(28,1000,'2019-06-18','00000000028','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-18 10:07:17',1013,'2019-06-18 10:07:25',1013,0,NULL,NULL,NULL,0),(29,1000,'2019-06-19','00000000029','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-19 14:09:41',1013,'2019-06-19 14:09:51',1013,0,NULL,NULL,NULL,0),(30,1000,'2019-06-23','00000000030','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,3.00,3.00,628.00,0.00,628.00,12.00,0.00,0.00,560.00,66.00,1000.00,-372.00,'2019-06-23 19:11:24',1013,'2019-06-23 19:12:20',1013,0,NULL,NULL,NULL,0),(31,1000,'2019-06-25','00000000031','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-25 07:27:52',1013,'2019-06-25 07:50:42',1013,1,'2019-06-24 23:50:42',1013,NULL,1),(32,1000,'2019-06-25','00000000032','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,16.00,1600.00,0.00,1600.00,12.00,0.00,0.00,1428.00,171.00,1600.00,0.00,'2019-06-25 07:55:36',1013,'2019-06-25 07:58:06',1013,0,NULL,NULL,NULL,0),(33,1000,'2019-06-26','00000000033','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-26 02:56:29',1013,'2019-06-26 02:56:36',1013,0,NULL,NULL,NULL,0),(34,1000,'2019-06-26','00000000034','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-26 02:59:17',1013,'2019-06-26 02:59:33',1013,0,NULL,NULL,NULL,0),(35,1000,'2019-06-26','00000000035','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,200.00,-100.00,'2019-06-26 03:08:05',1013,'2019-06-26 03:08:46',1013,0,NULL,NULL,NULL,0),(36,1000,'2019-06-26','00000000036','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-06-26 03:09:11',1013,'2019-06-26 03:10:04',1013,1,'2019-06-25 19:10:04',1013,NULL,1),(37,1000,'2019-06-26','00000000037','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-06-26 03:10:09',1013,'2019-06-26 03:10:27',1013,0,NULL,NULL,NULL,0),(38,1000,'2019-06-26','00000000038','sales',NULL,NULL,0.00,6,'Alfred Reloj',NULL,3.00,3.00,646.00,0.00,646.00,12.00,0.00,0.00,576.00,67.00,646.00,0.00,'2019-06-26 22:47:32',1020,'2019-09-27 22:40:25',1013,1,'2019-09-27 14:40:25',1013,NULL,1),(39,1000,'2019-06-26','00000000039','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-26 22:47:58',1020,'2019-06-26 22:48:49',NULL,1,'2019-06-26 14:48:49',1020,NULL,1),(40,1000,'2019-06-26','00000000040','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-26 23:16:22',1019,'2019-06-26 23:18:46',1019,1,'2019-06-26 15:18:46',1013,NULL,1),(41,1000,'2019-06-26','00000000041','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,112.00,0.00,112.00,12.00,0.00,0.00,99.00,12.00,0.00,0.00,'2019-06-26 23:18:10',1013,'2019-06-26 23:18:52',1013,1,'2019-06-26 15:18:52',1013,NULL,1),(42,1000,'2019-06-26','00000000042','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-26 23:18:18',1013,'2019-06-26 23:18:59',NULL,1,'2019-06-26 15:18:59',1013,NULL,1),(43,1000,'2019-06-26','00000000043','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-26 23:43:46',1013,'2019-06-26 23:51:32',1013,1,'2019-06-26 15:51:32',1013,NULL,1),(44,1000,'2019-06-26','00000000044','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,2.00,2.00,129.00,0.00,129.00,12.00,0.00,0.00,114.00,13.00,0.00,0.00,'2019-06-26 23:50:08',1013,'2019-06-26 23:51:41',1013,1,'2019-06-26 15:51:41',1013,NULL,1),(45,1000,'2019-06-26','00000000045','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,2.00,3.00,229.00,0.00,229.00,12.00,0.00,0.00,203.00,24.00,0.00,0.00,'2019-06-26 23:51:45',1013,'2019-07-10 23:08:39',1013,1,'2019-07-10 15:08:39',1013,NULL,1),(46,1000,'2019-06-29','00000000046','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-06-29 19:40:06',1013,'2019-07-10 23:08:46',NULL,1,'2019-07-10 15:08:46',1013,NULL,1),(47,1000,'2019-06-29','00000000047','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-06-29 19:44:26',1013,'2019-07-10 23:08:51',1013,1,'2019-07-10 15:08:51',1013,NULL,1),(48,1000,'2019-07-01','00000000048','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-07-01 23:17:03',1013,'2019-07-10 23:08:56',1013,1,'2019-07-10 15:08:56',1013,NULL,1),(49,1000,'2019-07-02','00000000049','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-07-02 08:17:18',1013,'2019-07-02 08:17:34',1013,0,NULL,NULL,NULL,0),(50,1000,'2019-07-10','00000000050','sales',NULL,2,20.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,20.00,80.00,12.00,0.00,0.00,71.00,8.00,0.00,0.00,'2019-07-10 23:08:59',1013,'2019-07-10 23:24:03',1013,1,'2019-07-10 15:24:03',1013,NULL,1),(51,1000,'2019-07-10','00000000051','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,2.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-07-10 23:27:48',1013,'2019-07-10 23:29:40',1013,1,'2019-07-10 15:29:40',1013,NULL,1),(52,1000,'2019-07-10','00000000052','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,0.00,0.00,'2019-07-10 23:29:44',1013,'2019-09-27 22:29:23',1013,1,'2019-09-27 14:29:23',1013,NULL,1),(53,1000,'2019-08-08','00000000053','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-08-08 10:45:15',1013,'2019-08-08 10:45:33',1013,0,NULL,NULL,NULL,0),(54,1000,'2019-08-08','00000000054','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-08-08 10:50:05',1013,'2019-09-27 22:29:29',NULL,1,'2019-09-27 14:29:29',1013,NULL,1),(55,1000,'2019-08-12','00000000055','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-08-12 13:19:42',1013,'2019-09-27 22:29:37',1013,1,'2019-09-27 14:29:37',1013,NULL,1),(56,1000,'2019-08-31','00000000056','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-08-31 09:40:07',1013,'2019-09-27 22:29:43',1013,1,'2019-09-27 14:29:43',1013,NULL,1),(57,1000,'2019-08-31','00000000057','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-08-31 09:43:45',1013,'2019-09-27 22:29:50',NULL,1,'2019-09-27 14:29:50',1013,NULL,1),(58,1000,'2019-08-31','00000000058','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-08-31 09:43:48',1013,'2019-09-27 22:31:35',NULL,1,'2019-09-27 14:31:35',1013,NULL,1),(59,1000,'2019-09-09','00000000059','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-09 10:19:23',1013,'2019-09-27 22:31:10',1013,1,'2019-09-27 14:31:10',1013,NULL,0),(60,1000,'2019-09-14','00000000060','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,150.00,0.00,150.00,12.00,0.00,0.00,133.00,16.00,0.00,0.00,'2019-09-14 11:40:06',1013,'2019-09-27 22:31:04',1013,1,'2019-09-27 14:31:04',1013,NULL,1),(61,1000,'2019-09-25','00000000061','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,0.00,0.00,'2019-09-25 11:25:26',1013,'2019-09-27 22:30:56',1013,1,'2019-09-27 14:30:56',1013,NULL,0),(62,1000,'2019-09-25','00000000062','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-25 14:38:25',1013,'2019-09-27 22:31:21',1013,1,'2019-09-27 14:31:21',1013,NULL,0),(63,1000,'2019-09-25','00000000063','sales',NULL,NULL,0.00,6,'Alfred Reloj',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-25 14:44:39',1013,'2019-09-27 22:31:41',1013,1,'2019-09-27 14:31:41',1013,NULL,1),(64,1000,'2019-09-27','00000000064','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-27 22:32:39',1013,'2019-09-27 22:34:28',1013,1,'2019-09-27 14:34:28',1013,NULL,0),(65,1000,'2019-09-27','00000000065','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-09-27 22:36:05',1013,'2019-09-27 22:36:52',1013,1,'2019-09-27 14:36:52',1013,NULL,1),(66,1000,'2019-09-27','00000000066','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-09-27 22:36:12',1013,'2019-09-27 22:36:58',1013,1,'2019-09-27 14:36:58',1013,NULL,1),(67,1000,'2019-09-27','00000000067','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,250.00,-150.00,'2019-09-27 22:40:28',1013,'2019-09-27 22:42:40',1013,0,NULL,NULL,NULL,0),(68,1000,'2019-09-27','00000000068','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,2.00,200.00,0.00,200.00,12.00,0.00,0.00,178.00,21.00,500.00,-300.00,'2019-09-27 22:46:01',1013,'2019-09-27 22:46:29',1013,0,NULL,NULL,NULL,0),(69,1000,'2019-09-27','00000000069','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,2.00,224.00,0.00,224.00,12.00,0.00,0.00,199.00,24.00,224.00,0.00,'2019-09-27 22:48:54',1013,'2019-09-27 22:49:16',1013,0,NULL,NULL,NULL,0),(70,1000,'2019-09-27','00000000070','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,112.00,0.00,112.00,12.00,0.00,0.00,99.00,12.00,112.00,0.00,'2019-09-27 22:49:38',1013,'2019-09-27 22:59:19',1013,0,NULL,NULL,NULL,0),(71,1000,'2019-09-27','00000000071','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-27 23:01:26',1013,'2019-09-27 23:01:37',1013,0,NULL,NULL,NULL,0),(72,1000,'2019-09-30','00000000072','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-30 11:10:42',1013,'2019-09-30 11:10:53',1013,0,NULL,NULL,NULL,0),(73,1000,'2019-09-30','00000000073','sales',NULL,NULL,0.00,6,'Alfred Reloj',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-30 11:14:12',1013,'2019-09-30 11:14:31',1013,0,NULL,NULL,NULL,0),(74,1000,'2019-09-30','00000000074','sales',NULL,5,20.00,6,'Alfred Reloj',NULL,1.00,1.00,100.00,20.00,80.00,12.00,0.00,0.00,71.00,8.00,80.00,0.00,'2019-09-30 11:15:56',1013,'2019-09-30 12:09:31',1013,1,'2019-09-30 04:09:31',1013,NULL,1),(75,1000,'2019-09-30','00000000075','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 11:25:59',1013,'2019-09-30 11:26:40',NULL,1,'2019-09-30 03:26:40',1013,NULL,1),(76,1000,'2019-09-30','00000000076','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 11:26:19',1013,'2019-09-30 11:26:51',NULL,1,'2019-09-30 03:26:51',1013,NULL,1),(77,1000,'2019-09-30','00000000077','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 11:26:22',1013,'2019-09-30 11:26:45',NULL,1,'2019-09-30 03:26:45',1013,NULL,1),(78,1000,'2019-09-30','00000000078','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-09-30 11:26:55',1013,'2019-09-30 11:33:18',1013,1,'2019-09-30 03:33:18',1013,NULL,1),(79,1000,'2019-09-30','00000000079','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,20.00,0.00,20.00,12.00,0.00,0.00,17.00,2.00,0.00,0.00,'2019-09-30 11:27:01',1013,'2019-09-30 11:33:24',1013,1,'2019-09-30 03:33:24',1013,NULL,1),(80,1000,'2019-09-30','00000000080','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 11:37:52',1013,'2019-09-30 11:38:21',NULL,1,'2019-09-30 03:38:21',1013,NULL,1),(81,1000,'2019-09-30','00000000081','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,90.00,0.00,90.00,12.00,0.00,0.00,80.00,9.00,0.00,0.00,'2019-09-30 11:45:57',1013,'2019-09-30 11:47:29',1013,1,'2019-09-30 03:47:29',1013,NULL,1),(82,1000,'2019-09-30','00000000082','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 11:50:38',1013,'2019-09-30 12:06:24',1013,1,'2019-09-30 04:06:24',1013,NULL,1),(83,1000,'2019-09-30','00000000083','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 12:04:41',1013,'2019-09-30 12:05:08',NULL,1,'2019-09-30 04:05:08',1013,NULL,1),(84,1000,'2019-09-30','00000000084','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,0.00,0.00,'2019-09-30 12:05:55',1013,'2019-09-30 12:06:32',1013,1,'2019-09-30 04:06:32',1013,NULL,1),(85,1000,'2019-09-30','00000000085','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 12:06:08',1013,'2019-09-30 14:26:48',1013,1,'2019-09-30 06:26:48',1013,NULL,1),(86,1000,'2019-09-30','00000000086','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 12:06:38',1013,'2019-09-30 12:06:47',1013,1,'2019-09-30 04:06:47',1013,NULL,1),(87,1000,'2019-09-30','00000000087','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 14:25:50',1013,'2019-09-30 23:26:38',1013,1,'2019-09-30 15:26:38',1013,NULL,1),(88,1000,'2019-09-30','00000000088','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-09-30 23:26:41',1013,'2019-09-30 23:36:17',NULL,1,'2019-09-30 15:36:17',1013,NULL,1),(89,1000,'2019-09-30','00000000089','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,4.00,4.00,450.00,0.00,450.00,12.00,0.00,0.00,399.00,47.00,0.00,0.00,'2019-09-30 23:35:34',1013,'2019-09-30 23:36:05',1013,1,'2019-09-30 15:36:05',1013,NULL,1),(90,1000,'2019-09-30','00000000090','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-09-30 23:36:20',1013,'2019-09-30 23:54:28',1013,0,NULL,NULL,NULL,0),(91,1000,'2019-10-02','00000000091','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,150.00,0.00,150.00,12.00,0.00,0.00,133.00,16.00,0.00,0.00,'2019-10-02 09:52:10',1019,'2019-10-03 11:12:46',1019,1,'2019-10-03 03:12:46',1013,NULL,1),(92,1000,'2019-10-03','00000000092','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,0.00,0.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-10-03 09:24:49',1013,'2019-10-07 15:04:49',1000,1,'2019-10-07 07:04:49',1013,NULL,1),(93,1000,'2019-10-03','00000000093','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,3.00,3.00,120.00,0.00,120.00,12.00,0.00,0.00,106.00,12.00,0.00,0.00,'2019-10-03 11:12:02',1013,'2019-10-03 11:12:34',1013,1,'2019-10-03 03:12:34',1013,NULL,1),(94,1000,'2019-10-04','00000000094','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,850.00,0.00,850.00,12.00,0.00,0.00,758.00,91.00,0.00,0.00,'2019-10-04 11:01:12',1013,'2019-10-04 11:01:37',1013,1,'2019-10-04 03:01:37',1013,NULL,1),(95,1000,'2019-10-07','00000000095','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,0.00,0.00,0.00,12.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-10-07 15:04:19',1013,'2019-10-07 15:04:56',1013,1,'2019-10-07 07:04:56',1013,NULL,1),(96,1000,'2019-10-07','00000000096','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-10-07 15:05:08',1013,'2019-10-07 15:05:56',1013,0,NULL,NULL,NULL,0),(97,1000,'2019-10-08','00000000097','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,100.00,0.00,100.00,12.00,0.00,0.00,89.00,10.00,100.00,0.00,'2019-10-08 00:15:49',1013,'2019-10-08 00:15:59',1013,0,NULL,NULL,NULL,0),(98,1000,'2019-10-08','00000000098','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,1000.00,0.00,'2019-10-08 00:39:14',1013,'2019-10-08 00:39:23',1013,0,NULL,NULL,NULL,0),(99,1000,'2019-10-08','00000000099','sales',NULL,NULL,0.00,NULL,'*Walk-in Customer*',NULL,1.00,1.00,1000.00,0.00,1000.00,12.00,0.00,0.00,892.00,107.00,1000.00,0.00,'2019-10-08 00:45:16',1013,'2019-10-08 00:45:33',1013,0,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `salesmstr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salespayments`
--

DROP TABLE IF EXISTS `salespayments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salespayments` (
  `pk_salespayments` int(11) NOT NULL AUTO_INCREMENT,
  `fk_salesmstr` int(11) DEFAULT NULL,
  `docdate` date DEFAULT NULL,
  `docno` varchar(255) DEFAULT NULL COMMENT 'auto pk_salespayments',
  `mop` char(6) DEFAULT NULL COMMENT 'cash,credit,cheque',
  `amount` double(10,2) DEFAULT NULL,
  `cardno` varchar(255) DEFAULT NULL,
  `cardholder` varchar(255) DEFAULT NULL,
  `cardmonth` char(15) DEFAULT NULL,
  `cardyear` char(15) DEFAULT NULL,
  `cardcodecv` char(15) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `payername` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `iscancel` tinyint(1) DEFAULT '0',
  `cancel_at` timestamp NULL DEFAULT NULL,
  `fk_cancelby` int(11) DEFAULT NULL,
  `cancelremarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pk_salespayments`),
  KEY `fk_salesmstr` (`fk_salesmstr`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  KEY `fk_cancelby` (`fk_cancelby`),
  CONSTRAINT `salespayments_ibfk_1` FOREIGN KEY (`fk_salesmstr`) REFERENCES `salesmstr` (`pk_salesmstr`),
  CONSTRAINT `salespayments_ibfk_2` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `salespayments_ibfk_3` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`),
  CONSTRAINT `salespayments_ibfk_4` FOREIGN KEY (`fk_cancelby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salespayments`
--

LOCK TABLES `salespayments` WRITE;
/*!40000 ALTER TABLE `salespayments` DISABLE KEYS */;
INSERT INTO `salespayments` VALUES (1,1,'2019-06-06','00000000001','cash',1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-06 08:26:36',1000,'2019-06-06 08:26:36',NULL,0,NULL,NULL,NULL),(2,2,'2019-06-06','00000000002','cash',5.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-06 09:03:56',1000,'2019-06-06 09:03:56',NULL,0,NULL,NULL,NULL),(3,3,'2019-06-06','00000000003','cash',130.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-06 09:04:10',1000,'2019-06-06 09:04:10',NULL,0,NULL,NULL,NULL),(4,5,'2019-06-06','00000000004','cash',50.00,NULL,NULL,NULL,NULL,NULL,NULL,'Benjamin Bratt',NULL,'2019-06-06 23:59:28',1013,'2019-06-06 23:59:28',NULL,0,NULL,NULL,NULL),(5,7,'2019-06-07','00000000005','cash',122.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-07 01:13:24',1013,'2019-06-07 01:13:24',NULL,0,NULL,NULL,NULL),(6,8,'2019-06-07','00000000006','cash',130.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-07 06:08:08',1013,'2019-06-07 06:08:08',NULL,0,NULL,NULL,NULL),(7,9,'2019-06-09','00000000007','cash',130.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-09 14:20:16',1013,'2019-06-09 14:20:16',NULL,0,NULL,NULL,NULL),(8,10,'2019-06-09','00000000008','cash',1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-09 14:24:50',1013,'2019-06-09 14:24:50',NULL,0,NULL,NULL,NULL),(9,11,'2019-06-12','00000000009','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-12 04:28:42',1013,'2019-06-12 04:28:42',NULL,0,NULL,NULL,NULL),(10,12,'2019-06-12','00000000010','cash',20.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-12 04:31:26',1013,'2019-06-12 04:31:26',NULL,0,NULL,NULL,NULL),(11,13,'2019-06-12','00000000011','cash',20.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-12 04:35:09',1013,'2019-06-12 04:35:47',NULL,1,'2019-06-11 20:35:47',1013,NULL),(12,14,'2019-06-14','00000000012','cash',130.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-14 06:43:44',1000,'2019-06-14 06:43:44',NULL,0,NULL,NULL,NULL),(13,15,'2019-06-14','00000000013','cash',1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-14 07:50:25',1013,'2019-06-14 07:50:25',NULL,0,NULL,NULL,NULL),(14,20,'2019-06-18','00000000014','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-18 06:50:42',1013,'2019-06-18 06:50:42',NULL,0,NULL,NULL,NULL),(15,21,'2019-06-18','00000000015','cash',150.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-18 06:50:57',1013,'2019-06-18 06:50:57',NULL,0,NULL,NULL,NULL),(16,22,'2019-06-18','00000000016','cash',130.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-18 07:33:49',1013,'2019-06-18 07:33:49',NULL,0,NULL,NULL,NULL),(17,23,'2019-06-18','00000000017','cash',345.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-18 07:41:45',1013,'2019-06-18 07:41:45',NULL,0,NULL,NULL,NULL),(18,28,'2019-06-18','00000000018','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-18 10:07:25',1013,'2019-06-18 10:07:25',NULL,0,NULL,NULL,NULL),(19,17,'2019-06-18','00000000019','cash',1150.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-18 10:23:03',1013,'2019-06-18 10:23:03',NULL,0,NULL,NULL,NULL),(20,29,'2019-06-19','00000000020','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-19 14:09:51',1013,'2019-06-19 14:09:51',NULL,0,NULL,NULL,NULL),(21,27,'2019-06-23','00000000021','cash',128.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-23 17:09:04',1013,'2019-06-23 17:09:04',NULL,0,NULL,NULL,NULL),(22,30,'2019-06-23','00000000022','cash',1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-23 19:12:20',1013,'2019-06-23 19:12:20',NULL,0,NULL,NULL,NULL),(23,32,'2019-06-25','00000000023','cash',1600.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-25 07:58:06',1013,'2019-06-25 07:58:06',NULL,0,NULL,NULL,NULL),(24,33,'2019-06-26','00000000024','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-26 02:56:36',1013,'2019-06-26 02:56:36',NULL,0,NULL,NULL,NULL),(25,34,'2019-06-26','00000000025','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-26 02:59:33',1013,'2019-06-26 02:59:33',NULL,0,NULL,NULL,NULL),(26,18,'2019-06-26','00000000026','cash',120.00,NULL,NULL,NULL,NULL,NULL,NULL,'Benjamin Bratt',NULL,'2019-06-26 03:05:44',1013,'2019-06-26 03:05:44',NULL,0,NULL,NULL,NULL),(27,35,'2019-06-26','00000000027','cash',200.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-26 03:08:46',1013,'2019-06-26 03:08:46',NULL,0,NULL,NULL,NULL),(28,37,'2019-06-26','00000000028','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-06-26 03:10:27',1013,'2019-06-26 03:10:27',NULL,0,NULL,NULL,NULL),(29,38,'2019-06-26','00000000029','cash',646.00,NULL,NULL,NULL,NULL,NULL,NULL,'Alfred Reloj',NULL,'2019-06-26 23:12:55',1019,'2019-06-26 23:12:55',NULL,0,NULL,NULL,NULL),(30,49,'2019-07-02','00000000030','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-07-02 08:17:34',1013,'2019-07-02 08:17:34',NULL,0,NULL,NULL,NULL),(31,53,'2019-08-08','00000000031','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-08-08 10:45:33',1013,'2019-08-08 10:45:33',NULL,0,NULL,NULL,NULL),(32,59,'2019-09-09','00000000032','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-09 10:19:30',1013,'2019-09-09 10:19:30',NULL,0,NULL,NULL,NULL),(33,62,'2019-09-25','00000000033','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-25 14:38:41',1013,'2019-09-25 14:38:41',NULL,0,NULL,NULL,NULL),(34,64,'2019-09-27','00000000034','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 22:32:53',1013,'2019-09-27 22:32:53',NULL,0,NULL,NULL,NULL),(35,67,'2019-09-27','00000000035','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 22:41:02',1013,'2019-09-27 22:42:24',NULL,1,'2019-09-27 14:42:24',1013,NULL),(36,67,'2019-09-27','00000000036','cash',150.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 22:42:40',1013,'2019-09-27 22:42:40',NULL,0,NULL,NULL,NULL),(37,68,'2019-09-27','00000000037','cash',500.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 22:46:29',1013,'2019-09-27 22:46:29',NULL,0,NULL,NULL,NULL),(38,69,'2019-09-27','00000000038','cash',224.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 22:49:16',1013,'2019-09-27 22:49:16',NULL,0,NULL,NULL,NULL),(39,70,'2019-09-27','00000000039','cash',112.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 22:59:19',1013,'2019-09-27 22:59:19',NULL,0,NULL,NULL,NULL),(40,71,'2019-09-27','00000000040','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-27 23:01:37',1013,'2019-09-27 23:01:37',NULL,0,NULL,NULL,NULL),(41,72,'2019-09-30','00000000041','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-30 11:10:53',1013,'2019-09-30 11:10:53',NULL,0,NULL,NULL,NULL),(42,73,'2019-09-30','00000000042','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'Alfred Reloj',NULL,'2019-09-30 11:14:31',1013,'2019-09-30 11:14:31',NULL,0,NULL,NULL,NULL),(43,74,'2019-09-30','00000000043','cash',80.00,NULL,NULL,NULL,NULL,NULL,NULL,'Alfred Reloj',NULL,'2019-09-30 11:16:30',1013,'2019-09-30 12:08:20',NULL,1,'2019-09-30 04:08:20',1013,NULL),(44,74,'2019-09-30','00000000044','cash',90.00,NULL,NULL,NULL,NULL,NULL,NULL,'Alfred Reloj',NULL,'2019-09-30 12:08:49',1013,'2019-09-30 12:09:24',NULL,1,'2019-09-30 04:09:24',1013,NULL),(45,90,'2019-09-30','00000000045','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-09-30 23:54:28',1013,'2019-09-30 23:54:28',NULL,0,NULL,NULL,NULL),(46,96,'2019-10-07','00000000046','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-10-07 15:05:56',1013,'2019-10-07 15:05:56',NULL,0,NULL,NULL,NULL),(47,97,'2019-10-08','00000000047','cash',100.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-10-08 00:15:59',1013,'2019-10-08 00:15:59',NULL,0,NULL,NULL,NULL),(48,98,'2019-10-08','00000000048','cash',1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-10-08 00:39:23',1013,'2019-10-08 00:39:23',NULL,0,NULL,NULL,NULL),(49,99,'2019-10-08','00000000049','cash',1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'*Walk-in Customer*',NULL,'2019-10-08 00:45:33',1013,'2019-10-08 00:45:33',NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `salespayments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `pk_stores` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `receiptfooter` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_stores`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `stores_ibfk_2` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1000,'Store One Lahug Branch','description one','one@gmail.com','003213','Cebu City','000-390-189-1258','test','2017-11-16 14:30:22',1000,'2019-06-18 22:52:51',1013,1),(1001,'Store Two Basak Branch','Description two','2@gmail.com','093212','Lahug',NULL,'sample footer',NULL,NULL,'2017-11-28 08:13:05',1000,1),(1002,'Store three Banawa Branch','Three Store','3@gmail.com','three contact','cebu city','332','sample\r\nupdated',NULL,NULL,'2017-12-12 15:42:44',1000,1),(1005,'Test','Test','test@gmail.com','safd','sdf123','123','sdf12  123','2019-03-24 14:44:16',1000,'2019-06-04 01:44:33',1000,1);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraccess`
--

DROP TABLE IF EXISTS `useraccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraccess` (
  `fk_users` int(11) DEFAULT NULL,
  `fk_permalink` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  UNIQUE KEY `fk_users` (`fk_users`,`fk_permalink`),
  KEY `fk_permalink` (`fk_permalink`),
  KEY `fk_createdby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `useraccess_ibfk_1` FOREIGN KEY (`fk_users`) REFERENCES `users` (`id`),
  CONSTRAINT `useraccess_ibfk_2` FOREIGN KEY (`fk_permalink`) REFERENCES `permalink` (`pk_permalink`),
  CONSTRAINT `useraccess_ibfk_3` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `useraccess_ibfk_4` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraccess`
--

LOCK TABLES `useraccess` WRITE;
/*!40000 ALTER TABLE `useraccess` DISABLE KEYS */;
INSERT INTO `useraccess` VALUES (1000,1200,'2019-06-06 07:39:19',1000,'2019-06-06 07:39:19',1000),(1019,1200,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1400,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1401,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1403,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1408,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1409,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1410,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1412,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1413,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1414,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1530,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1532,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1019,1540,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1020,1200,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1300,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1301,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1303,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1304,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1305,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1306,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1307,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1308,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1310,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1311,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1312,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1313,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1314,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1400,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1401,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1402,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1403,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1420,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1404,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1405,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1406,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1407,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1408,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1409,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1410,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1411,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1412,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1413,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1414,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1500,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1510,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1511,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1512,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1513,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1514,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1520,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1521,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1522,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1523,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1524,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1020,1700,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1013,1200,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1300,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1301,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1303,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1304,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1305,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1306,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1307,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1308,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1310,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1311,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1312,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1313,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1314,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1400,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1401,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1402,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1403,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1420,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1404,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1405,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1406,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1407,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1408,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1409,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1410,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1411,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1412,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1413,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1414,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1500,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1510,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1511,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1512,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1513,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1514,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1520,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1521,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1522,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1523,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1524,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1530,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1531,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1532,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1533,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1534,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1540,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1541,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1542,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1543,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1544,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1545,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1550,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1555,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1700,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1701,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1702,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1703,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1704,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1705,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1706,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1707,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1708,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,2000,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,2001,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,2010,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,2020,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,2030,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000);
/*!40000 ALTER TABLE `useraccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usercode` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pictx` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  `stat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usercode` (`usercode`)
) ENGINE=InnoDB AUTO_INCREMENT=1021 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1000,'Administrator',NULL,'opic','$2y$10$OGWrwDFX4gXJGLqpcRfv9uSfEARbxyhPKwrmjw6VFqTcqpeKWL5Rq','db6ofwHlOUTkRwS4AqhmVrTFHQM1aU2Hr5qYlhYjerq0PxHIxOmQ1uJAsAPL',NULL,'2017-11-15 21:21:28',NULL,'2019-06-13 22:43:20',1000,1),(1013,'Administrator',NULL,'admin','$2y$10$19PP.nrrYgGgPj8QuxtrB.Q4aZlGkoAHVEf7KHA3dz2nDXG13yXRq','yMZA2E2aQf41mdH8R2KKav35pi12MzFzKzr3FluRoqHfiAeZfo6xonJe9oB1','users/RfgNwXgPoBnq4gAo9h5pLScQwI39clC9Jjeub0dw.jpeg','2017-11-28 08:11:19',1000,'2019-06-13 22:45:21',1000,1),(1019,'Guest',NULL,'guest','$2y$10$zT74SSmuOHLkTrRdIWMTk.2uBckj1Vsh9ivAEEnHRTxUoRoqpOGaW','LleuaTTbkhjnShMIFoBi3sevI3rLk2vSabHQOB8z5UGYMkCZed1PznWgfkRa',NULL,'2019-06-06 17:18:05',1013,'2019-06-06 21:47:21',NULL,1),(1020,'Guest1 Sample',NULL,'guest1','$2y$10$.0/fBogIGIHca5Q7z/xeJefv0VQU9mgn5x6jTWtL9.U91LjyVuNRG','hQrRpe8bzzoNJCMPhq2ZOESQLDyd6xM7TACsvTRaz4HvzWy5eazLpb4O9jZx',NULL,'2019-06-26 14:43:51',1013,'2019-06-26 14:43:51',NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userstores`
--

DROP TABLE IF EXISTS `userstores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userstores` (
  `fk_users` int(11) DEFAULT NULL,
  `fk_stores` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fk_createdby` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fk_updatedby` int(11) DEFAULT NULL,
  UNIQUE KEY `fk_users` (`fk_users`,`fk_stores`),
  KEY `fk_stores` (`fk_stores`),
  KEY `fk_creadtedby` (`fk_createdby`),
  KEY `fk_updatedby` (`fk_updatedby`),
  CONSTRAINT `userstores_ibfk_1` FOREIGN KEY (`fk_users`) REFERENCES `users` (`id`),
  CONSTRAINT `userstores_ibfk_2` FOREIGN KEY (`fk_stores`) REFERENCES `stores` (`pk_stores`),
  CONSTRAINT `userstores_ibfk_3` FOREIGN KEY (`fk_createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `userstores_ibfk_4` FOREIGN KEY (`fk_updatedby`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userstores`
--

LOCK TABLES `userstores` WRITE;
/*!40000 ALTER TABLE `userstores` DISABLE KEYS */;
INSERT INTO `userstores` VALUES (1000,1000,'2019-06-06 07:39:19',1000,'2019-06-06 07:39:19',1000),(1000,1002,'2019-06-06 07:39:19',1000,'2019-06-06 07:39:19',1000),(1019,1000,'2019-06-07 02:04:20',1013,'2019-06-07 02:04:20',1013),(1020,1000,'2019-06-26 22:45:10',1013,'2019-06-26 22:45:10',1013),(1013,1000,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1002,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1001,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000),(1013,1005,'2019-10-07 12:54:58',1000,'2019-10-07 12:54:58',1000);
/*!40000 ALTER TABLE `userstores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_electronicstockcard`
--

DROP TABLE IF EXISTS `vw_electronicstockcard`;
/*!50001 DROP VIEW IF EXISTS `vw_electronicstockcard`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_electronicstockcard` AS SELECT 
 1 AS `docdate`,
 1 AS `customdocdate`,
 1 AS `doctype`,
 1 AS `particulars`,
 1 AS `encoded_by`,
 1 AS `pk_products`,
 1 AS `type`,
 1 AS `name`,
 1 AS `qty`,
 1 AS `oldqty`,
 1 AS `fk_stores`,
 1 AS `storename`,
 1 AS `qtyadjremarks`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_expensemstr`
--

DROP TABLE IF EXISTS `vw_expensemstr`;
/*!50001 DROP VIEW IF EXISTS `vw_expensemstr`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_expensemstr` AS SELECT 
 1 AS `pk_expense`,
 1 AS `docdate`,
 1 AS `docno`,
 1 AS `fk_categories`,
 1 AS `category`,
 1 AS `fk_stores`,
 1 AS `storename`,
 1 AS `amount`,
 1 AS `remarks`,
 1 AS `attachment`,
 1 AS `created_at`,
 1 AS `fk_createdby`,
 1 AS `updated_at`,
 1 AS `fk_updatedby`,
 1 AS `stat`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_genledger`
--

DROP TABLE IF EXISTS `vw_genledger`;
/*!50001 DROP VIEW IF EXISTS `vw_genledger`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_genledger` AS SELECT 
 1 AS `doctype`,
 1 AS `docno`,
 1 AS `fk_stores`,
 1 AS `storename`,
 1 AS `docdate`,
 1 AS `amount`,
 1 AS `remarks`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_productsdtl`
--

DROP TABLE IF EXISTS `vw_productsdtl`;
/*!50001 DROP VIEW IF EXISTS `vw_productsdtl`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_productsdtl` AS SELECT 
 1 AS `pk_products`,
 1 AS `barcode`,
 1 AS `type`,
 1 AS `name`,
 1 AS `fk_categories`,
 1 AS `category`,
 1 AS `fk_supplier`,
 1 AS `supplier`,
 1 AS `cost`,
 1 AS `tax`,
 1 AS `uom`,
 1 AS `alertqty`,
 1 AS `pictx`,
 1 AS `background`,
 1 AS `remarks`,
 1 AS `stat`,
 1 AS `fk_stores`,
 1 AS `price`,
 1 AS `oldprice`,
 1 AS `discount`,
 1 AS `olddiscount`,
 1 AS `fk_storesvisibility`,
 1 AS `storename`,
 1 AS `qty`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_productsmstr`
--

DROP TABLE IF EXISTS `vw_productsmstr`;
/*!50001 DROP VIEW IF EXISTS `vw_productsmstr`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_productsmstr` AS SELECT 
 1 AS `pk_products`,
 1 AS `type`,
 1 AS `barcode`,
 1 AS `name`,
 1 AS `fk_categories`,
 1 AS `category`,
 1 AS `fk_supplier`,
 1 AS `supplier`,
 1 AS `cost`,
 1 AS `tax`,
 1 AS `uom`,
 1 AS `alertqty`,
 1 AS `pictx`,
 1 AS `background`,
 1 AS `remarks`,
 1 AS `stat`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_salesdtl`
--

DROP TABLE IF EXISTS `vw_salesdtl`;
/*!50001 DROP VIEW IF EXISTS `vw_salesdtl`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_salesdtl` AS SELECT 
 1 AS `fk_salesmstr`,
 1 AS `fk_products`,
 1 AS `name`,
 1 AS `qty`,
 1 AS `oldqty`,
 1 AS `uom`,
 1 AS `unitprice`,
 1 AS `unitcost`,
 1 AS `totalamount`,
 1 AS `discrate`,
 1 AS `discamount`,
 1 AS `netamount`,
 1 AS `vatable`,
 1 AS `vatamount`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_salesmstr`
--

DROP TABLE IF EXISTS `vw_salesmstr`;
/*!50001 DROP VIEW IF EXISTS `vw_salesmstr`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_salesmstr` AS SELECT 
 1 AS `pk_salesmstr`,
 1 AS `fk_stores`,
 1 AS `storename`,
 1 AS `docdate`,
 1 AS `docno`,
 1 AS `doctype`,
 1 AS `fk_trxno`,
 1 AS `fk_discounts`,
 1 AS `discountname`,
 1 AS `discrate`,
 1 AS `fk_persons`,
 1 AS `customername`,
 1 AS `tinno`,
 1 AS `address`,
 1 AS `payername`,
 1 AS `trxdescription`,
 1 AS `remarks`,
 1 AS `totalitem`,
 1 AS `totalqty`,
 1 AS `totalamount`,
 1 AS `totaldisc`,
 1 AS `companyvat`,
 1 AS `vatable`,
 1 AS `vatexcempt`,
 1 AS `zerorated`,
 1 AS `vatamount`,
 1 AS `netamount`,
 1 AS `totalpayment`,
 1 AS `changeamount`,
 1 AS `created_at`,
 1 AS `fk_createdby`,
 1 AS `cashiername`,
 1 AS `iscancel`,
 1 AS `cancel_at`,
 1 AS `stat`,
 1 AS `paymentstat`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'tercet_pos'
--

--
-- Dumping routines for database 'tercet_pos'
--
/*!50003 DROP FUNCTION IF EXISTS `udf_getLastDateQtyAdj` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETLASTDATEQTYADJ`(productID int, storeID int) RETURNS datetime
BEGIN
    
	DECLARE docdate datetime;
	SET docdate = null;
	
	SELECT MAX(created_at) INTO docdate
	FROM productsqty
	WHERE fk_products = productID AND fk_stores = storeID;
	
	return docdate;
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getLastQtyAdj` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETLASTQTYADJ`(productID INT, storeID INT) RETURNS double
BEGIN
    
	DECLARE qty double;
	SET qty = 0;
	
	SELECT COALESCE(a.qty + oldqty, 0) INTO qty
	FROM productsqty a 
	WHERE a.fk_products = productID AND a.fk_stores = storeID
	AND a.created_at = (
		SELECT MAX(created_at)
		FROM productsqty 
		WHERE fk_products = a.fk_products AND fk_stores = a.fk_stores
	)
	LIMIT 1;
	
	RETURN qty;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getLastQtySales` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETLASTQTYSALES`(productID INT, storeID INT) RETURNS double
BEGIN
	
	-- compute last qty sales whose date 'updated_at' is greater than or equals to lastDateQtyAdj
	DECLARE sales DOUBLE;
	SET sales = 0;
	
	SELECT coalesce(SUM(qty),0) INTO sales
	FROM salesmstr a 
	INNER JOIN salesdtls b 
	ON a.pk_salesmstr = b.fk_salesmstr
	WHERE b.created_at >= udf_getLastDateQtyAdj(productID, storeID)
	AND b.fk_products = productID AND a.fk_stores = storeID
	AND coalesce(a.iscancel, 0) = 0;
	
	RETURN sales;
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getLastQtySalesCompositions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETLASTQTYSALESCOMPOSITIONS`(productID INT, storeID INT) RETURNS double
BEGIN
    
	-- compute last qty sales whose date 'updated_at' is greater than or equals to lastDateQtyAdj
	DECLARE sales DOUBLE;
	SET sales = 0;
	
	SELECT COALESCE(SUM(qty),0) INTO sales
	FROM salesmstr a 
	INNER JOIN salescompositions b 
	ON a.pk_salesmstr = b.fk_salesmstr
	WHERE b.created_at >= udf_getLastDateQtyAdj(productID, storeID)
	AND b.fk_compositions = productID AND a.fk_stores = storeID
	AND COALESCE(a.iscancel, 0) = 0;
	
	RETURN sales;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getPaymentStat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `udf_getPaymentStat`(salesID int) RETURNS char(15) CHARSET latin1
BEGIN
    
	DECLARE stat char(15);
	SET stat = '';
	
	SELECT 
		CASE 
			WHEN udf_getTotalPaymentPerSales(salesID) >= netamount THEN 'paid' 
			WHEN udf_getTotalPaymentPerSales(salesID) = 0 THEN 'unpaid' 
			ELSE 'partial' 
			
		END as paymentstat INTO stat
		
	FROM salesmstr
	
	WHERE pk_salesmstr = salesID;
	
	return stat;
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getProductName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETPRODUCTNAME`(product_id int) RETURNS text CHARSET latin1
BEGIN
	
	declare result text;
	set result = '';
	SELECT NAME INTO result FROM products WHERE pk_products = product_id;
	RETURN result; 
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getStoreName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETSTORENAME`(store_id varchar(255)) RETURNS text CHARSET latin1
BEGIN
    
	    
	DECLARE result text;
	SET result = '';
	
	IF store_id = 'All' THEN 
	  RETURN 'All';
	END if;
	
	
	SELECT NAME INTO result FROM stores WHERE pk_stores = store_id;
	RETURN result; 
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getTotalPaymentPerSales` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `udf_getTotalPaymentPerSales`(salesID int) RETURNS double
BEGIN
    
	DECLARE payment double;
	SET payment = 0;
	
	SELECT COALESCE( SUM(amount), 0) INTo payment
	FROM salespayments 
	WHERE coalesce(iscancel,0) = 0
	AND fk_salesmstr = salesID;
	
	RETURN payment;
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_getUserName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `UDF_GETUSERNAME`(`user_id` INT) RETURNS varchar(255) CHARSET latin1
BEGIN
    
	DECLARE result TEXT;
	SET result = '';
	
	SELECT NAME INTO result FROM users WHERE id = user_id;
	RETURN result; 
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `udf_isUserHasAccess` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  FUNCTION `udf_isUserHasAccess`( user_id INT, pk_permalink INT ) RETURNS tinyint(1)
BEGIN
    
	DECLARE result INT; SET result = NULL; 	
		
	-- Administrator = 1000
	IF user_id = 1000 THEN
		RETURN 1;
	END IF;
	
	-- Non Admin user
	SELECT fk_users INTO result FROM useraccess 
	WHERE fk_users = user_id 
	AND fk_permalink = pk_permalink;
	
	-- if no access found then no results will be found / null
	IF result IS NULL THEN
		RETURN 0;
	ELSE
		RETURN 1;
	END IF;
		
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_displayGenLedger` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_displayGenLedger`(in storeID text, in dateFrom datetime, in dateTo datetime)
BEGIN
    
	 SELECT doctype, fk_stores, storename, docdate, 
	 case 
		WHEN doctype = 'sales' THEN sum(amount)
		ELSE 0
	 END as 'salesamount',
	  CASE 
		WHEN doctype = 'expense' THEN SUM(amount)
		ELSE 0
	 END AS 'expenseamount',
	 remarks 
	FROM vw_genledger
	WHERE ( fk_stores = storeID or storeID = 'All' )
                       
	AND docdate BETWEEN dateFrom AND dateTo
	GROUP BY doctype, docdate
	ORDER BY  fk_stores, docdate;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_getAssignedReports` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_getAssignedReports`(IN user_id Int, in search char(50))
BEGIN
    
	-- Administator = 1000
	IF user_id = 1000 THEN
	
	    SELECT a.*
            FROM permalink a 
            WHERE (a.stat = 1  AND a.family = 'Reports' AND a.type <> 'A' )
            AND a.description like concat('%', search, '%' )
            ORDER BY a.description DESC;
	
	ELSE 
	-- Non Admin
		 SELECT a.*
            FROM permalink a 
            INNER JOIN useraccess b 
            ON a.pk_permalink = b.fk_permalink
            WHERE ( a.stat = 1  AND a.family = 'Reports' AND a.type <> 'A' AND b.fk_users = user_id )
            AND a.description LIKE CONCAT('%', search, '%' )
            ORDER BY a.description DESC;
		
	END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_getAssignedStores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_getAssignedStores`(in user_id int)
BEGIN
    
	-- Administator = 1000
	IF user_id = 1000 THEN
	
		SELECT a.*
		FROM stores a 
		WHERE a.stat = 1
		ORDER BY a.name ASC;
	
	ELSE 
	-- Non Admin
		SELECT a.*
		FROM stores a 
		LEFT JOIN userstores b 
		ON a.pk_stores = b.fk_stores
		WHERE b.fk_users = user_id AND a.stat = 1
		ORDER BY a.name ASC;
		
	END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_getMainMenu` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_getMainMenu`(in user_id int)
BEGIN
    
	-- Administator = 1000
	IF user_id = 1000 THEN
		SELECT a.*, b.pk_divider  FROM permalink  a
		LEFT JOIN permadivider b 
		ON a.pk_permalink = b.fk_permalink
		WHERE a.type IN ('A','B')  AND a.stat = 1 
		ORDER BY a.indexno ASC, a.family, a.type ASC;
	ELSE 
	-- Non Admin
		SELECT b.*, c.pk_divider
		FROM useraccess a 
		INNER JOIN permalink b 
		ON a.fk_permalink = b.pk_permalink
		LEFT JOIN permadivider c 
		ON b.pk_permalink = c.fk_permalink
		WHERE a.fk_users = user_id
		AND b.TYPE IN ('A','B')  AND b.stat = 1 
		ORDER BY  b.indexno ASC, b.family, b.type ASC;
		
	END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_getModules` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_getModules`(IN user_id INT, IN mod_type CHAR(1))
BEGIN
    
	SELECT a.*, b.fk_users
	FROM permalink a 
	LEFT JOIN useraccess b
	ON a.`pk_permalink` = b.`fk_permalink` AND b.fk_users = user_id
	WHERE  a.type = mod_type AND a.stat = 1 
	ORDER BY a.indexno ASC, a.family, a.type ASC;
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_getStores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_getStores`(in user_id int)
BEGIN
    
	SELECT a.*, b.fk_users
	FROM stores a 
	LEFT JOIN userstores b
	ON a.`pk_stores` = b.`fk_stores` AND b.fk_users = user_id
	WHERE  a.stat = 1 
	ORDER BY a.name ASC;
	
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_getSubMenu` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_getSubMenu`(IN user_id INT, IN menu_group VARCHAR(50))
BEGIN
    
	-- Administator = 1000
	IF user_id = 1000 THEN
		SELECT * FROM permalink 
		WHERE TYPE IN ('C') AND family = menu_group AND stat = 1 
		ORDER BY family, TYPE ASC, indexno ASC;
	ELSE 
		SELECT b.*
		FROM useraccess a 
		INNER JOIN permalink b 
		ON a.fk_permalink = b.pk_permalink
		WHERE a.fk_users = user_id
		AND b.TYPE IN ('C')  AND b.family = menu_group AND b.stat = 1 
		ORDER BY b.family, b.TYPE ASC, b.indexno ASC;
		
	END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_searchAssignedProductsPerStores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE  PROCEDURE `usp_searchAssignedProductsPerStores`(in user_id INT, in store_id int, in stat tinyint (1), in search char(50))
BEGIN
    
	-- Administator = 1000
	IF user_id = 1000 THEN
		
		SELECT a.pk_products, a.type, a.name
		FROM products a 
		WHERE a.stat = stat
		AND a.name LIKE search 
		ORDER BY a.name ASC
		LIMIT 10;
	
	ELSE 
		-- Non Admin
		SELECT a.pk_products, a.type, a.name
		FROM products a 
		INNER JOIN productsstore b 
		ON a.pk_products = b.fk_products
		WHERE a.stat = stat AND b.fk_stores = store_id
		AND  a.name LIKE search 
		ORDER BY a.name ASC
		LIMIT 10;
		
	END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_electronicstockcard`
--

/*!50001 DROP VIEW IF EXISTS `vw_electronicstockcard`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_electronicstockcard` AS select NULL AS `docdate`,NULL AS `customdocdate`,'beginning' AS `doctype`,'Beginning Inventory' AS `particulars`,`UDF_GETUSERNAME`(`b`.`fk_createdby`) AS `encoded_by`,`a`.`pk_products` AS `pk_products`,`a`.`type` AS `type`,`a`.`name` AS `name`,coalesce(`b`.`qty`,0) AS `qty`,coalesce(`b`.`oldqty`,0) AS `oldqty`,`b`.`fk_stores` AS `fk_stores`,`UDF_GETSTORENAME`(`b`.`fk_stores`) AS `storename`,'' AS `qtyadjremarks` from (`products` `a` left join `productsqty` `b` on((`a`.`pk_products` = `b`.`fk_products`))) where (`b`.`created_at` = `UDF_GETLASTDATEQTYADJ`(`a`.`pk_products`,`b`.`fk_stores`)) union all select `b`.`created_at` AS `docdate`,date_format(`b`.`created_at`,'%b %d %Y %h:%i %p') AS `customdocdate`,'adj' AS `doctype`,'Adjustment' AS `particulars`,`UDF_GETUSERNAME`(`b`.`fk_createdby`) AS `encoded_by`,`a`.`pk_products` AS `pk_products`,`a`.`type` AS `type`,`a`.`name` AS `name`,coalesce(`b`.`qty`,0) AS `qty`,coalesce(`b`.`oldqty`,0) AS `oldqty`,`b`.`fk_stores` AS `fk_stores`,`UDF_GETSTORENAME`(`b`.`fk_stores`) AS `storename`,`b`.`remarks` AS `qtyadjremarks` from (`products` `a` left join `productsqty` `b` on((`a`.`pk_products` = `b`.`fk_products`))) union all select `b`.`created_at` AS `docdate`,date_format(`b`.`created_at`,'%b %d %Y %h:%i %p') AS `customdocdate`,'sales' AS `doctype`,concat('Sales No.',`c`.`pk_salesmstr`,' ',`c`.`payername`) AS `particulars`,`UDF_GETUSERNAME`(`c`.`fk_createdby`) AS `encoded_by`,`a`.`pk_products` AS `pk_products`,`a`.`type` AS `type`,`a`.`name` AS `name`,coalesce(`b`.`qty`,0) AS `qty`,0 AS `oldqty`,`c`.`fk_stores` AS `fk_stores`,`UDF_GETSTORENAME`(`c`.`fk_stores`) AS `storename`,'' AS `qtyadjremarks` from ((`products` `a` left join `salesdtls` `b` on((`a`.`pk_products` = `b`.`fk_products`))) left join `salesmstr` `c` on((`b`.`fk_salesmstr` = `c`.`pk_salesmstr`))) where (coalesce(`c`.`iscancel`,0) = 0) union all select `b`.`created_at` AS `docdate`,date_format(`b`.`created_at`,'%b %d %Y %h:%i %p') AS `customdocdate`,'sales' AS `doctype`,concat('Composition for Sales No. ',`c`.`pk_salesmstr`,' (',convert(`UDF_GETPRODUCTNAME`(`b`.`fk_products`) using utf8),')') AS `particulars`,`UDF_GETUSERNAME`(`c`.`fk_createdby`) AS `encoded_by`,`a`.`pk_products` AS `pk_products`,`a`.`type` AS `type`,`a`.`name` AS `name`,coalesce(`b`.`qty`,0) AS `qty`,0 AS `oldqty`,`c`.`fk_stores` AS `fk_stores`,`UDF_GETSTORENAME`(`c`.`fk_stores`) AS `storename`,'' AS `qtyadjremarks` from ((`products` `a` left join `salescompositions` `b` on((`a`.`pk_products` = `b`.`fk_compositions`))) left join `salesmstr` `c` on((`b`.`fk_salesmstr` = `c`.`pk_salesmstr`))) where (coalesce(`c`.`iscancel`,0) = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_expensemstr`
--

/*!50001 DROP VIEW IF EXISTS `vw_expensemstr`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_expensemstr` AS select `a`.`pk_expense` AS `pk_expense`,`a`.`docdate` AS `docdate`,`a`.`docno` AS `docno`,`a`.`fk_categories` AS `fk_categories`,`b`.`description` AS `category`,`a`.`fk_stores` AS `fk_stores`,`c`.`name` AS `storename`,`a`.`amount` AS `amount`,`a`.`remarks` AS `remarks`,`a`.`attachment` AS `attachment`,`a`.`created_at` AS `created_at`,`a`.`fk_createdby` AS `fk_createdby`,`a`.`updated_at` AS `updated_at`,`a`.`fk_updatedby` AS `fk_updatedby`,coalesce(`a`.`stat`,0) AS `stat` from ((`expense` `a` left join `categories` `b` on((`a`.`fk_categories` = `b`.`pk_categories`))) left join `stores` `c` on((`a`.`fk_stores` = `c`.`pk_stores`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_genledger`
--

/*!50001 DROP VIEW IF EXISTS `vw_genledger`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_genledger` AS select `a`.`doctype` AS `doctype`,`a`.`pk_salesmstr` AS `docno`,`a`.`fk_stores` AS `fk_stores`,`a`.`storename` AS `storename`,`a`.`docdate` AS `docdate`,`a`.`netamount` AS `amount`,`a`.`remarks` AS `remarks` from `vw_salesmstr` `a` where (coalesce(`a`.`iscancel`,0) = 0) union all select 'expense' AS `doctype`,`a`.`pk_expense` AS `docno`,`a`.`fk_stores` AS `fk_stores`,`a`.`storename` AS `storename`,`a`.`docdate` AS `docdate`,`a`.`amount` AS `amount`,`a`.`remarks` AS `remarks` from `vw_expensemstr` `a` where (`a`.`stat` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_productsdtl`
--

/*!50001 DROP VIEW IF EXISTS `vw_productsdtl`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_productsdtl` AS select `a`.`pk_products` AS `pk_products`,`a`.`barcode` AS `barcode`,`a`.`type` AS `type`,`a`.`name` AS `name`,`a`.`fk_categories` AS `fk_categories`,`b`.`description` AS `category`,`a`.`fk_supplier` AS `fk_supplier`,`c`.`fullname` AS `supplier`,`a`.`cost` AS `cost`,`a`.`tax` AS `tax`,`a`.`uom` AS `uom`,`a`.`alertqty` AS `alertqty`,`a`.`pictx` AS `pictx`,`a`.`background` AS `background`,`a`.`remarks` AS `remarks`,`a`.`stat` AS `stat`,`d`.`fk_stores` AS `fk_stores`,`d`.`price` AS `price`,`d`.`oldprice` AS `oldprice`,`d`.`discount` AS `discount`,`d`.`olddiscount` AS `olddiscount`,`f`.`fk_stores` AS `fk_storesvisibility`,`UDF_GETSTORENAME`(`f`.`fk_stores`) AS `storename`,((`UDF_GETLASTQTYADJ`(`a`.`pk_products`,`f`.`fk_stores`) - `UDF_GETLASTQTYSALES`(`a`.`pk_products`,`f`.`fk_stores`)) - `UDF_GETLASTQTYSALESCOMPOSITIONS`(`a`.`pk_products`,`f`.`fk_stores`)) AS `qty` from (((((`products` `a` left join `categories` `b` on((`a`.`fk_categories` = `b`.`pk_categories`))) left join `persons` `c` on((`a`.`fk_supplier` = `c`.`pk_persons`))) left join `productsprices` `d` on((`d`.`fk_products` = `a`.`pk_products`))) left join `stores` `e` on((`d`.`fk_stores` = `e`.`pk_stores`))) left join `productsstore` `f` on((`f`.`fk_products` = `a`.`pk_products`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_productsmstr`
--

/*!50001 DROP VIEW IF EXISTS `vw_productsmstr`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_productsmstr` AS select `a`.`pk_products` AS `pk_products`,`a`.`type` AS `type`,`a`.`barcode` AS `barcode`,`a`.`name` AS `name`,`a`.`fk_categories` AS `fk_categories`,`b`.`description` AS `category`,`a`.`fk_supplier` AS `fk_supplier`,`c`.`fullname` AS `supplier`,`a`.`cost` AS `cost`,`a`.`tax` AS `tax`,`a`.`uom` AS `uom`,`a`.`alertqty` AS `alertqty`,`a`.`pictx` AS `pictx`,`a`.`background` AS `background`,`a`.`remarks` AS `remarks`,coalesce(`a`.`stat`,0) AS `stat` from ((`products` `a` left join `categories` `b` on((`a`.`fk_categories` = `b`.`pk_categories`))) left join `persons` `c` on((`a`.`fk_supplier` = `c`.`pk_persons`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_salesdtl`
--

/*!50001 DROP VIEW IF EXISTS `vw_salesdtl`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_salesdtl` AS select `a`.`fk_salesmstr` AS `fk_salesmstr`,`a`.`fk_products` AS `fk_products`,`b`.`name` AS `name`,`a`.`qty` AS `qty`,`a`.`qty` AS `oldqty`,coalesce(`a`.`uom`,'') AS `uom`,`a`.`unitprice` AS `unitprice`,`a`.`unitcost` AS `unitcost`,`a`.`totalamount` AS `totalamount`,`a`.`discrate` AS `discrate`,`a`.`discamount` AS `discamount`,`a`.`netamount` AS `netamount`,`a`.`vatable` AS `vatable`,`a`.`vatamount` AS `vatamount` from (`salesdtls` `a` join `products` `b` on((`a`.`fk_products` = `b`.`pk_products`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_salesmstr`
--

/*!50001 DROP VIEW IF EXISTS `vw_salesmstr`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013  SQL SECURITY DEFINER */
/*!50001 VIEW `vw_salesmstr` AS select `a`.`pk_salesmstr` AS `pk_salesmstr`,`a`.`fk_stores` AS `fk_stores`,`b`.`name` AS `storename`,`a`.`docdate` AS `docdate`,`a`.`docno` AS `docno`,`a`.`doctype` AS `doctype`,`a`.`fk_trxno` AS `fk_trxno`,`a`.`fk_discounts` AS `fk_discounts`,`c`.`description` AS `discountname`,`a`.`discrate` AS `discrate`,`a`.`fk_persons` AS `fk_persons`,`d`.`fullname` AS `customername`,`d`.`tinno` AS `tinno`,`d`.`address` AS `address`,`a`.`payername` AS `payername`,concat(`a`.`docno`,' -- ',`a`.`payername`,', ',convert(date_format(`a`.`docdate`,'%b %d, %Y') using latin1)) AS `trxdescription`,`a`.`remarks` AS `remarks`,`a`.`totalitem` AS `totalitem`,`a`.`totalqty` AS `totalqty`,`a`.`totalamount` AS `totalamount`,`a`.`totaldisc` AS `totaldisc`,`a`.`companyvat` AS `companyvat`,`a`.`vatable` AS `vatable`,`a`.`vatexcempt` AS `vatexcempt`,`a`.`zerorated` AS `zerorated`,`a`.`vatamount` AS `vatamount`,`a`.`netamount` AS `netamount`,`udf_getTotalPaymentPerSales`(`a`.`pk_salesmstr`) AS `totalpayment`,(`a`.`netamount` - `udf_getTotalPaymentPerSales`(`a`.`pk_salesmstr`)) AS `changeamount`,`a`.`created_at` AS `created_at`,`a`.`fk_createdby` AS `fk_createdby`,`e`.`name` AS `cashiername`,`a`.`iscancel` AS `iscancel`,`a`.`cancel_at` AS `cancel_at`,coalesce(`a`.`stat`,0) AS `stat`,`udf_getPaymentStat`(`a`.`pk_salesmstr`) AS `paymentstat` from ((((`salesmstr` `a` left join `stores` `b` on((`a`.`fk_stores` = `b`.`pk_stores`))) left join `discounts` `c` on((`a`.`fk_discounts` = `c`.`pk_discounts`))) left join `persons` `d` on((`a`.`fk_persons` = `d`.`pk_persons`))) left join `users` `e` on((`a`.`fk_createdby` = `e`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-08  0:53:10
