<?php

namespace App\Model\Photo;

use App\Model\Photo\Template\AbstractPhotoTemplate;

/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 20/06/17
 * Time: 15:39
 */
class MakePhoto
{
    /**
     * @var AbstractPhotoTemplate
     */
    private $classTemplate;

    /**
     * @var string
     */
    private $pathFile;

    public function setClassTemplate(AbstractPhotoTemplate $class) {
        $this->classTemplate = new $class;
        return $this;
    }

    public function setPathFile($pathFile) {
        $this->pathFile = $pathFile;
        return $this;
    }

    public function make() {

        $this->classTemplate->setPathFile($this->pathFile);
        return $this->classTemplate->make();
    }
}