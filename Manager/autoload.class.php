<?php
function autoload($classname)
{
	if (file_exists($file = __DIR__ . '/' . $classname. '.class'. '.php') || 
	file_exists($file = __DIR__ . '/' . 'PortfolioDetailsManager/' . $classname . '.class' . '.php') || file_exists($file = __DIR__ . '/' . 'UsersManager/' . $classname . '.class' . '.php'))
	{
		require $file;
	}
}
spl_autoload_register('autoload');
