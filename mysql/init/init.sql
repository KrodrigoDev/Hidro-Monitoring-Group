-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hidro_web
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `atributo`
--

DROP TABLE IF EXISTS `atributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atributo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `equipamento_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `equipamento_id` (`equipamento_id`),
  CONSTRAINT `atributo_ibfk_1` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atributo`
--

LOCK TABLES `atributo` WRITE;
/*!40000 ALTER TABLE `atributo` DISABLE KEYS */;
/*!40000 ALTER TABLE `atributo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao` text,
  `segmento` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamento`
--

DROP TABLE IF EXISTS `equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `tipo_id` int NOT NULL,
  `atributo_id` int DEFAULT NULL,
  `unidade_empresa_id` int DEFAULT NULL,
  `local_id` int DEFAULT NULL,
  `situacao_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tipo_id` (`tipo_id`),
  KEY `situacao_id` (`situacao_id`),
  KEY `unidade_empresa_id` (`unidade_empresa_id`),
  KEY `local_id` (`local_id`),
  CONSTRAINT `equipamento_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_equipamento` (`id`),
  CONSTRAINT `equipamento_ibfk_2` FOREIGN KEY (`situacao_id`) REFERENCES `situacao` (`id`),
  CONSTRAINT `equipamento_ibfk_3` FOREIGN KEY (`unidade_empresa_id`) REFERENCES `unidade_empresa` (`id`),
  CONSTRAINT `equipamento_ibfk_4` FOREIGN KEY (`local_id`) REFERENCES `local_equipamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamento`
--

LOCK TABLES `equipamento` WRITE;
/*!40000 ALTER TABLE `equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cod_ibge` int NOT NULL,
  `sigla` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Rondônia',11,'RO'),(2,'Acre',12,'AC'),(3,'Amazonas',13,'AM'),(4,'Roraima',14,'RR'),(5,'Pará',15,'PA'),(6,'Amapá',16,'AP'),(7,'Tocantins',17,'TO'),(8,'Maranhão',21,'MA'),(9,'Piauí',22,'PI'),(10,'Ceará',23,'CE'),(11,'Rio Grande do Norte',24,'RN'),(12,'Paraíba',25,'PB'),(13,'Pernambuco',26,'PE'),(14,'Alagoas',27,'AL'),(15,'Sergipe',28,'SE'),(16,'Bahia',29,'BA'),(17,'Minas Gerais',31,'MG'),(18,'Espírito Santo',32,'ES'),(19,'Rio de Janeiro',33,'RJ'),(20,'São Paulo',35,'SP'),(21,'Paraná',41,'PR'),(22,'Santa Catarina',42,'SC'),(23,'Rio Grande do Sul',43,'RS'),(24,'Mato Grosso do Sul',50,'MS'),(25,'Mato Grosso',51,'MT'),(26,'Goiás',52,'GO'),(27,'Distrito Federal',53,'DF');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local_equipamento`
--

DROP TABLE IF EXISTS `local_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `local_equipamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `municipio_id` int NOT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipio_id` (`municipio_id`),
  CONSTRAINT `local_equipamento_ibfk_1` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_equipamento`
--

