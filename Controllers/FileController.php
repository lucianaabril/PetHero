<?php
    namespace Controllers;
    use DAO\MascotaDAO as MascotaDAO;

    class FileController{
    private $uploadFilePath;
    private $allowedExtensions;
    private $maxSize;

    function __construct()
    {
        $this->allowedExtensions = array('png', 'jpg', 'gif');
        $this->maxSize = 5000000;
        $this->uploadFilePath = "img\\";
    }

    public function getAllowedExtensions(){ return $this->allowedExtensions;}

    public function getMaxSize(){return $this->maxSize;}

    public function upload(){
        $parameters = $_FILES;
        $locations = array();

        foreach($parameters as $i){
            $fileName = $i["name"];
            $fileType = $i["type"];
            $fileSize = $i["size"];
            $fileTmp = $i["tmp_name"];

            $fileType = substr($fileType, 6);
            $filePath = $this->uploadFilePath . "$fileType\\";

            //crear directorio
            if(!file_exists($filePath)){
                mkdir($filePath, 0777, true);
            }

            $fileLocation = $filePath . $fileName; //ruta completa con el nombre del archivo

            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); //obtenemos la extensión del archivo

            if(in_array($fileExtension, $this->allowedExtensions)){ //verifica la extensión 
                if($fileSize < $this->maxSize){ //verifica el tamaño
                    if(move_uploaded_file($fileTmp, $fileLocation)){ //mueve el archivo desde la ruta temporal a uploads
                        require_once(VIEWS_PATH . 'duenio-page.php');
                    }
                }
            }

            $fileLocation = "..\\" . $fileLocation;
            array_push($locations, $fileLocation);
        }
        return $locations;
        //$this->setFileToMascota($locations);
    }

    public function setFileToMascota($locations){
        $MascotaDAO = new MascotaDAO();
        $last = $MascotaDAO->last();
        $last->setFoto($locations[0]);
        $last->setVacunacion($locations[1]);
        $last->setVideo($locations[2]);
        $MascotaDAO->Add($last);
    }


}
