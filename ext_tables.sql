#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_fed_page_flexform text NOT NULL,
	tx_fed_page_flexform_sub text NOT NULL,
	tx_fed_page_controller_action varchar(255) DEFAULT '' NOT NULL,
        tx_fed_page_flexform_override tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_fed_page_controller_action_sub varchar(255) DEFAULT '' NOT NULL,
        tx_fed_page_flexform_override_sub tinyint(4) unsigned DEFAULT '0' NOT NULL,
);