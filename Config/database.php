<?php

return [
	'default' => env('DB_CONNECTION', 'mysql'),
	'connections' => [
		'mysql' => [
			'driver' => 'pdo_mysql',
			'host' => env('DB_HOST', '127.0.0.1'),
			'port' => env('DB_PORT', '3306'),
			'dbname' => env('DB_DATABASE', 'fwless'),
			'user' => env('DB_USERNAME', 'fwless'),
			'password' => env('DB_PASSWORD', ''),
		],
		'sqllite' => [
			'driver' => 'pdo_sqlite',
			'user' => env('DB_USERNAME', 'fwless'),
			'password' => env('DB_PASSWORD', ''),
			//'path' => env('DB_SQLITE_PATH', 'database.sqlite3'),
			'memory' => true,
			//boolean
		],
		'pgsql' => [
			'driver' => 'pdo_pgsql',
			'host' => env('DB_HOST', '127.0.0.1'),
			'port' => env('DB_PORT', '5432'),
			'dbname' => env('DB_DATABASE', 'fwless'),
			'user' => env('DB_USERNAME', 'fwless'),
			'password' => env('DB_PASSWORD', ''),
		],
	],
];
