<?php

namespace App\Controllers;

use Core\Controller;
use Core\DB;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class ProductController extends Controller
{
	/* public function __construct()
	{
		parent::__construct();
	} */

	public function index(ServerRequestInterface $request)
	{
		$response = new Response;
		$response->getBody()->write('<h1>Hello, World from controller</h1>');
		return $response;
	}

	public function data()
	{
		$data = [
			'abc' => 1,
			'xyz' => 10
		];
		return $this->json($data);
	}

	public function show()
	{
		$data['name'] = env('APP_NAME');
		return $this->render('products.index', $data);
	}

	public function dbData()
	{
		$builder = $this->builder();
		$res = $builder->select('id', 'description')
			->from('products')
			->where('id = 2');

		$data = $res->execute()->fetch();
		return $this->json($data);
	}
}