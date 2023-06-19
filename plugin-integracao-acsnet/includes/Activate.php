<?php

namespace PIACS;
use PIACS\Database;

defined( 'ABSPATH' ) || exit;

class Activate{
	
	protected function __construct(){
	}

	public static function activate(){
		
		self::createTableConfigs();
		self::createTableConfigsMemory();

		self::createTableTokens();

		self::createTableActiveCategories();

		self::createTableLogs();

		self::createTableOrderId();
		self::createTableNfe();


		flush_rewrite_rules();
	}

	public static function createTableConfigs(){
		$sql = "
			CREATE TABLE `%table%` (
				`key` VARCHAR(20) NOT NULL,
				`value` VARCHAR(100) NULL,
			  	`ts` TIMESTAMP NOT NULL,
				PRIMARY KEY (`key`),
				UNIQUE (`key`))
			ENGINE = InnoDB;
		";
		Database::createTable('configs', $sql, false);

	}

	public static function createTableConfigsMemory(){

		$sql = "
			CREATE TABLE `%table%` (
				`key` CHAR(20) NOT NULL,
				`value` CHAR(100) NULL,
			  	`ts` TIMESTAMP NOT NULL,
				PRIMARY KEY (`key`),
				UNIQUE (`key`))
			ENGINE = memory;
		";
		Database::createTable('configs_memory', $sql, false);		
	}

	public static function createTableTokens(){
		$sql = "
			CREATE TABLE `%table%` (
			  `token` VARCHAR(60) NOT NULL,
			  `life` TIMESTAMP NOT NULL,
			  PRIMARY KEY (`token`))
			ENGINE = MEMORY;
		";
		Database::createTable('tokens', $sql, true);
	}

	public static function createTableActiveCategories(){
		$sql = "
			CREATE TABLE `%table%` (
			  `category_id` BIGINT NOT NULL,
			  PRIMARY KEY (`category_id`))
			ENGINE = InnoDB;
		";
		Database::createTable('active_categories', $sql, true);
	}

	public static function createTableLogs(){
		$sql = "
			CREATE TABLE `%table%` (
			  `id` BIGINT NOT NULL AUTO_INCREMENT,
			  `request` TEXT,
			  `response` TEXT,
			  `code` VARCHAR(3),
			  `ts` TIMESTAMP NOT NULL,
			  PRIMARY KEY (`id`))
			ENGINE = InnoDB;
		";
		Database::createTable('logs', $sql, true);
	}

	public static function createTableNfe(){
		$sql = "
			CREATE TABLE `%table%` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`order_id` INT NOT NULL,
				`Serial` VARCHAR(20) NULL,
				`NumberNfe` VARCHAR(20) NULL,
				`NumberOrder` VARCHAR(20) NULL,
				`DocXml` MEDIUMBLOB NULL,
				`DocPdf` MEDIUMBLOB NULL,
				`ts` TIMESTAMP NOT NULL,
			  PRIMARY KEY (`id`))	
			ENGINE = InnoDB;
		";
		Database::createTable('nfe', $sql, true);
	}


	public static function createTableOrderId(){
		$sql = "
			CREATE TABLE `%table%` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`order_id` INT NOT NULL,
				`acs_order_id` CHAR(36) NULL,
				`OrderType` VARCHAR(45) NULL,
			  	`ts` TIMESTAMP NOT NULL,
				PRIMARY KEY (`id`))
			ENGINE = InnoDB;
		";
		Database::createTable('orders_id', $sql, false);

	}

}