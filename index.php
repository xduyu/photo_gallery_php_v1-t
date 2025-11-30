<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Загрузка файла</h2>
        <input type="file" name="userfile">
        <button>Загрузить файл</button>
    </form> 

    <a href="./gallery.php">Галерея</a>

    <?php
    // $FILES = [
    //     'userfile' => [
    //         'name' => 'myphoto.jpg',
    //         'type' => 'image/jpeg',
    //         'tmp_name' => '/tmp/php3xUYjD',
    //         'error' => 0,
    //         'size' => 102400
    //     ]
    // ];
    if (isset($_FILES["userfile"]) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES["userfile"]; // данные о файле

        // Создание папки
        $folder = "uploads/";
        if (!file_exists($folder)) {
            mkdir($folder);
        }
        // print_r($file);

        // Путь куда будет сохраняться файл
        $path = $folder . $file["name"]; // uploads/Html структура + основные теги.pptx 

        // Перемещение файла
        // $file["tmp_name"] - временный путь,где хранится загруженный файл
        if (move_uploaded_file($file["tmp_name"], $path)) {
            echo "Файл загружен";
        } else {
            echo "Ошибка";
        }
    }
    ?>

</body>

</html>