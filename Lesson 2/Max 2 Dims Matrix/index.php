<?php
$rows = readline("Số hàng: ");
$columns = readline("Số cột: ");
$matrix = [[]];

for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $columns; $j++) {
        $matrix[$i][$j] = readline("Số ở hàng " . ($i + 1) . " và cột " . ($j + 1) . " là: ");
    }
}

$max = 0;
$max = $matrix[0][0];

$x = 0;
$y = 0;

for ($k = 0; $k < $rows; $k++) {
    for ($l = 0; $l < $columns; $l++) {
        if ($matrix[$k][$l] > $max) {
            $max = $matrix[$k][$l];
            $x = $k;
            $y = $l;
        }
    }
}

echo "Số lớn nhất là: $max \n";

echo "Tại hàng " . ($x + 1) . "\n";
echo "Cột " . ($y + 1) . "\n";
