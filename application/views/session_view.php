<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cеанс кино - <?=$film[0]['name']?></title>
</head>
<body>
    <div><a href="<?=base_url()?>">На главную</a></div>
    <h3>Кинотеатр - <?=$theater[0]['name']?></h3>
    <?php
        $sessions[0]['hour'] = $sessions[0]['hour'] < 10? '0' . $sessions[0]['hour']: $sessions[0]['hour'];
        $sessions[0]['minute'] = $sessions[0]['minute'] < 10? '0' . $sessions[0]['minute']: $sessions[0]['minute'];
    ?>
    <h3><?=$film[0]['name']?> - Начало в <?=$sessions[0]['hour'] . ' : ' . $sessions[0]['minute']?></h3>
    <p>Жанр: <?=$film[0]['genre']?></p>
    <p>Продолжительность: <?=$film[0]['duration']?> мин.</p>
    <p>Категория: <?=$film[0]['category']?></p>
    <p>Кол-во свободных мест: <?=$count_places - count($bought_places)?></p>
    <div><?=$result?></div>
    <div>
        <form action="<?=base_url() . '/tickets/buy/' . $sessions[0]['id']?>" method="POST">
            <div>
            <?php for($i = 1; $i < $count_places; $i++): ?>
                <?php $checked = in_array($i,$bought_places)? "checked disabled": ""; ?>
                <span>
                    <?=$i?>
                    <input type="checkbox" name="places[<?=$i?>]" value="<?=$i?>" id="place" <?=$checked?>/>
                </span>
            <?php endfor; ?>
            </div>
            <input type="submit" value="Купить">
        </form>
    </div>
    <h3>Купленные места</h3>
    <table>
        <thead>
            <tr>
                <th>Уникальный код</th>
                <th>Места</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($busy_tickets as $key => $value): ?>
            <tr>
                <td><?=$key?></td>
                <td><?=$value?></td>
                <td>
                    <a href="<?=base_url() . '/tickets/reject/' . $sessions[0]['id'] . '/' . $key?>">
                        Отменить покупку
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>