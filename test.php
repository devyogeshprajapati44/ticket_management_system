<?php
$array1 = array(0 => 'val11', 1 => 'val21', 2 => 'val31');
$array2 = array(0 => 'val12', 1 => 'val22', 2 => 'val32');
$array3 = array(0 => 'val13', 1 => 'val23', 2 => 'val33');

// Add prefix in array key
function addPrefix($a) {
return '_' . $a;
}

# transform keys
$array1 = array_combine(array_map('addPrefix', array_keys($array1)), $array1);
$array2 = array_combine(array_map('addPrefix', array_keys($array2)), $array2);
$array3 = array_combine(array_map('addPrefix', array_keys($array3)), $array3);

$result = array_merge_recursive($array1, $array2, $array3);

# Remove prefix from array keys
function removePrefix($a) {
  return substr($a, 1);
}

$array = array_combine(array_map('removePrefix', array_keys($result)), $result);
echo '<pre>';
print_r($result);
?>


@media screen and (min-width: 400px) {
    .row {
      margin-left: -200px;
  }
}

@media screen and (min-width: 1050px) {
  .row {
    margin-left: 58px;
  }
}
@media screen and (min-width: 400px) {
    #shqid {
      margin-left: -58px;
  }
}

@media screen and (min-width: 1050px) {
  #shqid {
    margin-left: 58px;
  }
}