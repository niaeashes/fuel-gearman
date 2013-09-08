<?php

namespace Gearman;

class Worker
{
	protected $gearman_worker = null;

	public static function __init()
	{
		\Config::load('gearman', true);
	}

	public static function forge(array $callbacks)
	{
		$worker = new static();

		foreach ( $callbacks as $name => $callback )
		{
			if ( is_callable($callback) )
			{
				$worker->register_callback($name, $callback);
			}
			else
			{
				\Log::warning(var_export($callback, true) . ' is not callable.');
			}
		}

		return $worker;
	}

	protected function __construct()
	{
		$this->gearman_worker = new \GearmanWorker();
		$this->gearman_worker->addServer(\Config::get('gearman.host', '127.0.0.1'), \Config::get('gearman.port', '4730'));
	}

	protected function register_callback($name, $callback)
	{
		$this->gearman_worker->addFunction($name, $callback);
	}

	public function work()
	{
		while ($this->gearman_worker->work());
	}
}