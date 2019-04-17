<?php
require('database.php');
$id = null;
if (!empty($_POST['id'])) {
    $id = $_REQUEST['id'];
} if (null == $id) {
    header("location:index.php");
} else {
    //on lance la connection et la requete 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM utilisateurs where id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#main').hide();
</script>
<div id="edit"> 
    <div class="container">
        <br />
        <div class="txtcenter">
            <h3>Edition</h3>
        </div>
        <form class="form-style-9">  
            <ul>
                <li>
                    <label class="lab pr5">Id</label>
                    <label class="lab pr5">Nom</label>
                    <label class="lab pr5">Prénom</label>
                    <label class="lab left">Age</label>
                    <br />
                    <label class="pr5"><?php echo $data['id']; ?></label>
                    <label class="pr5"><?php echo $data['nom']; ?></label>
                    <label class="pr5"><?php echo $data['prenom']; ?></label>
                    <label class="left"><?php echo $data['age']; ?></label>
                </li>
                <div><a id="retour" class="btn1" >Retour</a></div>
            </ul>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#retour').click(function () {
        $('#main').show();
        $("#edit").remove();
    });
</script>
