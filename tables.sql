CREATE TABLE `twstat_ctf` (
  `id` int(11) NOT NULL auto_increment,
  `player` varchar(100) character set latin1 default NULL,
  `flag_grab` int(11) default '0',
  `flag_capture` int(11) default '0',
  `flag_return` int(11) default '0',
  `flag_drop` int(11) default '0',
  `1` int(11) default '0' COMMENT 'special=1',
  `2` int(11) default '0' COMMENT 'special=2',
  `3` int(11) default '0' COMMENT 'special=3',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Structure for the `twstat_config` table :
#

CREATE TABLE `twstat_config` (
  `id` int(11) NOT NULL auto_increment,
  `ckey` varchar(50) default NULL,
  `cvalue` varchar(50) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Structure for the `twstat_maps` table :
#

CREATE TABLE `twstat_maps` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `used` int(11) default NULL,
  `kills` int(11) default NULL,
  `captured` int(11) default NULL,
  `dropped` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Structure for the `twstat_log_seek` table :
#

CREATE TABLE `twstat_log_seek` (
  `id` int(11) NOT NULL auto_increment,
  `log_name` varchar(100) default NULL,
  `log_position` int(20) default NULL,
  `hash` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Structure for the `twstat_players` table :
#

CREATE TABLE `twstat_players` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set latin1 default NULL,
  `kills` int(11) default '0',
  `death` int(11) default '0',
  `skill` int(11) default '1000',
  `hidden` int(11) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

#
# Structure for the `twstat_weapon` table :
#

CREATE TABLE `twstat_weapon` (
  `id` int(11) NOT NULL auto_increment,
  `player` varchar(100) character set latin1 default NULL,
  `0` int(11) default '0' COMMENT 'hammer',
  `1` int(11) default '0' COMMENT 'gun',
  `2` int(11) default '0' COMMENT 'shotgun',
  `3` int(11) default '0' COMMENT 'grenade',
  `4` int(11) default '0' COMMENT 'rifle',
  `5` int(11) default '0' COMMENT 'ninja',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


/* Data for the `twstat_config` table  (Records 1 - 2) */
INSERT INTO `twstat_config` (`id`, `ckey`, `cvalue`) VALUES
  (3, 'check_date', '0'),
  (4, 'admin', 'c4ca4238a0b923820dcc509a6f75849b');

COMMIT;
