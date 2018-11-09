<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.11.2018
 * Time: 17:37
 * Класс Кэша
 */

namespace ishop;


class Cache
{
	use TSingletone;

	public function set($key, $data, $seconds = 3600)
	{
		if ($seconds)
		{
			$content['data']     = $data;
			$content['end_time'] = time() + $seconds;
			if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content)))
			{
				return true; // Если удалось положить данные в кэш, то возвращаем истину
			}
		}

		return false;
	}

	public function get($key)
	{
		$file = CACHE . '/' . md5($key) . '.txt';
		if (file_exists($file)) // Проверяем существует ли файл с кэшем
		{
			$content = unserialize(file_get_contents($file));
			if (time() <= $content['end_time']) // Проверяем не устарел ли кэш
			{
				return $content;
			}
			unlink($file); // Удаляем файл с устаревшим кэшем
		}
		return false;
	}

	public function delete($key)
	{
		$file = CACHE . '/' . md5($key) . '.txt';
		if (file_exists($file)) // Проверяем существует ли файл с кэшем
		{
			unlink($file); // Удаляем файл
		}
	}

}