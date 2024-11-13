<?php
$stack = new SplStack();
$str = "s * (s  a) * s  b) * (s  c) ";
$array = str_split($str);
$check = true;
foreach ($array as $val) {
    if ($val == "("):
        $stack->push($val);
    elseif ($val == ")"):
        if (!$stack->count()) :
            $check = false;
        else:
            $stack->pop();
        endif;
    endif;
}

if (!$stack->count() && $check) :
    echo "Good!";
else:
    echo "Bad!";
endif;
