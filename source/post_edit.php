<?php


if(!isset($_GET['id'])) {
    header('location: index.php?q=posts');
} else {
    //current value for post
    $sql= "SELECT title, body FROM posts WHERE id= :id";
    $stmt=$db_connect->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);

    if(((isset($_POST['update_title']))) && (empty($_POST['update_body']))) {
        $sql2="UPDATE posts SET title= :update_title WHERE id= :current_id";
        $stmt2= $db_connect->prepare($sql2);
        $stmt2->bindParam(':update_title', $_POST['update_title']);
        $stmt2->bindParam(':current_id', $_GET['id']);
        $stmt2->execute();
        header('location:index.php?q=posts');
    } elseif((isset($_POST['update_body'])) && (empty($_POST['update_title']))) {
        $sql2="UPDATE posts SET body= :update_body WHERE id= :current_id";
        $stmt2= $db_connect->prepare($sql2);
        $stmt2->bindParam(':update_body', $_POST['update_body']);
        $stmt2->bindParam(':current_id', $_GET['id']);
        $stmt2->execute();
        header('location:index.php?q=posts');
    } elseif((isset($_POST['update_body'])) && (isset($_POST['update_title'])))  {
        $sql2= "UPDATE posts SET title= :update_title, body= :update_body WHERE id= :current_id";
        $stmt2= $db_connect->prepare ($sql2);
        $stmt2->bindParam(':update_title', $_POST['update_title']);
        $stmt2->bindParam(':update_body', $_POST['update_body']);
        $stmt2->bindParam(':current_id', $_GET['id']);
        $stmt2->execute();
        header('location:index.php?q=posts');
    }

    ?>

    <h1>Edytuj Post</h1>
    <div>
        Obecny tytuł postu
        </br>
        <?php echo $result['title']; ?>
    </div>
    <div>
        <form method="POST">
            <div class="input-group mb-3">
            <!--<span class="input-group-text" id="basic-addon1">Temat</span>-->
            <input type="text" class="form-control" name="update_title" placeholder="Nowa tytuł tematu" aria-label="Update title" aria-describedby="basic-addon1">
    </div>
    <div>
    Obecna treść postu
    </br>
    <?php echo $result['body']; ?>
    </div>
    <div>
        <form method="POST">
            <div class="input-group mb-3">
            <!--<span class="input-group-text" id="basic-addon1">Temat</span>-->
            <input type="text" class="form-control" name="update_body" placeholder="Nowa treść postu" aria-label="Update body" aria-describedby="basic-addon1">
    </div>
    </br>
    <div class = "form-group">
        <button class ="btn btn-success btn-lg">Edytuj</button>
    </div>
    </form>
    </div>
    <?php 
}