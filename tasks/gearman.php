<?php

namespace Fuel\Tasks;

class Gearman
{
	public function env()
	{
		$bar = str_repeat('-', 48);
		\Cli::write("{$bar}\nCheck environment for fuel-gearman\n{$bar}\n", 'green');

		$gearman_loaded = extension_loaded('gearman');
		$this->yn('Loaded gearman php extension', $gearman_loaded);
	}

	protected function yn($msg, $switch)
	{
		\Cli::write($msg . '... ' . ($switch ? 'yes' : 'no'), ($switch ? 'green' : 'red'));
	}

	public function worker($classname = null)
	{
		if ( empty($classname) )
		{
			\Cli::write('Usage: oil refine gearman:worker <class_name>');
			return false;
		}

		if ( ! class_exists($classname) )
		{
			\Cli::write( $classname . ' is not found.', 'red');
			return false;
		}
		$instance = new $classname();

		$callbacks = array();

		foreach ( get_class_methods($classname) as $method )
		{
			if ( preg_match('/^work_([a-z_]+)$/', $method, $matches) )
			{
				\Cli::write('Enabled method --- ' . $method . '() as "' . $matches[1] . '" on ' . $classname, 'green');
				$callbacks[$matches[1]] = array($instance, $method);
			}
		}

		$worker = \Gearman\Worker::forge($callbacks);
		$worker->work();
	}
}