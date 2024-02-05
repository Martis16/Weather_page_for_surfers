

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- Sukurta duomenų struktūra lentelei `users`

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('Valdytojas', '16c354b68848cdbd8f54a226a0a55b21', '7ed2b87b255a0348b61226bd7c2ed5b4', 5, 'demo@ktu.lt', 1330553708),
('Administratorius', '16c354b68848cdbd8f54a226a0a55b21', 'a2fe399900de341c39c632244eaf8483', 9, 'demo@ktu.lt', 1330553956),
('Vartotojas', '16c354b68848cdbd8f54a226a0a55b21', '9a47f4552955b91bcd8850d73b00e703', 1, 'demo@ktu.lt', 1330553730);
