<?php
$arr = [5, 4, 3, 2, 1];
$len_arr = count($arr);
$min = $arr[0];
$x = 0;
for ($i = 0; $i < $len_arr; $i++) {
    if ($min > $arr[$i]) {
        $x = $i;
        $min = $arr[$i];
    }
}

print($x);
