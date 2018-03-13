<?php

function sanitize($s) {
    if (is_string($s)) {
        return htmlspecialchars(trim(preg_replace("/\t|\R/", ' ', $s)));
    }

    if (is_array($s)) {
        $newArr = [];
        foreach ($s as &$value) {
            array_push($newArr, sanitize($value));
        }
        unset($value);

        return $newArr;
    }
    
}

?>