<?php

namespace Core;

use Core\Constants\Path;
use eftec\bladeone\BladeOne;

class View
{
	private $template;
	public function __construct()
	{
		$views = Path::$ROOT_DIR . '/App/views';
		$cache = Path::$ROOT_DIR . '/public/cache';

		$this->template = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
	}

	public function render($view, $variables)
	{
		return $this->template->run($view, $variables);
	}
}