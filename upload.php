<!DOCTYPE html>
<?php 
require 'init.php';

if(isset($_POST['photoSubmit'])){
    $target_dir = "img/uploads/";
    $target_file = $target_dir . basename(rand().$_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        correctImageOrientation($target_file);
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}


?>
<html>
    <head>
        <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        Sube tu foto:
        <input accept="image/*" type="file" name="fileToUpload" id="fileToUpload" capture/>
        <input type="submit" value="Subir foto" name="photoSubmit">
    </form>

    </body>
</html>