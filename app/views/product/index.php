<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title']?></title>
    <meta name="description" content="<?=$data['anons']?>" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/product.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css" charset="utf-8">
</head>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="container main">
    <h1><?=$data['title']?></h1>
    <div class="info">

        <div>
            <img src="/public/img/<?=$data['img']?>" alt="<?=$data['title']?>">
        </div>
        <div>
            <p><?=$data['anons']?></p><br>
            <p><?=$data['text']?></p><br>
        </div>
        <form action="/bas" method="post">
            <input type="hidden" name="item_id" value="<?=$data['id']?>">
            <button class="btn">Купить за <?=$data['price']?> рублей </button>
        </form>
        </div>

    </div>
</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>