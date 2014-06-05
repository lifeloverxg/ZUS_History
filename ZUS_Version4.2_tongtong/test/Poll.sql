CREATE DATABASE  IF NOT EXISTS `dbzus` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbzus`;

DROP TABLE IF EXISTS `event_new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_new` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `gowner` int(10) unsigned DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `repeat_type` smallint(6) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `category` int(10) unsigned DEFAULT NULL,
  `size` int(10) unsigned NOT NULL,
  `tag` varchar(200) DEFAULT NULL,
  `price` varchar(45) DEFAULT 'free',
  `vote_num` int(10) unsigned DEFAULT 0,
  `verify` tinyint(4) NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `geolabel` varchar(50) DEFAULT NULL,
  `privacy` smallint(6) NOT NULL,
  `album` int(11) DEFAULT NULL,
  `issale` int(11) NOT NULL DEFAULT '0',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `eid_UNIQUE` (`eid`),
  KEY `cate_index` (`category`),
  KEY `priv_index` (`privacy`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `people2poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people2poll` (
  `pid` int(10) unsigned NOT NULL,
  `eid` int(10) unsigned NOT NULL,
  `role` smallint(5) unsigned NOT NULL COMMENT 'describe the attendance of a user to that event\n0: none\n1: invited\n2: attend\n3: owner',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`,`eid`),
  KEY `user_status_index` (`pid`,`role`),
  KEY `event_status_index` (`eid`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TRIGGER IF EXISTS votecount;
DELIMITER $$
CREATE TRIGGER votecount
AFTER INSERT ON people2poll
FOR EACH ROW BEGIN
UPDATE event_new
  SET vote_num = vote_num + 1 
  WHERE eid = NEW.eid;
END;
$$
DELIMITER ;

DROP TABLE IF EXISTS `comments_poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments_poll` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `gowner` int(10) unsigned DEFAULT NULL,
  `comment_time` datetime NOT NULL,
  `eid` int(10) unsigned NOT NULL,
  `comment` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid_UNIQUE` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;