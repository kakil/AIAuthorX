<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $imageSrc = $_POST['imageSrc'];
  $title = $_POST['title'];
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $imageSrc);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $imageData = curl_exec($ch);
  curl_close($ch);
  
  header('Content-Type: image/png');
  header('Content-Disposition: attachment; filename="' . $title . '.png"');
  echo $imageData;
}

?>
