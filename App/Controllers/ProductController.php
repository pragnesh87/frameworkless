<?php

namespace App\Controllers;

use App\Repository\ProductRepository;
use Core\Controller;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class ProductController extends Controller
{
	protected $product;
	public function __construct()
	{
		$this->product = new ProductRepository($this->conn());
		parent::__construct();
	}

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
			->from('products');

		$data = $res->executeQuery()->fetchAllAssociative();
		//$data = $res->execute()->fetchAll();
		return $this->json($data);
	}

	public function dbalData()
	{
		$data = $this->product->getAll();
		return $this->json($data);
	}
}
