<?php
use Core\User;



if (isset($_FILES['profile_pic']['errors'])) {
  throw new \Exception('Unable to upload image');
}

$tmpFilePath = $_FILES['profile_pic']['tmp_name'];
$fileName = uniqid() . '_' . $_FILES['profile_pic']['name'];
$uploadPath = 'images/' . $fileName;
move_uploaded_file($tmpFilePath, $uploadPath);

(new User())->updateProfilePic('/images/' . $fileName);
redirect($_SERVER['HTTP_REFERER']);