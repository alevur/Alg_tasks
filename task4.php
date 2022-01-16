<?php
/**
 * 4. Алгоритмы
написать функцию get_missed_number($sequence)
массив $sequence - арифметическая прогрессия, в которой пропущено одно число (в середине, не первое и не последнее)
функция возвращает это число или false , если в массиве  меньше двух элементов
примеры
[] вернуть false
[12] => false
[1,11] => 6
[1,11,31] => 21
[1,21,31,41] => 11
 */

$sequence = [1,21,31,41];
$missing_number = get_missed_number($sequence);
echo 'Пропущенное число '.$missing_number;

function get_missed_number($sequence)
{
    if (count($sequence) < 2) {
        return false;
    } else {
        $different = (end($sequence) - $sequence[0]) / count($sequence);//находим разность
        $search = $sequence[0] + $different;
        while (in_array($search, $sequence)) {
            $search+=$different;
        }
        return $search;
    }
}

