<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['photos'])) {
    $files = $_FILES['photos'];
    print_r($files);

    // Создание папки если нет
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir);
    }

    $trueTypes = ['image/jpeg', 'image/png', 'image/gif']; // допустимые форматы
    $maxSize = 1024 * 1024 * 2; // 2 МБ

    $result = [];

    // $files = [
    //     'pic1' => [
    //         'name' => ['myphoto.jpg', 'report.pdf', 'wallpaper.png']
    //         'type' => ['image/jpeg', 'application/pdf', 'image/png',]
    //         'tmp_name' => ['/tmp/php3xUYjD', /tmp/php3xUYjD', /tmp/php3xUYjD']
    //         'error' => [0, 0, 0]
    //         'size' => [102400, 2001, 227222]
    //     ],
    // ];

    foreach ($files["name"] as $key => $name) {
        // echo "- $name <br>";
        $error = $files["error"][$key];
        $size = $files["size"][$key];
        $type = $files["type"][$key];
        $tmpName = $files["tmp_name"][$key];

        if ($error !== UPLOAD_ERR_OK) {
            $result[] = 'Ошибка в загрузки $name';
            continue;
        }

        if ($size > $maxSize) {
            $result[] = "$name - слишком большой (Макс. 2МБ)";
            continue;
        }

        if (!in_array($type, $trueTypes)) {
            $result[] = "$name - недопустимый формат! (JPG, PNG, GIF)";
            continue;
        }
    }

    $path = $uploadDir . $name; // upload_dir
    if (move_uploaded_file($tmpName, $path)) {
        $result[] = "$name - Успешно загружена";
    } else {
        $result[] = "$name - Ошибка сохранения";
    }
    $_SESSION['result'] = $result;
    header("Location: gallery.php");
    exit;
} else {
    header("Location: gallery.php");
    exit;
}
