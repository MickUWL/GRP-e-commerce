-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: grp
-- ------------------------------------------------------
-- Server version	5.5.64-MariaDB

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
-- Table structure for table `Cart`
--

DROP TABLE IF EXISTS `Cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cart` (
  `idCustomers` int(11) NOT NULL,
  `Item_code` int(11) NOT NULL,
  `Price` decimal(4,2) NOT NULL,
  `Product_name` varchar(35) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cart`
--

LOCK TABLES `Cart` WRITE;
/*!40000 ALTER TABLE `Cart` DISABLE KEYS */;
INSERT INTO `Cart` VALUES (26,1,1.50,'Apple',1,1.50),(26,3,1.00,'Asparagus',1,1.00),(26,5,1.20,'Broccoli',4,4.80),(26,6,0.85,'Brussel sprouts',1,0.85);
/*!40000 ALTER TABLE `Cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customers` (
  `idCustomers` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`idCustomers`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customers`
--

LOCK TABLES `Customers` WRITE;
/*!40000 ALTER TABLE `Customers` DISABLE KEYS */;
INSERT INTO `Customers` VALUES (1,'','Test_email@gmail.com','testpass'),(2,'','Test_email1@gmail.com','testpass'),(4,'','testhash@gmail.com','*4AD47E08DAE2BD4F0977EED5D23DC901359DF617'),(5,'UKRI','Mick_murray2k@hotmail.com','*4AD47E08DAE2BD4F0977EED5D23DC901359DF617'),(7,'adsfa','','*D83628519C141CBD7E2C7293C264FE1511D83963'),(12,'dafdfa','dafdfasdfas@gmail.com','*87F172AA71A084002A9430DCBEE5ED22B6DA11E0'),(16,'','testinga@mail.com','*4AD47E08DAE2BD4F0977EED5D23DC901359DF617'),(17,'ab','adga@mail.com','*D094766861A62475DF6AE645F35C80A81DB6B9C3'),(18,'test1','testing@mail.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(20,'testing','testing@gmail.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(21,'test','test@mail.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(22,'test','test1@mail.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(23,'test','test2@mail.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(24,'testing','testing123@mail.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(25,'michael','testing@testing.com','*AC57754462B6D4C373263062D60EDC6E452E574D'),(26,'test','testing@testing.org','*AC57754462B6D4C373263062D60EDC6E452E574D');
/*!40000 ALTER TABLE `Customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order_has_Products`
--

DROP TABLE IF EXISTS `Order_has_Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Order_has_Products` (
  `Order_idOrder` int(11) NOT NULL,
  `Products_idProducts` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Order_idOrder`,`Products_idProducts`),
  KEY `fk_Order_has_Products_Products1_idx` (`Products_idProducts`),
  KEY `fk_Order_has_Products_Order_idx` (`Order_idOrder`),
  CONSTRAINT `fk_Order_has_Products_Order` FOREIGN KEY (`Order_idOrder`) REFERENCES `Order` (`idOrder`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_has_Products_Products1` FOREIGN KEY (`Products_idProducts`) REFERENCES `Products` (`idProducts`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order_has_Products`
--

LOCK TABLES `Order_has_Products` WRITE;
/*!40000 ALTER TABLE `Order_has_Products` DISABLE KEYS */;
/*!40000 ALTER TABLE `Order_has_Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `idOrder` int(6) NOT NULL AUTO_INCREMENT,
  `OrderDate` datetime NOT NULL,
  `Shipped_date` datetime DEFAULT NULL,
  `Customers_idCustomers` int(11) NOT NULL,
  `Payment_details_idPayment_details` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (1,'2020-04-01 00:00:00',NULL,1,NULL),(2,'2020-04-01 00:00:00',NULL,26,NULL);
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Payment_details`
--

DROP TABLE IF EXISTS `Payment_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Payment_details` (
  `idPayment_details` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` date NOT NULL,
  `Card_type` varchar(20) NOT NULL,
  `Card_no` varchar(16) NOT NULL,
  `Expiry_month` varchar(2) NOT NULL,
  `Expiry_year` varchar(4) NOT NULL,
  `Issue_no` varchar(3) DEFAULT NULL,
  `Security_no` varchar(3) NOT NULL,
  `First_name` varchar(45) NOT NULL,
  `Last_name` varchar(45) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  `house_name_no` varchar(45) NOT NULL,
  PRIMARY KEY (`idPayment_details`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Payment_details`
--

LOCK TABLES `Payment_details` WRITE;
/*!40000 ALTER TABLE `Payment_details` DISABLE KEYS */;
INSERT INTO `Payment_details` VALUES (1,'0000-00-00','Amex','1234567890123456','01','2020','123','234','fname','lname','bt422ws','2'),(2,'2020-03-10','Visa','1234567890111111','02','2020','123','234','2nd','2ndtest','bt455ew','3');
/*!40000 ALTER TABLE `Payment_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `idProducts` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Vendor` varchar(45) NOT NULL,
  `Prod_description` varchar(255) DEFAULT NULL,
  `QtyInStock` int(11) DEFAULT NULL,
  `sell_price` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`idProducts`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'Apple','Granny Smith','Pack of 4 British apples',30,1.50),(2,'Apricot','Fresh fruits','Pack of 2 Apricots',25,1.00),(3,'Asparagus','Portwood','Pack of 10 Asparagus',40,1.00),(4,'Banana','Fyffes','Pack of 4 Bananas',30,1.00),(5,'Broccoli','John Saul Farms','500g bag',15,1.20),(6,'Brussel Sprouts','Redmere Farms','500g bag',25,0.85),(7,'Carrots','Redmere Farms','1000g bundle',38,0.90),(8,'Cauliflower','Fresh UK','900g each',20,0.90),(9,'Celery','Nightingale Farms','350g bag',22,0.65),(10,'Cucumber','Fresh UK','700g each',30,0.75),(11,'Grapes','Grape Direct','250g Seedless grapes',18,1.00),(12,'Lettuce','Nightingale Farms','500g Iceberg Lettuce',15,0.85),(13,'Potatoes','John Saul Farms','1200g bag',30,1.00),(14,'Strawberries','Berry Gardens','200g box',32,1.00),(15,'Tomatoes','Fresh UK','360g box',25,0.95),(16,'Oranges','Fresh fruits',' Pack of 3 oranges',40,0.75),(17,'Green Peas','Birds eye','500g bag frozen',50,1.00),(18,'Pineapple','Fresh fruits','1 large pineapple',15,1.20),(19,'Mango','Fresh fruits','Individual mango',25,1.00),(20,'Blueberries','Rosedene farms','200g box',25,1.50),(21,'Mixed fruit basket large','various','mixed fruit basket',10,7.00),(22,'Mixed fruit basket small','various','mixed fruit basket',10,3.20),(23,'Apple basket','Granny Smith','approx 20 apples',10,4.00),(24,'Orange basket','Fresh fruits','approx 20 oranges',10,4.00);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_details`
--

DROP TABLE IF EXISTS `delivery_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_details` (
  `idDelivery_address` int(11) NOT NULL AUTO_INCREMENT,
  `name_no` varchar(20) NOT NULL,
  `line_1` varchar(45) NOT NULL,
  `line_2` varchar(45) DEFAULT NULL,
  `Town_City` varchar(45) NOT NULL,
  `Region` varchar(45) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  `del_time` varchar(2) DEFAULT NULL,
  `del_date` date NOT NULL,
  `del_instructions` varchar(255) DEFAULT NULL,
  `Customers_idCustomers` int(11) NOT NULL,
  PRIMARY KEY (`idDelivery_address`,`Customers_idCustomers`),
  UNIQUE KEY `idDelivery_address_UNIQUE` (`idDelivery_address`),
  KEY `fk_Delivery_address_Customers1_idx` (`Customers_idCustomers`),
  CONSTRAINT `fk_Delivery_address_Customers1` FOREIGN KEY (`Customers_idCustomers`) REFERENCES `Customers` (`idCustomers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_details`
--

LOCK TABLES `delivery_details` WRITE;
/*!40000 ALTER TABLE `delivery_details` DISABLE KEYS */;
INSERT INTO `delivery_details` VALUES (3,'test1','test1','test2','testtown','testregion','testpc','','0000-00-00','Leave by door or ring back door...',2),(4,'test1','test1','test2','testtown','testregion','testpc','AM','0000-00-00','Leave by door or ring back door...',2),(5,'test1','test1','test2','testtown','testregion','testpc','AM','0000-00-00','Leave by door or ring back door...',2),(6,'test1','test1','test2','testtown','testregion','testpc','AM','0000-00-00','Leave by door or ring back door...',2),(7,'test1','test1','test2','testtown','testregion','testpc','AM','0000-00-00','Leave by door or ring back door...',2),(8,'test1','test1','test2','testtown','testregion','testpc','AM','2020-01-01','Leave by door or ring back door...',2),(9,'test1','test1','test2','testtown','testregion','testpc','AM','2020-06-18','Leave by door or ring back door...',2);
/*!40000 ALTER TABLE `delivery_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-07 15:24:16
