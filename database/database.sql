CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(70) NOT NULL,
  `created` datetime NOT NULL,
  `active` smallint(5) unsigned NOT NULL,
  `resume` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `logintype` varchar(50) NOT NULL,
  `externalid` varchar(255) NOT NULL,
  `subscription` char(1) NOT NULL,
  `lastvisit` datetime NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created`, `active`, `resume`, `image`, `logintype`, `externalid`, `subscription`, `lastvisit`) VALUES
(1, 'Administrator', 'admin', 'PLAIN:admin', '2016-11-03 00:00:00', 1, NULL, '', 'site', '', 'n', NULL);