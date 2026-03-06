<?php
if (!function_exists('custom_helper_function')) {
    function custom_helper_function($parameter) {
        // Your logic here
        return $parameter . ' processed';
    }
}

if(!function_exists('sum')) {
    function sum(int $a, int $b): int
    {
        return $a + $b;
    }
}
