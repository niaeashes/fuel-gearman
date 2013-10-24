<?php

namespace Gearman;

class Client
{
	protected static $gearman_client = null;
	protected static $has_server = false;

	public static function _init()
	{
		\Config::load('gearman', true);

		if ( class_exists('GearmanClient') )
		{
			try
			{
				static::$gearman_client = new \GearmanClient();
				static::$has_server = static::$gearman_client->addServer(\Config::get('gearman.host', '127.0.0.1'), \Config::get('gearman.port', '4730'));
			}
			catch ( \GearmanException $e )
			{
				\Log::error($e->getMessage());
			}
		}
	}

	public static function forge($name, $workload)
	{
		$name = (string) $name;
		$workload = (string) $workload;

		if ( ! empty(static::$gearman_client) and static::$has_server )
		{
			try
			{
				static::$gearman_client->doBackground($name, $workload);
			}
			catch ( \GearmanException $e )
			{
				\Log::error($e->getMessage());
			}
		}
	}
}