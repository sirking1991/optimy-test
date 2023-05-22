<?php

namespace App\Utilities;

use Dotenv\Dotenv;

class DB
{
	private $pdo;

	private static $instance = null;

	private function __construct()
	{
		$dotenv = Dotenv::createImmutable(BASE_PATH);
		$dotenv->load();

		$dbHost = getenv('DB_HOST');
		$dbName = getenv('DB_NAME');
		$user = getenv('DB_USER');
		$password = getenv('DB_PASSWORD');
		
		$dsn = "mysql:dbname={$dbName};host={$dbHost}";

		$this->pdo = new \PDO($dsn, $user, $password);
	}

	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	public function select($sql)
	{
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll();
	}

	public function exec($sql)
	{
		return $this->pdo->exec($sql);
	}

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}