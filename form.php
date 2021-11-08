<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $folder = "./";
    $uploadFile = basename($_FILES['homer']['name']);
    $extension = pathinfo($_FILES['homer']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;
    $errors = [];
    $uniqFile = uniqid('', true);
    $file = $uniqFile . "." . $extension;

    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = "Extensions autorisées : jpg, png, gif, webp";
    }
    if (file_exists($_FILES['homer']['tmp_name']) && filesize($_FILES['homer']['tmp_name']) > $maxFileSize) {
        $errors[] = "Fichier trop lourd maximum autorisé : 1MO";
    }
    move_uploaded_file($_FILES['homer']['tmp_name'], './' . $file);
    if (empty($errors)) {
        echo "<img src='".$file."'/>";
    } else {
        foreach ($errors as $error) ;
        echo $error . "\n";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label for="homer">Upload an picture of Homer</label>
    <input type="file" name="homer" id="imageUpload" />
    <button name="send">Send</button>
</form>
</body>
</html>