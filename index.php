<?php
$file = file_get_contents("tes.php");
function decode_code($code) {
  return preg_replace_callback('@\\\(x)?([0-9a-f]{2,3})@',
    function ($m) {
      if ($m[1]) {
        $hex = substr($m[2], 0, 2);
        $unhex = chr(hexdec($hex));
        if (strlen($m[2]) > 2) {
          $unhex .= substr($m[2], 2);
        }
        return $unhex;
      } else {
        return chr(octdec($m[2]));
      }
    },
    $code);
}

/*function decode_code($code) {
  return preg_replace_callback(
    "@\\\(x)?([0-9a-f]{2,3})@",
    function($m) {
      return chr($m[1]?hexdec($m[2]):octdec($m[2]));
    },
    $code
  );
}*/

$test = decode_code($file);
file_put_contents("test.txt", $test);
die();
