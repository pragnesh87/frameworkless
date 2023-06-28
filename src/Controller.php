<?php

namespace Core;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;

class Controller
{
	private $view;
	public function __construct()
	{
		$this->view = new View;
	}
	public function render($view, $vars = [])
	{
		$html = $this->view->render($view, $vars);
		return new HtmlResponse($html);
	}

	public function json($data, int $status = 200, array $headers = [])
	{
		return new JsonResponse($data, $status, $headers);
	}

	public function builder()
	{
		return App::$app->db->builder();
	}

	public function conn()
	{
		return App::$app->db->connection();
	}
}
