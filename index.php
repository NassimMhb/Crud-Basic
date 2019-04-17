<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crud en php</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="css/style2.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="h1  fs3 txtcenter gradred white">CRUD - Docker TP</h1>
        <div class="page">
            <div class="container">
                <div id="main">
                    <a class="btn opt">Ajouter un utilisateur</a>
                    <div>
                        <table class="blueTable">
                            <thead>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Age</th>
                            <th colspan=3>Edition</th>           
                            </thead>
                            <br />
                            <tbody>
                                <?php
                                include 'database.php';
                                $pdo = Database::connect();
                                $sql = 'SELECT * FROM utilisateurs ORDER BY id DESC';
                                foreach ($pdo->query($sql) as $row) {
                                    echo '<br /><tr>';
                                    echo'<td><div class="divtd">' . $row['id'] . '</div></td>';
                                    echo'<td>' . $row['nom'] . '</td>';
                                    echo'<td>' . $row['prenom'] . '</td>';
                                    echo'<td>' . $row['age'] . '</td>';
                                    echo '<td>' . '<a class="btn1 opt1" href="' . $row['id'] . '">Lire</a></td>';
                                    echo '<td>' . '<a class="btn2 opt2" href="' . $row['id'] . '">Modifier</a></td>';
                                    echo' <td>' . '<a class="btn3 opt3" href="' . $row['id'] . ' ">Supprimer</a></td>';
                                    echo '</tr';
                                }
                                Database::disconnect(); //on se deconnecte de la base
                                ;
                                ?>    
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="option"></div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $('.opt').click(function (evt) {
            $.post("add.php", {}, function (response) {
                $('#option').html(response);
            });
            return false;
        });
        $('.opt1').click(function (evt) {
            var id = $(this).attr('href');
            $.post("edit.php", {id: id}, function (response) {
                $('#option').html(response);
            });
            return false;
        });

        $('.opt2').click(function (evt) {
            var id = $(this).attr('href');
            $.post("update.php", {id: id}, function (response) {
                $('#option').html(response);
            });
            return false;
        });

        $('.opt3').click(function (evt) {
            var id = $(this).attr('href');
            $.post("delete.php", {id: id}, function (response) {
                $('#option').html(response);
            });
            return false;
        });
    </script>
</html>