LOCK TABLES `local_equipamento` WRITE;
/*!40000 ALTER TABLE `local_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `local_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_equipamento`
--

DROP TABLE IF EXISTS `log_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_equipamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipamento_id` int NOT NULL,
  `usuario_unidade_id` int NOT NULL,
  `acao` enum('CREATE','UPDATE','DELETE','MOVIMENTO') NOT NULL,
  `descricao` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `equipamento_id` (`equipamento_id`),
  KEY `usuario_unidade_id` (`usuario_unidade_id`),
  CONSTRAINT `log_equipamento_ibfk_1` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`),
  CONSTRAINT `log_equipamento_ibfk_2` FOREIGN KEY (`usuario_unidade_id`) REFERENCES `usuario_unidade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_equipamento`
--

LOCK TABLES `log_equipamento` WRITE;
/*!40000 ALTER TABLE `log_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_usuario`
--

DROP TABLE IF EXISTS `log_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_criador_id` int NOT NULL,
  `usuario_criado_id` int NOT NULL,
  `unidade_empresa_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_criador_id` (`usuario_criador_id`),
  KEY `usuario_criado_id` (`usuario_criado_id`),
  KEY `unidade_empresa_id` (`unidade_empresa_id`),
  CONSTRAINT `log_usuario_ibfk_1` FOREIGN KEY (`usuario_criador_id`) REFERENCES `usuario_unidade` (`id`),
  CONSTRAINT `log_usuario_ibfk_2` FOREIGN KEY (`usuario_criado_id`) REFERENCES `usuario_base` (`id`),
  CONSTRAINT `log_usuario_ibfk_3` FOREIGN KEY (`unidade_empresa_id`) REFERENCES `unidade_empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_usuario`
--

LOCK TABLES `log_usuario` WRITE;
/*!40000 ALTER TABLE `log_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `cod_ibge` varchar(10) NOT NULL,
  `estado_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cod_ibge` (`cod_ibge`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,'Água Branca','2700102',27),(2,'Canapi','2701605',27),(3,'Delmiro Gouveia','2702405',27),(4,'Inhapi','2703304',27),(5,'Mata Grande','2705002',27),(6,'Olho d\'Água do Casado','2705804',27),(7,'Pariconha','2706422',27),(8,'Piranhas','2707107',27),(9,'Carneiros','2701803',27),(10,'Dois Riachos','2702504',27),(11,'Jacaré dos Homens','2703403',27),(12,'Maravilha','2704609',27),(13,'Monteirópolis','2705408',27),(14,'Olho d\'Água das Flores','2705705',27),(15,'Olivença','2706000',27),(16,'Ouro Branco','2706109',27),(17,'Palestina','2706208',27),(18,'Pão de Açúcar','2706406',27),(19,'Poço das Trincheiras','2707206',27),(20,'Santana do Ipanema','2708006',27),(21,'São José da Tapera','2708402',27),(22,'Senador Rui Palmeira','2708956',27),(23,'Belém','2700805',27),(24,'Cacimbinhas','2701209',27),(25,'Chã Preta','2701902',27),(26,'Estrela de Alagoas','2702553',27),(27,'Igaci','2703106',27),(28,'Major Isidoro','2704401',27),(29,'Maribondo','2704807',27),(30,'Mar Vermelho','2704906',27),(31,'Minador do Negrão','2705309',27),(32,'Palmeira dos Índios','2706307',27),(33,'Paulo Jacinto','2706604',27),(34,'Pindoba','2707008',27),(35,'Quebrangulo','2707602',27),(36,'Tanque d\'Arca','2709004',27),(37,'Viçosa','2709400',27),(38,'Arapiraca','2700300',27),(39,'Batalha','2700706',27),(40,'Belo Monte','2700904',27),(41,'Campo Grande','2701506',27),(42,'Coité do Nóia','2702009',27),(43,'Craíbas','2702355',27),(44,'Feira Grande','2702603',27),(45,'Girau do Ponciano','2702900',27),(46,'Jaramataia','2703700',27),(47,'Lagoa da Canoa','2704104',27),(48,'Limoeiro de Anadia','2704203',27),(49,'São Sebastião','2708808',27),(50,'Taquarana','2709103',27),(51,'Traipu','2709202',27),(52,'Feliz Deserto','2702702',27),(53,'Igreja Nova','2703205',27),(54,'Olho d\'Água Grande','2705903',27),(55,'Penedo','2706703',27),(56,'Piaçabuçu','2706802',27),(57,'Porto Real do Colégio','2707503',27),(58,'São Brás','2708204',27),(59,'Anadia','2700201',27),(60,'Boca da Mata','2701001',27),(61,'Campo Alegre','2701407',27),(62,'Coruripe','2702306',27),(63,'Jequiá da Praia','2703759',27),(64,'Junqueiro','2704005',27),(65,'Roteiro','2707800',27),(66,'São Miguel dos Campos','2708600',27),(67,'Teotônio Vilela','2709152',27),(68,'Barra de Santo Antônio','2700508',27),(69,'Barra de São Miguel','2700607',27),(70,'Coqueiro Seco','2702207',27),(71,'Maceió','2704302',27),(72,'Marechal Deodoro','2704708',27),(73,'Messias','2705200',27),(74,'Paripueira','2706448',27),(75,'Pilar','2706901',27),(76,'Rio Largo','2707701',27),(77,'Santa Luzia do Norte','2707909',27),(78,'Satuba','2708907',27),(79,'Atalaia','2700409',27),(80,'Branquinha','2701100',27),(81,'Cajueiro','2701308',27),(82,'Capela','2701704',27),(83,'Flexeiras','2702801',27),(84,'Ibateguara','2703007',27),(85,'Joaquim Gomes','2703809',27),(86,'Murici','2705507',27),(87,'Santana do Mundaú','2708105',27),(88,'São José da Laje','2708303',27),(89,'União dos Palmares','2709301',27),(90,'Campestre','2701357',27),(91,'Colônia Leopoldina','2702108',27),(92,'Jacuípe','2703502',27),(93,'Japaratinga','2703601',27),(94,'Jundiá','2703908',27),(95,'Maragogi','2704500',27),(96,'Matriz de Camaragibe','2705101',27),(97,'Novo Lino','2705606',27),(98,'Passo de Camaragibe','2706505',27),(99,'Porto Calvo','2707305',27),(100,'Porto de Pedras','2707404',27),(101,'São Luís do Quitunde','2708501',27),(102,'São Miguel dos Milagres','2708709',27);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` enum('Visualizador','Operador','Gestor') NOT NULL,
  `nivel` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `permissao_chk_1` CHECK ((`nivel` in (1,2,3)))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao`
--

LOCK TABLES `permissao` WRITE;
/*!40000 ALTER TABLE `permissao` DISABLE KEYS */;
INSERT INTO `permissao` VALUES (1,'Visualizador',1,'2025-09-21 17:25:27','2025-09-21 17:25:27'),(2,'Operador',2,'2025-09-21 17:25:27','2025-09-21 17:25:27'),(3,'Gestor',3,'2025-09-21 17:25:27','2025-09-21 17:25:27');
/*!40000 ALTER TABLE `permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situacao`
--

DROP TABLE IF EXISTS `situacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `situacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situacao`
--

LOCK TABLES `situacao` WRITE;
/*!40000 ALTER TABLE `situacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `situacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_equipamento`
--

DROP TABLE IF EXISTS `tipo_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_equipamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_equipamento`
--

LOCK TABLES `tipo_equipamento` WRITE;
/*!40000 ALTER TABLE `tipo_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidade_empresa`
--

DROP TABLE IF EXISTS `unidade_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidade_empresa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `municipio_id` int NOT NULL,
  `empresa_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `municipio_id` (`municipio_id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `unidade_empresa_ibfk_1` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`),
  CONSTRAINT `unidade_empresa_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidade_empresa`
--

LOCK TABLES `unidade_empresa` WRITE;
/*!40000 ALTER TABLE `unidade_empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidade_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_base`
--

DROP TABLE IF EXISTS `usuario_base`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_base` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cpf` char(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_base`
--

LOCK TABLES `usuario_base` WRITE;
/*!40000 ALTER TABLE `usuario_base` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_base` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_unidade`
--

DROP TABLE IF EXISTS `usuario_unidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_unidade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `unidade_empresa_id` int NOT NULL,
  `permissao_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acesso_extra` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`,`unidade_empresa_id`),
  KEY `unidade_empresa_id` (`unidade_empresa_id`),
  KEY `permissao_id` (`permissao_id`),
  CONSTRAINT `usuario_unidade_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario_base` (`id`),
  CONSTRAINT `usuario_unidade_ibfk_2` FOREIGN KEY (`unidade_empresa_id`) REFERENCES `unidade_empresa` (`id`),
  CONSTRAINT `usuario_unidade_ibfk_3` FOREIGN KEY (`permissao_id`) REFERENCES `permissao` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_unidade`
--

LOCK TABLES `usuario_unidade` WRITE;
/*!40000 ALTER TABLE `usuario_unidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_unidade` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-21 14:58:38
