<?php

function sanitize(string $s) {
    return htmlspecialchars(trim(preg_replace("/\t|\R/", ' ', $s)));
}

?>