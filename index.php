<?php
if ($_GET['delete']) {
    echo $_GET['delete'];
    unlink("images/" . $_GET['delete']);
    header('Location: index.php');
    exit();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Page Description">
    <meta name="author" content="hysterias">
    <title>Laisse pas trainer ton file</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <h1>Envoi d'image</h1>
    <div class="row thumbnail">
        <div class="col-sm-10 col-md-10">
            <form action="upload.php" method="post" role="form" class="form-inline"
                  enctype="multipart/form-data">
                <div class="form-group text-left">
                    <label for="img">Vos Images</label>
                    <input type="file" name="img[]" id="img" multiple>
                </div>
        </div>
        <div class="col-sm-2 col-md-2 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

        </form>
    </div>
    <div class="row">
        <?php
        $dir = "images/";
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..' && $file != '.git' && $file != '.idea') {
                        if (filetype($dir . $file) === "dir") {
                            echo $file;
                        }
                        if (filetype($dir . $file) === "file") {
                            $path_parts = pathinfo($dir . $file);
                            ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="<?php echo $dir . $file; ?>" alt="<?php echo $file; ?>"
                                         style="max-height: 180px;" class="img-thumbnail">
                                    <div class="caption">
                                        <h3><?php echo $path_parts['filename']; ?></h3>
                                        <p><?php
                                            echo "Dossier : " . $path_parts['dirname'] . "<br />";
                                            echo "Nom du fichier : " . $path_parts['basename'] . "<br />";
                                            echo "Type : " . $path_parts['extension'] . "<br />";

                                            ?></p>
                                        <p>
                                            <a href="<?php echo $dir . $file; ?>" target="_blank"
                                               class="btn btn-primary"
                                               role="button"><i class="glyphicon glyphicon-fullscreen"></i></a>
                                            <a href="?delete=<?php echo $file; ?>" class="btn btn-danger"
                                               role="button"><i class="glyphicon glyphicon-trash"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                closedir($dh);
            }
        }

        ?>
    </div>
</div>
<!--Désolé pour le troll mais j'étais obligé-->
<iframe width="0" height="0"
        src="https://www.youtube.com/embed/biYdUZXfz9I?rel=0&controls=0&showinfo=0&autoplay=1&loop=1 "
        frameborder="0"
        allowfullscreen></iframe>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</body>
</html>




