<?php include("konektor.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog Programmer PHP</title>
    <link rel="icon" href="images/logo.png"/>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="bootstrap/css/style.css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
<body>
    <header>
        <!-- include file php external header -->
        <?php include("header.php");?>
    </header>

    <nav class="nav navbar-default"><?php include("menu.php"); ?></nav>

    <article>
        <div class="container wrap">
            <div class="row">
                <div class="col-md-12">
                <?php
                    $sql = mysqli_query($koneksi, "SELECT * FROM artikel");
                    while($result = mysqli_fetch_array($sql)){
                        echo $result['1']."<br>".$result['2']."<br>".$result['3']."<br>".$result['4']."<br>";
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- isi Script disini -->
    </article>

    <footer>
        <!-- include file php footer -->
        <?php include("footer.php"); ?>
    </footer>

</body>
</html>