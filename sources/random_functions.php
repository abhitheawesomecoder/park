<?
$seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
shuffle($seed);
$rand = '';
foreach (array_rand($seed, 7) as $k) $rand .= $seed[$k];

?>