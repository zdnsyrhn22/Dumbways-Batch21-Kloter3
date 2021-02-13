<?php
session_start();
require 'function.php';

$db = new databases;

$article = $db->query("SELECT *, autho.id AS a_id, autho.name AS a_name, article.image AS a_image, category.id AS c_id, category.name AS c_name  FROM article 
JOIN autho ON article.id_user = autho.id
JOIN category ON article.id_category = category.id");


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <title>Portal Berita || Home</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Portal Berita</a>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="form-article.php">Buat Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="sport.php">Sport</a></li>
                            <li><a class="dropdown-item" href="tech.php">Tech</a></li>
                            <li><a class="dropdown-item" href="sejarah.php">Sejarah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION["login"])) {
                            echo '<a class="nav-link" href="login.php">Login</a>';
                        } else {
                            echo '<a class="nav-link" href="logout.php">logout</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-8 mt-5">
                <?php foreach ($article as $row) :  ?>
                    <div class="card mb-3" style="max-width: 720px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/<?= $row['a_image']; ?>" class="card-img" height="100%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['title']; ?> <span class="float-end"><?= $row['a_name']; ?></span></h5>
                                    <p class="card-text"><?= $row['content']; ?></p>
                                    <p class="card-text"><span><small class="text-muted"><?= $row['c_name']; ?></small></span><small class="text-muted float-end"><?= $row['created_at']; ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col mt-5 float-end">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">COMING SOON</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>