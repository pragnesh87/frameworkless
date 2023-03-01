<?php

declare(strict_types=1);


use Core\Constants\Path;
use App\Controllers\ProductController;

require '../vendor/autoload.php';

/*
 * Dotenv initialization
 */

Path::$ROOT_DIR = dirname(__DIR__);

try {
	\Dotenv\Dotenv::createUnsafeImmutable(Path::$ROOT_DIR)->load();
} catch (\Throwable $th) {
	trigger_error($th->getMessage());
}

$app = new Core\App();

$app->get('/', [ProductController::class, 'index']);
$app->get('/data', [ProductController::class, 'data']);
$app->get('/show', [ProductController::class, 'show']);
$app->get('/db', [ProductController::class, 'dbData']);

$app->run();