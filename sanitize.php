<?php

function sanatize(string $s) {
    return htmlspecialchars(trim(preg_replace("/\t|\R/", ' ', $s)));
}

?>