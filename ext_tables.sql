#
# Table structure for table 'tx_thomasnu_domain_model_content'
#
CREATE TABLE tx_thomasnu_domain_model_content (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	page int(11) NOT NULL default '0',
	sections int(11) NOT NULL default '0',

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_thomasnu_domain_model_section'
#
CREATE TABLE tx_thomasnu_domain_model_section (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	page int(11) NOT NULL default '0',
	section int(11) NOT NULL default '0',
	name varchar(64) NOT NULL default '',
	main text NOT NULL,
	margin text NOT NULL,
	bottom text NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_thomasnu_domain_model_news'
#
CREATE TABLE tx_thomasnu_domain_model_news (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	term int(11) unsigned NOT NULL default '0',
	endterm int(11) unsigned NOT NULL default '0',
	sort tinyint(3) unsigned NOT NULL default '0',
	category varchar(16) NOT NULL default '',
	subject varchar(64) NOT NULL default '',
	title varchar(64) NOT NULL default '',
	teaser text NOT NULL,
	margin text NOT NULL,
	portal varchar(64) NOT NULL default '',
	agenda text NOT NULL,
	link varchar(64) NOT NULL default '',

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_thomasnu_domain_model_mail'
#
CREATE TABLE tx_thomasnu_domain_model_mail (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	date int(11) unsigned default '0' NOT NULL,
	form varchar(16) default '' NOT NULL,
	hash varchar(64) default '' NOT NULL,
	subject varchar(64) default '' NOT NULL,
	content text NOT NULL,
	poster int(11) unsigned DEFAULT '0' NOT NULL,
	replies int(11) unsigned DEFAULT '0' NOT NULL,
	published tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_thomasnu_domain_model_poster'
#
CREATE TABLE tx_thomasnu_domain_model_poster (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(64) DEFAULT '' NOT NULL,
	email varchar(64) DEFAULT '' NOT NULL,
	web varchar(64) DEFAULT '' NOT NULL,
	subscript varchar(64) DEFAULT '' NOT NULL,
	identifier varchar(64) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_thomasnu_domain_model_gallery'
#
CREATE TABLE tx_thomasnu_domain_model_gallery (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	header varchar(32) NOT NULL default '',
	link varchar(32) NOT NULL default '',
	photos int(11) NOT NULL default '0',

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_thomasnu_domain_model_photo'
#
CREATE TABLE tx_thomasnu_domain_model_photo (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	gallery int(11) NOT NULL default '0',
	id varchar(16) NOT NULL default '',
	text text NOT NULL,
	caption text NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
);

