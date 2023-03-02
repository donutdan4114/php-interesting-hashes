<?php
$x = 10;
$i = 0;
$_0 = str_repeat("0", $x);
$_f = str_repeat("f", $x);

$benchmark = isset($argv[1]) && $argv[1] === 'benchmark';

$start_time = microtime(TRUE);

while ($i < PHP_INT_MAX) {
  $previous = microtime(TRUE) . '_' . $i;
  $p_hash = md5($previous);

  for ($k = 0; $k < 10000000; $k++) {
    $hash = md5($p_hash);

    if (strncmp($hash, $p_hash, $x) === 0) {
      if ($hash === $p_hash) {
        file_put_contents("output.txt", $previous . "->" . $p_hash . "->" . $hash . " (" . count_similar($p_hash, $hash) . ")" . "\n", FILE_APPEND);
      }
      else {
        file_put_contents("output.txt", $previous . "->" . $p_hash . "->" . $hash . " (" . count_similar($p_hash, $hash) . ")" . "\n", FILE_APPEND);
      }
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

  if ($benchmark) {
    $end_time = microtime(TRUE);
    echo number_format($i * 10 / ($end_time - $start_time), 2) . "MH/s" . "\n";
  }
}

function count_similar(string $a, string $b): string {
  $i = 0;
  $len = strlen($a);
  while ($i < $len && $b[$i] === $a[$i]) {
    $i++;
  }
  return $i;
}