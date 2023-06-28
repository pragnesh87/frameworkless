<?php

namespace Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DB
{
	private $conn;
	public function __construct($config)
	{
		$this->connect($config);
	}

	public function connect($config): Connection
	{
		$this->conn = DriverManager::getConnection($config);
		return $this->conn;
	}

	public function builder()
	{
		return $this->conn->createQueryBuilder();
	}

	public function connection()
	{
		return $this->conn;
	}
}
