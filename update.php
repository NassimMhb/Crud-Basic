<?php
require 'database.php';
$id = null;
if (!empty($_POST['id'])) {
    $id = $_REQUEST['id'];
}
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && sizeof($_POST) > 1) {
    // on initialise nos erreurs 
    // on initialise nos erreurs 
    $nomError = '';
    $prenomError = '';
    $ageError = '';
    // On assigne nos valeurs
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    // On verifie que les champs sont remplis 
    $valid = true;
    if (empty($nom)) {
        $nomError = 'Entrer le nom';
        $valid = false;
    }
    if (empty($prenom)) {
        $prenomError = 'Ajoutez un prénom';
        $valid = false;
    }
    if (empty($age)) {
        $ageError = 'Entrez le champ age';
        $valid = false;
    }
    // mise à jour des donnés 
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE utilisateurs SET nom = ?,prenom = ?,age = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nom, $prenom, $age, $id));
        Database::disconnect();
        header("Location: index.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM  utilisateurs where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $age = $data['age'];
    Database::disconnect();
}
?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#main').hide();
</script>
<div id="update"> 
    <div class="container">
        <br />
        <div class="txtcenter">
            <h3>Modifier les informations</h3>
        </div>
        <form method="post" action="update.php?id=<?php echo $id; ?>" enctype="multipart/form-data" class="form-style-9">      
            <ul>
                <li>    
                    <div class="control-group<?php echo!empty($nomError) ? 'error' : ''; ?>">
                        <label>Nom</label>
                        <br />
                            <input type="text" name="nom" placeholder="nom" class="field-style field-full align-none" value="<?php echo!empty($nom) ? $nom : ''; ?>">
                            <?php if (!empty($nomError)): ?>
                                <span><?php echo $nomError; ?></span>
                            <?php endif; ?>
                    </div>
                </li>
                <li>    
                    <div class="control-group<?php echo!empty($prenomError) ? 'error' : ''; ?>">
                        <label>Prénom</label>
                        <br />
                            <input type="text" name="prenom" placeholder="prénom" class="field-style field-full align-none" value="<?php echo!empty($prenom) ? $prenom : ''; ?>">
                            <?php if (!empty($prenomError)): ?>
                                <span><?php echo $prenomError; ?></span>
                            <?php endif; ?>
                    </div>
                </li>
                <li>    
                    <div class="control-group<?php echo!empty($ageError) ? 'error' : ''; ?>">
                        <label>Age</label>
                        <br />
                            <input type="text" name="age" placeholder="âge" class="field-style field-full align-none" value="<?php echo!empty($age) ? $age : ''; ?>">
                            <?php if (!empty($ageError)): ?>
                                <span><?php echo $ageError; ?></span>
                            <?php endif; ?>
                    </div>
                </li>
                <br />
                <div class="form-actions">
                    <input type="submit" class="btn2" name="submit" value="Modifier">
                    <a id="retour" class="btn1">Retour</a>
                </div>
            </ul>
        </form>           
    </div>
</div>
<script type="text/javascript">
    $('#retour').click(function () {
        $('#main').show();
        $("#update").remove();
    });
</script>
