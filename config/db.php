<?php
session_start();
$conn = mysqli_connect(
  // DOCKER 
  'db',
  'root',
  'root',
  'arturnito'

  // XAMP 
  // 'localhost',
  // 'root',
  // '',
  // 'arturnito'

) or die(mysqli_error($mysqli));

?>