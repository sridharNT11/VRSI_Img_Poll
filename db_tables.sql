CREATE TABLE `image_poll_sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_title` varchar(45) DEFAULT NULL,
  `session_active` tinyint(2) DEFAULT NULL,
  `session_key` VARCHAR(5) NULL DEFAULT NULL
  `session_start` datetime DEFAULT NULL,
  `session_end` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE `image_poll` (
  `image_poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`image_poll_id`),
  KEY `fk_quiz_1_idx` (`session_id`),
  CONSTRAINT `fk_quiz` FOREIGN KEY (`session_id`) REFERENCES `image_poll_sessions` (`session_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



CREATE TABLE `image_poll_users` (
  `ipu_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `image_poll_id` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ipu_id`),
  KEY `fk1_idx` (`session_id`),
  KEY `fk2_idx` (`user_id`),
  KEY `fk3_idx` (`image_poll_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`session_id`) REFERENCES `image_poll_sessions` (`session_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk3` FOREIGN KEY (`image_poll_id`) REFERENCES `image_poll` (`image_poll_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




