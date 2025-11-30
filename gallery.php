<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея</title>
</head>

<body>
    <div class="container">
        <h1>Фото-галерея</h1>
        <form action="./uploadPhoto.php" method="post" enctype="multipart/form-data">
            <h3>Выберите фотографию:</h3>
            <input type="file" name="photos[]" multiple accept=".jpg,.jpeg,.png,.gif">
            <div class="file-info">Можно выбирать несколько файлов 
                (только JPG, JPEG, PNG, GIF. 2Мб - максимальный размер)
            </div>
            <button>Загрузить фотографии</button>
        </form>
        <?php
        session_start();
        if (isset($_SESSION['result'])) {
            $res = $_SESSION['result'];
            for ($i=0; $i < sizeof($res); $i++) { 
                echo $res[$i];
            }
        }
        ?>
        <h2>Загруженные фотографии</h2>
        <div class="gallery">
            <img src="" alt="">
            <?php
                $uploadDir = "./uploads";
                if (file_exists($uploadDir)) {
                    $photos = glob($uploadDir . "/*.{jpg,png,gif,jpeg,JPG,PNG,JPEG,GIF}", GLOB_BRACE);
                    print_r($photos);
                    if (empty($photos)) {
                        echo 'Нет загруженных фотографии';
                    } else {
                        for ($i=0; $i < sizeof($photos); $i++) { 
                            echo "<img src='$photos[$i]' classname='image' alt='no img'>";
                        }
                    }
                } else {
                    echo "<div>Папка для загрузок не найдена</div>";
                }
            ?>
        </div>
    </div>
</body>

</html>