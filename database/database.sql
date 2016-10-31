
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(70) NOT NULL,
  `created` datetime NOT NULL,
  `active` smallint(5) UNSIGNED NOT NULL,
  `resume` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `logintype` varchar(50) NOT NULL,
  `externalid` varchar(255) NOT NULL,
  `subscription` char(1) NOT NULL,
  `lastvisit` datetime NOT NULL
) DEFAULT CHARSET=utf8;
