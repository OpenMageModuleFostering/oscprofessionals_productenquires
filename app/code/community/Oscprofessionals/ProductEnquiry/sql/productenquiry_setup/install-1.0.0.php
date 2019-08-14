<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */	
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();
$installer->run("
DROP TABLE IF EXISTS `{$installer->getTable('productenquiry')}`;
CREATE TABLE `{$installer->getTable('productenquiry')}` (
  `model_id` int(11) unsigned NOT NULL auto_increment COMMENT 'Model ID',
  `product_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  `customer_id` int(11) default NULL,
  `email` varchar(150) default NULL COMMENT 'Email Address',
  `question` text default NULL,
  `comment` text default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `is_approved` int(11) default 0,
  `product_name` varchar(255)  default NULL,
  PRIMARY KEY  (`model_id`)	
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;");
$installer->endSetup();