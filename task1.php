<?php
/** 1.  PHP task1.csv
Создать класс с публичным методом import($filename)
- Все созданные функции должны быть членами класса !
- Прочитать csv файл (в первой строке название колонок в произвольном порядке)
- Заполнить массив (каждый элемент массива - ассоциативный массив, название колонки используется как ключ)
- Отсортировать по Price (usort)
- Вернуть массив (первые 5 элементов отсортированного на предыдущем шаге)
  */

error_reporting(E_ERROR);

$csv = new TaskOneCSV();//создаём экземпляр класса
$sort_array = $csv->import('task1.csv'); //вызываем метод экземпляра и передаем в него путь к файлу

echo '<pre>';
print_r($sort_array);


class TaskOneCSV
{
    public function import($csv_file_path)
    {
        if (file_exists($csv_file_path)) { //если файл существует
            if (($handle = fopen($csv_file_path, 'r'))) { //если файл удалось открыть
                $keys = fgetcsv($handle, 0, ','); //записываем в массив ключи(названия колонок - первую строку)
                $array_line_full = []; //массив для значений из csv
                while (($line = fgetcsv($handle, 0, ","))) { //проходим весь csv и читаем построчно
                    $array_line_full [] = array_combine($keys, $line); //записываем массив значений
                }
                fclose($handle); //закрываем файл
                $array_line_full = array_diff($array_line_full, array(''));//удаляем пустые значения из массива

                function cmp($a, $b)
                {
                    if ($a['Price'] == $b['Price']) {
                        return 0;
                    }
                    return ($a['Price'] < $b['Price']) ? -1 : 1;
                }

                usort($array_line_full, "cmp");//сортируем по "Price"
                return array_slice($array_line_full, 5);//возвращаем первые 5 элементов
            } else {
                echo("Не удалось открыть файл " . $csv_file_path);
            }
        } else {
            echo("Файл " . $csv_file_path . " не найден");
        }
    }
}
