<?php

namespace Core;

use Whoops\Run;
use Monolog\Logger;
use FilesystemIterator;
use League\Route\Router;
use League\Container\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Whoops\Handler\PrettyPageHandler;
use League\Container\ReflectionContainer;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
	public static App $app;
	public DB $db;
	private string $config_path = '../Config';
	public $config;
	public ServerRequestInterface $request;
	public ResponseInterface $response;
	public Logger $logger;
	public Container $container;
	public Router $router;

	public function __construct()
	{
		$this->initConfig();
		$this->initContainer();

		$this->initLogger();
		$this->initErrorHandler();

		$this->initRouter();

		$this->connectDB();
		$this->initRequest();
		self::$app = $this;
	}

	private function initConfig(): void
	{
		$files = new FilesystemIterator($this->config_path);

		foreach ($files as $file) {
			$name = pathinfo($file->getFilename(), PATHINFO_FILENAME);
			$this->config[$name] = include($file->getPathname());
		}
	}

	private function connectDB()
	{
		$con = array_get($this->config, 'database.default');
		$connection = "database.connections.${con}";
		$db_connection = array_get($this->config, $connection);

		$this->db = new DB($db_connection);
	}

	private function initRequest()
	{
		$this->request = ServerRequestFactory::fromGlobals(
			$_SERVER,
			$_GET,
			$_POST,
			$_COOKIE,
			$_FILES
		);
	}

	private function initLogger()
	{
		$this->logger = new Logger('MyApp');
		$formatter = new LineFormatter();
		$handler = new StreamHandler("../logs/error.log");
		$handler->setFormatter($formatter);
		$this->logger->pushHandler($handler);
	}

	private function initErrorHandler()
	{
		$whoops = new Run;
		if ($_ENV['APP_ENV'] === 'dev') {
			$whoops->pushHandler(
				new PrettyPageHandler()
			);
		} else {
			$whoops->pushHandler(function ($exception, $inspector, $run) {
				$this->logger->error($exception->getMessage());
			});
		}
		$whoops->register();
	}

	private function initContainer()
	{
		$this->container = new Container();
		$this->container
			->delegate(
				// Auto-wiring based on constructor typehints.
				// http://container.thephpleague.com/auto-wiring
				new ReflectionContainer()
			);
	}

	private function initRouter()
	{
		$this->router = new Router();
	}

	public function run()
	{
		$this->response = $this->router->dispatch($this->request);
		(new SapiEmitter())->emit($this->response);
	}

	public function get($path, $handler)
	{
		$this->router->map('GET', $path, $handler);
	}

	public function post($path, $handler)
	{
		$this->router->map('POST', $path, $handler);
	}
}