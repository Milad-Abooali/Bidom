<?php
 $domain = $_POST['d'];
 if ( gethostbyname($domain) != $domain ) {
  echo "1";
 }
 else {
  echo "0";
 }
?>