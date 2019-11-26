    <?php
    $currencies = get_currencies(); // Валюты из БД

    $time = time();
    $pub_ago = $time - $currencies[0]['pub_date'];

    // Каждые два часа
    if((int)$pub_ago > 60 * 60 * 2) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include_once $root . '/php/phpQuery-onefile.php';
        $html = file_get_contents('https://www.banki.ru/products/currency/cash/maykop/');
        $phpquery = phpQuery::newDocument($html);

        // Валюты спаршенные с какого-то сайта
        $dolor = $phpquery->find('table.currency-table__table tbody tr td:eq(1) div:eq(0)')->html();
        $euro  = $phpquery->find('table.currency-table__table tbody tr:eq(1) td:eq(1) div:eq(0)')->html();

        // Запись в БД
        mysqli_query($connection, "UPDATE `currencies` SET `value` = '$dolor', `pub_date` = $time WHERE `currencies`.`title` = 'dolor'");
        mysqli_query($connection, "UPDATE `currencies` SET `value` = '$euro', `pub_date` = $time WHERE `currencies`.`title` = 'euro'");
    }
    ?>
    
    <div class="footer">
        <div class="container">
            <div class="currencies">
                <span>&#36; <?=$currencies[0]['value'] ?></span>
                <span>&euro; <?=$currencies[1]['value'] ?></span>
            </div>

            <div class="copyright">&copy; Все права пренадлежат <span>ptrchoStudio</span></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>