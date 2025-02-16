<?php

function ordenarArray($arr) {
    $n = count($arr);

    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }

    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

$array = [50, 1, 5, 65, 35, 22, 100, 300, 250];
ordenarArray($array);

?>
