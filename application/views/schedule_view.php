<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Расписание сеансов</title>
</head>
<body>
<div><a href="<?=base_url()?>">На главную</a></div>
<h3>Сеансы на <?= $current_date ?></h3>
<?php if(!empty($schedule)): ?>
    <h3>Кинотеатр - <?=$theater[0]['name']?></h3>
    <table>
        <thead>
        <tr>
            <th>Название фильма</th>
            <th>Зал</th>
            <th>Время сеанса</th>
            <th>Продолжительность</th>
            <th>Жанр</th>
            <th>Категория</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($schedule as $item): ?>
            <tr>
                <td><?=$item['name']?></td>
                <td><a href="<?=base_url() . '/schedule/' .$theater[0]['code_name'] . '/' .$item['hall_id']?>/"><?=$item['number_hall']?></a></td>
                <?php
                    $item['hour'] = $item['hour'] < 10? '0' . $item['hour']: $item['hour'];
                    $item['minute'] = $item['minute'] < 10? '0' . $item['minute']: $item['minute'];
                ?>
                <td><?=$item['hour'] . ' : ' . $item['minute'] ?></td>
                <td><?=$item['duration']?> мин.</td>
                <td><?=$item['genre']?></td>
                <td><?=$item['category']?></td>
                <td><a href="<?=base_url() . '/sessions/' . $item['session_id']?>">Купить билет</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif(!empty($schedule_by_film)): ?>
    <h3><?=$film[0]['name']?></h3>
    <table>
        <thead>
        <tr>
            <th>Кинотеатр</th>
            <th>Зал</th>
            <th>Время сеанса</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($schedule_by_film as $item): ?>
            <tr>
                <td><?=$item['theater_name']?></td>
                <td><?=$item['number_hall']?></td>
                <?php
                    $item['hour'] = $item['hour'] < 10? '0' . $item['hour']: $item['hour'];
                    $item['minute'] = $item['minute'] < 10? '0' . $item['minute']: $item['minute'];
                ?>
                <td><?=$item['hour'] . ' : ' . $item['minute']?></td>
                <td><a href="<?=base_url() . '/sessions/' . $item['session_id']?>">Купить билет</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <span>Кина не будет!</span>
<?php endif; ?>
</body>
</html>