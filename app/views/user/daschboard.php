<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кабинет пользователя</title>
    <meta name="description" content="Кабинет пользователя" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/user.css" type="text/css" charset="utf-8">
</head>
<body>

<?php require_once 'public/blocks/header.php'; ?>

<div class="container main">
    <h1>Кабинет пользователя</h1>
    <div class="user-info">

    <p>Привет:<b><?= $data['user']['name']?></b></p>

        <form action="/user/daschboard" method="post" enctype="multipart/form-data">
            <input type="file" name="image_user"><br>
            <div class="error"><?=$data['error']?></div>
            <button type="submit" class="btn">Отправить</button>
        </form>
        <div>
            <img src="/public/img/<?=$data['user']['image']?>" alt="<?=$data['title']?>">
        </div>
        <form action="/user/daschboard" method="post">
            <input type="hidden" name="exit-btn">
            <button type="submit" class="btn">Выйти</button>
        </form><br>

    </div>

</div>


<?php require_once 'public/blocks/footer.php'; ?>
</body>

