<?php
require 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    //on initialise nos messages d'erreurs; $
    $nomError = '';
    $prenomError = '';
    $ageError = '';
    // on recupère nos valeurs 
    $nom = htmlentities(trim($_POST['nom']));
    $prenom = htmlentities(trim($_POST['prenom']));
    $age = htmlentities(trim($_POST['age']));

    // on vérifie nos champs 
    $valid = true;
    if (empty($nom)) {
        $nomError = 'Ajoutez un nom';
        $valid = false;
    }
    if (empty($prenom)) {
        $prenomError = 'Entrer le prenom';
        $valid = false;
    }
    if (empty($age)) {
        $ageError = 'Entrez le champ age';
        $valid = false;
    }
    // si les données sont présentes et bonnes, on se connecte à la base 
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO utilisateurs (nom,prenom,age) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nom, $prenom, $age));
        Database::disconnect();
        header("Location: index.php");
    }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#main').hide();
</script>
<div id="add"> 
    <div class="container">
        <br />
        <div class="txtcenter">
            <h3>Ajouter un utilisateur </h3>
        </div>
        <form method="post" action="add.php" enctype="multipart/form-data" class="form-style-9">      
            <ul>
                <li>
                    <div class="control-group<?php echo!empty($nomError) ? 'error' : ''; ?>">
                        <label>Nom</label>
                        <br />
                        <input type="text" name="nom" class="field-style field-full align-none" placeholder="nom" value="<?php echo!empty($nom) ? $nom : ''; ?>">
                        <?php if (!empty($nomError)): ?>
                            <span><?php echo $nomError; ?></span>
<?php endif; ?>
                    </div>
                </li>
                                <li>
                    <div class="control-group<?php echo!empty($titreError) ? 'error' : ''; ?>">
                        <label>Prénom</label>
                        <br />
                        <input type="text" name="prenom" class="field-style field-full align-none" placeholder="prénom" value="<?php echo!empty($prenom) ? $prenom : ''; ?>">
                        <?php if (!empty($prenomError)): ?>
                            <span><?php echo $prenomError; ?></span>
<?php endif; ?>
                    </div>
                </li>
                                <li>
                    <div class="control-group<?php echo!empty($titreError) ? 'error' : ''; ?>">
                        <label>Age</label>
                        <br />
                        <input type="text" name="age" class="field-style field-full align-none" placeholder="titre" value="<?php echo!empty($age) ? $age : ''; ?>">
                        <?php if (!empty($ageError)): ?>
                            <span><?php echo $ageError; ?></span>
<?php endif; ?>
                    </div>
                </li>
                <br />
                <div>
                    <input type="submit" class="btn1" name="submit" value="Ajouter">
                    <a class="btn2" href="index.php">Retour</a>
                </div>
            </ul>
        </form>  
    </div>
</div>
<script type="text/javascript">
    $('#retour').click(function () {
        $('#main').show();
        $("#add").remove();
    });
    
</script>