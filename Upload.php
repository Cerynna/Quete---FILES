<?php
/**
 * Created by PhpStorm.
 * User: hysterias
 * Date: 09/10/17
 * Time: 22:01
 */

namespace Hysterias;


class Upload
{
    const MAX_SIZE = 1048576;
    const EXTENSIONS = array('png', 'gif', 'jpg', 'jpeg');
    const DIR = 'images/';
    /**
     * @array
     */
    private $num;
    /** @var   */
    private $file;

    /**
     * Upload constructor.
     * @param $num
     */
    public function __construct($num)
    {
        $this->num = $num;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     * @return Upload
     */
    public function setNum($num)
    {
        $this->num = $num;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->num;
    }

    /**
     * @param mixed $file
     * @return Upload
     */
    public function setFile($file)
    {

        $arrayFile['name']= $file["name"] ;
        $arrayFile["type"] = $file["type"];
        $arrayFile["tmp_name"] = $file["tmp_name"];
        $arrayFile["error"] = $file["error"];
        $arrayFile["size"] = $file["size"];
        $arrayFile["ext"] = pathinfo($file['name'], PATHINFO_EXTENSION);
        $arrayFile["newName"] = "image" . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0 ,10) . "." . $arrayFile["ext"];
        $arrayFile["path"] = self::DIR . $arrayFile["newName"];
        $this->file = $arrayFile;
        return $this;
    }

    public function upload()
    {
        if(!in_array($this->file["ext"], self::EXTENSIONS)) //Si l'extension n'est pas dans le tableau
        {
            $erreur['ext'] = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg';
            $this->erreur = $erreur;
            return $this;
        }
        if($this->file["size"]>self::MAX_SIZE)
        {
            $erreur['size'] = 'Le fichier est trop gros...';
            $this->erreur = $erreur;
            return $this;
        }
        if (file_exists($this->file["path"])) {
            $erreur['path'] = "Le fichier existe déjà";
            $this->erreur = $erreur;
            return $this;
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            if(move_uploaded_file($this->file['tmp_name'], $this->file["path"]))
            {
                chmod($this->file["path"], 0777);
                $erreur['valid'] = 'Upload effectué avec succès !';
                $this->erreur = $erreur;
                return $this;
            }
            else
            {
                $erreur['fail'] = 'Echec de l\'upload !';
                $this->erreur = $erreur;
                return $this;
            }
        }
        else
        {
            $this->erreur = $erreur;
            return $this;
        }
    }

}
