<?php
function factorial($n) {
    if ($n == 0) return 1;
    return $n * factorial($n - 1);
}

function power($x, $y) {
    return pow($x, $y);
}

function tangent($x) {
    return sin($x) / cos($x);
}

function my_sin($x) {
    return sin($x);
}

function my_cos($x) {
    return cos($x);
}

function my_tg($x) {
    return tan($x);
}