<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина товаров</title>
    <meta name="description" content="Корзина товаров" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/products.css" type="text/css" charset="utf-8">
</head>
<body>
<?php require_once 'public/blocks/header.php'; ?>

<div class="container main">
    <h1>Корзина товаров</h1>
    <form action="/bas" method="post">
        <input type="hidden" name="delete" value="<?=$data['product']?>">
        <button type="submit" class="btn" >Удалить все товары</button>
    </form>



    <?php if(count($data['product'])==0):?>
    <p>  <?=$data['empty']?></p>
    <?php else:?>
    <div class="products">
           <?php
        $sum=0;
        for($i=0;$i<count($data['product']);$i++):
            $sum+=$data['product'][$i]['price'];

        ?>
        <div class="row">
            <img src="/public/img/<?=$data['product'][$i]['img']?>" alt="<?=$data['product'][$i]['title']?>">
            <h4><?=$data['product'][$i]['title']?></h4>
            <span><?=$data['product'][$i]['price']?>рублей</span>
             <form action="/bas" method="post">
             <input type="hidden" name="del_id" value="<?=$data['product'][$i]['id']?>">
                 <button type="submit" class="btn">Удалить из корзины</button>
             </form>
        
        </div>

        <?php endfor;?>


<!--        <button class="btn">Приобрести(<b>--><?//=$sum?><!--рублей</b>)</button>-->
        <?php

        //Секретный ключ интернет-магазина
        $key = "796e457037767764595a607b6a5e516f7054684f7770786f624761";

        $fields = array();

        // Добавление полей формы в ассоциативный массив
        $fields["WMI_MERCHANT_ID"]    = "194396671090";
        $fields["WMI_PAYMENT_AMOUNT"] = $sum;
        $fields["WMI_CURRENCY_ID"]    = "643";
        $fields["WMI_PAYMENT_NO"]     = time();
        $fields["WMI_DESCRIPTION"]    = "BASE64:".base64_encode("Покупка товаров");
        $fields["WMI_EXPIRED_DATE"]   = date('Y-m-d')."T23:59:59";
        $fields["WMI_SUCCESS_URL"]    = "https://itproger.com/success";
        $fields["WMI_FAIL_URL"]       = "https://itproger.com/fail.php";
        $fields["MyShopParam1"]       = "Value1"; // Дополнительные параметры
        $fields["MyShopParam2"]       = "Value2"; // интернет-магазина тоже участвуют
        $fields["MyShopParam3"]       = "Value3"; // при формировании подписи!
        //Если требуется задать только определенные способы оплаты, раскоментируйте данную строку и перечислите требуемые способы оплаты.
        //$fields["WMI_PTENABLED"]      = array("UnistreamRUB", "SberbankRUB", "RussianPostRUB");

        //Сортировка значений внутри полей
        foreach($fields as $name => $val)
        {
            if(is_array($val))
            {
                usort($val, "strcasecmp");
                $fields[$name] = $val;
            }
        }

        // Формирование сообщения, путем объединения значений формы,
        // отсортированных по именам ключей в порядке возрастания.
        uksort($fields, "strcasecmp");
        $fieldValues = "";

        foreach($fields as $value)
        {
            if(is_array($value))
                foreach($value as $v)
                {
                    //Конвертация из текущей кодировки (UTF-8)
                    //необходима только если кодировка магазина отлична от Windows-1251
                    $v = iconv("utf-8", "windows-1251", $v);
                    $fieldValues .= $v;
                }
            else
            {
                //Конвертация из текущей кодировки (UTF-8)
                //необходима только если кодировка магазина отлична от Windows-1251
                $value = iconv("utf-8", "windows-1251", $value);
                $fieldValues .= $value;
            }
        }

        // Формирование значения параметра WMI_SIGNATURE, путем
        // вычисления отпечатка, сформированного выше сообщения,
        // по алгоритму MD5 и представление его в Base64

        $signature = base64_encode(pack("H*", md5($fieldValues . $key)));

        //Добавление параметра WMI_SIGNATURE в словарь параметров формы

        $fields["WMI_SIGNATURE"] = $signature;

        // Формирование HTML-кода платежной формы

        print "<form action='https://wl.walletone.com/checkout/checkout/Index' method='POST'>";

        foreach($fields as $key => $val)
        {
            if(is_array($val))
                foreach($val as $value)
                {
                    print " <input type='hidden' name='$key' value='$value'/>";
                }
            else
                print "<input type='hidden' name='$key' value='$val'/>";
        }

        print "<input type='submit' class='btn' value='Приобрести(".$sum."рублей)'></form>";

        ?>


    </div>

    <?php endif;?>

</div>

<?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>

<!--796e457037767764595a607b6a5e516f7054684f7770786f624761-->


