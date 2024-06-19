<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор Алкоголя</title>
</head>

<body>
    <h1>Рассчёт крепости коктейля</h1>
    <form action="index.php" method="post">
        <!-- реализовать автозаполнение инпута по селекту. Без js не обойтись по ходу
        <label for="alco-select">Выбери Алкоголь</label>
        <select name="alcoselect" id="alco-select">
            <option value="">--Выбери Алкоголь--</option>
            <option value="strong">Водка, Виски, Ром (40)</option>
            <option value="tequila">Текила (38)</option>
            <option value="absinthe">Абсент (60)</option>
            <option value="martini">Марини Bianco, Rosso, Rose (16)</option>
            <option value="jagermaster">Егермейстер (35)</option>
        </select>
        также реализовать кнопку с добавление инпутов. тоже js -->
        <label for="alco">Крепость напитка 1</label>
        <input type="text" name="alco[]">
        <label for="volume">Объём напитка 1</label>
        <input type="text" name="volume[]">
        <br>
        <label for="alco">Крепость напитка 2</label>
        <input type="text" name="alco[]">
        <label for="volume">Объём напитка 2</label>
        <input type="text" name="volume[]">
        <br>
        <label for="alco">Крепость напитка 3</label>
        <input type="text" name="alco[]">
        <label for="text">Объём напитка 3</label>
        <input type="text" name="volume[]">
        <input type="submit" value="Рассчитать">
        <br><br>
    </form>

    <?php

    $fullAlcoContent = 0;
    $fullVolume = 0;
    //заносим данные массива из инпутов с проверкой на пустоту и проверкой на целочисленное/дробное значение
    if (!empty($_POST)) {
        if (filter_input_array(INPUT_POST, FILTER_VALIDATE_FLOAT) == true) {
            $alcoProofPercent = $_POST['alco'];
            $volume = $_POST['volume'];

            /*создаём цикл, в котором по формуле сначала вычисляем кол-во спирта в каждом напитке,
    потом вычисляем общее кол-во спирта и общий объём*/
            for ($i = 0; $i < 3; $i++) {
                $alcoContent[$i] = (int)$volume[$i] * ((float) $alcoProofPercent[$i] / 100);
                $fullAlcoContent += (float) $alcoContent[$i];
                $fullVolume += (int) $volume[$i];
            }
        } else echo 'error';
    } else echo 'введите значения';

    var_dump($_POST);


    if ($fullVolume != 0) {
        //затем крепость коктейся округлив значение до десятой
        $result = round(100 * $fullAlcoContent / $fullVolume, 1);
    } else $result = 'Не смешивай воздух';


    ?>
    <h2>Крепость вашего коктейля: <?= $result . '%'; ?></h2>
</body>

</html>