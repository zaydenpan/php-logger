<?php

function logger($val) {
  $traces = debug_backtrace();

  $trace = reset($traces);
  $file   = basename($trace['file']);
  $line  = $trace['line'];

  $type = gettype($val);

  if ($type === 'boolean') {
    $val = ($val === true) ? 'true' : 'false';
  }

  $output = "$file | line $line | ($type)";

  if ($type === 'object') {
    $output = $output . get_class($val);
    echo $output;
  }
  else if ($type !== 'array') {
    echo $val;
    $output = "$output $val";
    echo "<script>console.log('" . $output . "'); </script>";
  } else {
    $val = json_encode($val);
    echo "<script>console.log('$output', JSON.parse('" . $val . "')); </script>";
  }
}
