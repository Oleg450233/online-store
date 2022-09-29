<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <meta name="description" content="Обратная связь" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/form.css" type="text/css" charset="utf-8">
</head>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="container main">
    <h1>Обратная связь</h1>
    <p>Напишите нам если есть вопросы</p>
    <form action="/contact" method="post" class="form-control">
        <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
        <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
        <input type="text" name="age" placeholder="Введите возраст" value="<?=$_POST['age']?>"><br>
        <textarea name="message" placeholder="Введите сообщение"><?=$_POST['message']?></textarea>
        <div class="error"><?=$data['message']?></div>
        <button class="btn" id="send">Отправить</button>
    </form>



</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>