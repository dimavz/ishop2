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
			$content['data']     = $data; // Помещаем данные в массив
			$content['end_time'] = time() + $seconds; // Помещаем время актуальности кэша в массив
            $file = CACHE . '/' . md5($key) . '.txt'; // Формируем название файла кэша
			if (file_put_contents($file, serialize($content))) // Помещаем в файл кэша сериализованные данные
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
			$content = unserialize(file_get_contents($file)); // Получаем из файла кэша его содержимое и делаем десериализацию данных
//            debug($content);
			if (time() <= $content['end_time']) // Проверяем не устарел ли кэш
			{
				return $content['data'];
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