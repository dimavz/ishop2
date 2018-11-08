<?php
/**
 * Класс обработки ошибок
 */

namespace ishop;

class ErrorHandler
{
	public function __construct()
	{

		if (DEBUG)
		{
			error_reporting(-1); //Показывать ВСЕ ошибки
		}
		else
		{
			error_reporting(0); //Отключить показ ошибок
		}
		set_exception_handler([$this, 'exceptionHandler']);
	}

	public function exceptionHandler($error)
	{
		$this->logErrors($error->getMessage(), $error->getFile(), $error->getLine());
		$this->displayError($error->getCode(),$error->getMessage(), $error->getFile(),$error->getLine());
	}

	protected function logErrors($message = '', $file = '', $line = '')
	{
		error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки:{$message} | Файл: {$file} | Строка: {$line} \n====================\n", 3, ROOT . '/tmp/errors.log');
	}

	protected function displayError($err_number, $err_str, $err_file, $err_line)
	{
		http_response_code($err_number);
		if ($err_number == 404 && ! DEBUG)
		{
			require_once WWW . '/errors/404.php';
			die;
		}
		elseif(DEBUG)
		{
			require_once WWW . '/errors/dev.php';
		}
		else
		{
			require_once WWW . '/errors/prod.php';
		}
		die;
	}
}