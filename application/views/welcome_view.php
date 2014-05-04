<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Идем в кино!</title>
</head>
<body>
    <h3>Кинотеатры</h3>
    <table>
        <thead>
            <tr>
                <th>Кинотеатр</th>
                <th>Кол-во залов</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($theaters as $item): ?>
            <tr>
                <td><?=$item['name']?></td>
                <td><?=$item['count_halls']?></td>
                <td><a href="<?=base_url() . 'schedule/' . $item['code_name']?>">Расписание</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Сегодня в кино!</h3>
    <ul>
        <?php foreach($films as $item): ?>
            <li><a href="<?=base_url() . 'films/' . $item['id']?>"><?=$item['name']?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>