<?php
/**
 * @copyright Copyright (C) 2023 Daniel J. Pepin
 * @license MIT
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the MIT License.
 *
 *
 * Usage: php md5.php
 *   Finds hashes that start with many zeros, f's, and "self-hashes".
 *   Outputs interesting hashes to "output.txt".
 *   You can run multiple instances of this script at the same time.
 */

// Number of characters that must match to be considered "interesting".
// Large number is slower and grows exponentially.
// Recommended 8 to 10 for starters... May take multiple days to find a match of 14 characters.
$x = 6;

// The 00000... string we are looking for.
$_0 = str_repeat("0", $x);

// The fffff... string we are looking for.
$_f = str_repeat("f", $x);

$start_time = microtime(TRUE);

$i = 0;
while ($i < PHP_INT_MAX) {
  $previous = microtime(TRUE) . '_' . $i;
  $p_hash = md5($previous);

  for ($k = 0; $k < 10000000; $k++) {
    $hash = md5($p_hash);

    if (strncmp($hash, $p_hash, $x) === 0) {
      file_put_contents("output.txt", $previous . "->" . $p_hash . "->" . $hash . " (" . count_similar($p_hash, $hash) . ")" . "\n", FILE_APPEND);
    }
    elseif (strncmp($hash, $_0, $x) === 0) {
      file_put_contents("output.txt", $previous . "->" . $p_hash . "->" . $hash . " (" . count_similar($_0, $hash) . ")" . "\n", FILE_APPEND);
    }
    elseif (strncmp($hash, $_f, $x) === 0) {
      file_put_contents("output.txt", $previous . "->" . $p_hash . "->" . $hash . " (" . count_similar($_f, $hash) . ")" . "\n", FILE_APPEND);
    }

    $previous = $p_hash;
    $p_hash = $hash;
  }

  $i++;
}

/**
 * Cound the number of matching characters.
 *
 * @param string $a
 * @param string $b
 *
 * @return int
 */
function count_similar(string $a, string $b): int {
  $i = 0;
  $len = strlen($a);
  while ($i < $len && $b[$i] === $a[$i]) {
    $i++;
  }
  return $i;
}