<?php
$q = new SplStack();

$n = 174;
while (intdiv($n, 2) > 0) {
    $q->push($n % 2);
    $n = intdiv($n, 2);
}
$q->push($n);

// print_r($q);

$q->rewind();
while ($q->valid()) {
    echo $q->current();
    $q->next();
}
