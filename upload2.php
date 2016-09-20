<?php
echo <<<_END
<html><head><meta charset="utf-8" /><title>PHP-форма для загрузки файлов на сервер</title></head>
        <body><form method='post' action='upload2.php' enctype='multipart/form-data'>
        Выберите файл c расширением JPG, GIF, PNG или TIFF: 
        <input type='file' name='filename' size='10'>
        <input type='submit' value='Загрузить'>
        </form>
        
_END;

    if ($_FILES)
    {
        $name = $_FILES['filename']['name'];
        switch($_FILES['filename']['type'])
        {
            case 'image/jpeg':$ext = 'jpg';break;
            case 'image/gif':$ext = 'gif';break;
            case 'image/png':$ext = 'png';break;
            case 'image/tiff':$ext = 'tif';break;
            default:          $ext = ''   ;break;
        }
        if ($ext)
        {
            $n = "image.$ext";
            move_uploaded_file($_FILES['filename']['tmp_name'],$n);
            echo "Загружаемое изображение '$name' под именем '$n':<br>";
            echo "<img src='$n'>";
        }
        else echo "'$name' - неприемлимый файл изображения";
    }
    else echo "Загрузки изображения не произошло";
   
    echo "</body></html>"
?>
