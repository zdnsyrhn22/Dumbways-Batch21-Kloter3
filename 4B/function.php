<?php

class databases
{
    protected $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "portal_berita");
    }

    public function query($query)
    {
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find($table, $column, $value)
    {
        $query = "SELECT * FROM $table WHERE $column='$value'";
        $result = mysqli_query($this->conn, $query);

        return mysqli_fetch_assoc($result);
    }

    function tambah($data)
    {

        $title = htmlspecialchars($data["title"]);
        $content = htmlspecialchars($data["content"]);
        $created_at = htmlspecialchars($data["created_at"]);
        $id_user = htmlspecialchars($data["id_user"]);
        $category = htmlspecialchars($data["category"]);
        //upload gambar
        $image = upload();
        if (!$image) {
            return false;
        }

        $query = "INSERT INTO article
                    VALUES
                  ('', '$title', '$content', '$image', '$created_at', '$id_user', '$category')
                ";
        mysqli_query($this->conn, $query);

        return mysqli_affected_rows($this->conn);
    }

    function delete($id)
    {

        mysqli_query($this->conn, "DELETE FROM article WHERE id = $id");
        return mysqli_affected_rows($this->conn);
    }

    function update($data)
    {
        $id = $data["id"];
        $title = htmlspecialchars($data["title"]);
        $content = htmlspecialchars($data["content"]);
        $created_at = htmlspecialchars($data["created_at"]);
        $id_user = htmlspecialchars($data["id_user"]);
        $category = htmlspecialchars($data["category"]);
        $imageLama = htmlspecialchars($data["imageLama"]);




        //cek apakah gambar diubah
        if ($_FILES['image']['error']) {
            $image = $imageLama;
        } else {
            $image = upload();
        }

        $query = "UPDATE article SET
                    title='$title',
                    content='$content',
                    image='$image',
                    created_at='$created_at',
                    id_user='$id_user',
                    id_category='$category',
                WHERE id= '$id' 
                ";
        mysqli_query($this->conn, $query);

        return mysqli_affected_rows($this->conn);
    }
}

function upload()
{
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    //cek apakah yang diupload gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('yang di inputkan bukan gambar');
        </script>";
        return false;
    }

    //cek ukuran gambar
    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('ukuran melebihi batas');
        </script>";
        return false;
    }

    //gambar siap di upload
    move_uploaded_file($tmpName, 'img/' . $namaFile);

    return $namaFile;
}
