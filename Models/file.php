<?php
    namespace Models;

    class File{
        public $fileName;
        public $fileType;
        public $fileSize;
        public $fileTmp;

        public function __construct($fileName, $fileType, $fileSize, $fileTmp){
            $this->fileName = $fileName;
            $this->fileType = $fileType;
            $this->fileSize = $fileSize;
            $this->fileTmp = $fileTmp;
        }

        public function getName(){return $this->fileName;}

        public function setName($fileName){$this->fileName = $fileName;}

        public function getType(){return $this->fileType;}

        public function setType($fileType){$this->fileType = $fileType;}

        public function getSize(){return $this->fileSize;}
        
        public function setSize($fileSize){$this->fileSize = $fileSize;}

        public function getTmp(){return $this->fileTmp;}
        
        public function setTmp($fileTmp){$this->fileTmp = $fileTmp;}
    }



?>