<?php
/* LA COMMANDE QUI TUE !!!!!!
 * sudo chmod -R 777 myDossier/
 */
require "Upload.php";

use Hysterias\Upload;


$i = 0;
$arrayFile = array();
foreach ($_FILES as $files) {
    foreach ($files as $key => $infoFile) {
        foreach ($infoFile as $idFile => $value) {
            $arrayFile[$idFile][$key] = $value;
        }
    }
}

foreach ($arrayFile as $fichier) {
    $upload[$i] = new Upload($i);
    $upload[$i]->setFile($fichier);
    $upload[$i]->upload();
    $i++;
}

/*echo "<pre>";
print_r($upload);
echo "</pre>";*/
header('Location: index.php');
exit();
