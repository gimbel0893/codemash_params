<html>
    <head>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/<?=$_SERVER['JQUERY_VERSION']?>/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.main').fadeIn('slow');
            });
        </script>

    </head>
    <body>

        <div class="main">
            <?
                $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
                $sql = 'SELECT * FROM users WHERE id = ?';
                if(!($dbh = $db->prepare($sql)))
                {
                    trigger_error(sprintf('Prepare Failed: %s', $dbh->error), E_USER_WARNING);
                    die;
                }
                $id = (int)$_GET['id'];
                $dbh->bind_param('i', $id);
                if(!$dbh->execute())
                {
                    trigger_error(sprintf('Query Failed: %s', $dbh->error), E_USER_WARNING);
                    die;
                }
                $row = $dbh->get_result()->fetch_assoc();
            ?>
            first_name: <?=$row['first_name']?>
            <br />
            last_name: <?=$row['last_name']?>
        </div>

    </body>
</html>
