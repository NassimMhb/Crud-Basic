<?php
require 'database.php';
    $id=0; 
  if(!empty($_POST['id'])){
        $id=$_REQUEST['id']; 
    } 
  if(!empty($_GET)){
    $id= $_GET['id'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM utilisateurs WHERE ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#main').hide();
 </script>
<div id="delete"> 
    <div class="container">
        <br />
        <div>
            <br />
            <div>
                <br />
                <h3>Supprimer un utilisateur</h3>
            </div>                   
            <br />
            <form action="delete.php?id=<?php echo $id ;?>" method="post">
                <input type="hidden"/>Voulez-vous vraiment supprimer l'utilisateur ?
                <br /><br />
                <div>
                    <button type="submit" class="btn3">Oui</button>
                    <a class="btn1" href="index.php">Non</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
      $('#retour').click(function () {
        $('#main').show();
        $("#delete").remove();
      });
</script>
