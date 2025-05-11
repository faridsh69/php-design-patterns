<?php

function dd(...$vars)
{
  foreach ($vars as $var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
  }
  die(1);
}
