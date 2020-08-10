<?php
function generateRandomString($length) {
  $include_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  /* Uncomment below to include symbols */
  /* $include_chars .= "[{(!@#$%^/&*_+;?\:)}]"; */
  $charLength = strlen($include_chars);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $include_chars [rand(0, $charLength - 1)];
  }
  return $randomString;
}



$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$name = generateRandomString(5).".".$imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../../img.kvds.dev/".$name)) {
    // echo "The file ". $name . " has been uploaded.";
    // echo("<a href=\"https://img.kvds.dev/$name\">Click here to view</a>");
    header("Location: http://img.kvds.dev/".$name);
    exit();
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>