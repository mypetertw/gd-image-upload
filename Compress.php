<?php
# UPLOAD YOUR IMAGE
function UPLOAD($FIELD, $ID, $LOCATION) {

    $type = strtolower(strrchr($_FILES[''.$FIELD.'']['name'], '.'));
    $imgSource = __DIR__ . $LOCATION . $ID . $type;
    if (move_uploaded_file($_FILES[''.$FIELD.'']['tmp_name'], $imgSource)) {
      return $LOCATION . $ID . $type;
    }
}

# COMPRESS YOUR IMAGE
function COMPRESS($FIELD, $ID, $LOCATION, $SOURSE_LOCATION, $WIDTH_LIMIT) {

    $type = strtolower(strrchr($_FILES[''.$FIELD.'']['name'], '.'));
    $imgSource = __DIR__ . $SOURSE_LOCATION . $ID . $type;
    $imgReader = __DIR__ . $LOCATION . $ID . $type;
    list($width, $height, $type_no) = getimagesize($imgSource);

    if ($width > $WIDTH_LIMIT) {
      $ratio = $width / $height;
      if ($ratio > 1) {
        $newWidth = $WIDTH_LIMIT;
        $newHeight = $WIDTH_LIMIT / $ratio;
      } else {
        $newWidth = $WIDTH_LIMIT * $ratio;
        $newHeight = $WIDTH_LIMIT;
      }
    } else {
      $newWidth = $width;
      $newHeight = $height;
    }

    switch ($type_no) {
      case 2:
        header('Content-Type:image/jpeg');
        $imageWp = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromjpeg($imgSource);
        imagecopyresampled($imageWp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($imageWp, $imgReader, 100);
        imagedestroy($imageWp);
      break;

      case 3:
        header('Content-Type:image/png');
        $imageWp = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefrompng($imgSource);
        imagecopyresampled($imageWp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($imageWp, $imgReader, 100);
        imagedestroy($imageWp);
      break;
    }

    return $LOCATION . $ID . $type;
 }
