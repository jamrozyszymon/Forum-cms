<?php

if(!isset($_GET['id'])) {
    header('location: index.php?q=topic');
} else {
    //current name of topic
    $sql= "SELECT name From topic WHERE id= :id";
    $stmt=$db_connect->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $res_name=$stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['update_name'])) {
        $sql2="UPDATE topic SET name= :update_name WHERE ID= :current_id";
        $stmt2= $db_connect->prepare($sql2);
        $stmt2->bindParam(':update_name', $_POST['update_name']);
        $stmt2->bindParam(':current_id', $_GET['id']);
        $stmt2->execute();
        header('location: index.php?q=topic');
    }
    ?>

    <h1>Edytuj Temat</h1>
    </br>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Obecna nazwa tematu</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php 
                if(!empty($res_name['name'])){
                    echo $res_name['name'];
                 } else{
                     echo 'Temat nie posiada nazwy';
                 } ?>">
            </div>
    </div>
    <form method="POST">
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Nowa nazwa tematu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" placeholder="Wprowadź nazwę" name="update_name">
                </div>
        </div>
        </br>
        <div class = "form-group">
            <button class ="btn btn-success">Edytuj</button>
            <a href="index.php?q=topic"><button class="btn btn-secondary">Anuluj</button></a>
        </div>
    </form>
<?php 
}
