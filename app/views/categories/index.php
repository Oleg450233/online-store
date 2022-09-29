<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title']?></title>
    <meta name="description" content=<?=$data['title']?> />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/product.css" type="text/css" charset="utf-8">
<body>
<?php require_once 'public/blocks/header.php'; ?>
<div class="container main">
    <h1><?=$data['title']?></h1>
    <div class="products">
        <?php for($i = 0; $i <count($data['products']); $i++): ?>
            <div class="product">
                <div class="image">
                    <img src="/public/img/<?=$data['products'][$i]['img']?>" alt="<?=$data[$i]['title']?>">
                </div>
                <h3><?=$data['products'][$i]['title']?></h3>
                <p><?=$data['products'][$i]['anons']?></p>
                <a href="/product/<?=$data['products'][$i]['id']?>"><button class="btn">Детальнее</button></a>

            </div>
        <?php endfor; ?>
    </div><br>

        <div class="pagination">
            <a class="page-link" href="/categories/<?=$data['page']?>">1</a>
            <a class="page-link" href="/categories/<?=$data['pages']?>">2</a>
            </div>

    </div>

<?php require_once 'public/blocks/footer.php'; ?>



