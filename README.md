fuel-gearman
============

Install
------------

	git submodule add git://github.com/niaeashes/fuel-gearman.git fuel/packages/gearman

add `'gearman'` into `always_load.packages`.

### Dependencies

- libgearman http://gearman.org
- PECL gearman library http://pecl.php.net/package/gearman

### Check environment

	oil r gearman:env

Usage
------------

### Wakeup a new worker

	oil refine gearman:worker <class_name>

### Do a new job

	oil refine gearman:job <function_name> <workload>

Example
------------

**Worker_Sample on fuel/app/classes/worker/sample.php**

```php
<?php

class Worker_Sample
{
	public function work_sample($job)
	{
		Log::info($job->workload());
	}
}
```

**Wakeup sample worker**

	oil refine gearman:worker Worker_Sample

**Do sample job**

	oil refine gearman:job sample 'This is sample job'

or

```php
<?php

class Controller_Job extends Controller
{
	public function action_index()
	{
		\Gearman\Client::forge('sample', 'This is sample job');
	}
}

```

**result (log file)**

	INFO - 2013-09-08 11:42:27 --> This is sample job