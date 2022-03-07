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
    </br>
    <!--title-->
    <form method="POST">
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Obecny tytuł postu</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php 
                if(!empty($result['title'])){
                    echo $result['title'];
                } else {
                        echo 'Post nie posiada tytułu.';
                    }
                ?>">
            </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Nowy tytuł postu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Wprowadź tytuł" name="update_title">
            </div>
    </div>
    </br>
    <!--body-->
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Obecna treść postu</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php 
                if(!empty($result['body'])){
                    echo $result['body'];
                } else {
                    echo 'Post nie posiada treści.';
                }
                ?>">
            </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Nowa treść postu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Wprowadź treść" name="update_body">
            </div>
    </div>
    </br>
    <div class = "form-group">
        <button class ="btn btn-success">Edytuj</button>
        <a href="index.php?q=posts"><button class="btn btn-secondary">Anuluj</button></a>
    </div>
    </form>
<?php 
}