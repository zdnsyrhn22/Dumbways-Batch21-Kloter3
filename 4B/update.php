<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$db = new databases;

$id = $_GET["id"];

$a = $db->query("SELECT *, autho.id AS a_id, autho.name AS a_name, article.image AS a_image, category.id AS c_id, category.name AS c_name, article.id AS art_id  FROM article 
JOIN autho ON article.id_user = autho.id
JOIN category ON article.id_category = category.id
WHERE article.id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil di tambahkan atau tidak
    if ($db->update($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
    }
}
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
            <div class="col mt-5">
                <h2 class="mb-3">Form Update Article</h2>

                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="imageLama" value="<?= $a["a_image"] ?>">
                    <input type="hidden" name="id_user" value="<?= $_SESSION['login']['id']; ?>">
                    <input type="hidden" name="created_at" value="<?= date("Y-m-d h:i:s"); ?>">
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" value="<?= $a['title']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category" name="category">
                                <option selected value="<?= $a['id_category']; ?>"><?= $a['c_name']; ?></option>
                                <option value="1">Sport</option>
                                <option value="2">Tech</option>
                                <option value="3">Sejarah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="content" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="content" name="content" rows="3"> <?= $a['content']; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Cover</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>

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