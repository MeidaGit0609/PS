    <?php
    $time = date('His');

    // Каждые два часа спаршеные валюты записываються в БД 
    if(substr($time, 0, 2) % 2 == 0 && substr($time, 2, 2) == 00 && substr($time, 4, 2) == 00) {

        include_once '../php/phpQuery-onefile.php';
        $html = file_get_contents('https://www.banki.ru/products/currency/cash/maykop/');
        $phpquery = phpQuery::newDocument($html);
    
        // Валюты спаршенные с какого-то сайта
        $dolor = $phpquery->find('table.currency-table__table tbody tr td:eq(1) div:eq(0)')->html();
        $euro  = $phpquery->find('table.currency-table__table tbody tr:eq(1) td:eq(1) div:eq(0)')->html();

        // Запись в БД
        mysqli_query($connection, "UPDATE `currencies` SET `value` = '$dolor' WHERE `currencies`.`title` = 'dolor'");
        mysqli_query($connection, "UPDATE `currencies` SET `value` = '$euro' WHERE `currencies`.`title` = 'euro'");
        echo 'ура';
    }

    $currencies_result = mysqli_query($connection, "SELECT `value` FROM `currencies`");
    $currencies = mysqli_fetch_all($currencies_result, MYSQLI_ASSOC); // Валюты из БД

    ?>
    
    <div class="footer">
        <div class="container">
            <div class="currencies">
                <span>&#36; <?=$currencies[0]['value'] ?></span>
                <span>&euro; <?=$currencies[1]['value'] ?></span>
            </div>

            <div class="copyright">&copy; Все права пренадлежат студии <span>ptrchoStudio</span></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>