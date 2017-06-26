<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 20/04/16
 * Time: 14:14
 */

namespace App\Model\Photo\Template;

use App\Facilitator\App\ContainerFacilitator;
use App\Model\Image\ImageWideImage;
use WideImage\WideImage;

abstract class AbstractPhotoTemplate implements IPhotoTemplate
{

    private $save_path;

    private $extension;

    protected $path_file;

    /**
     * AbstractPhotoTemplate constructor.
     */
    public function __construct()
    {
        $ci = ContainerFacilitator::getContainer();
        $configPhoto = $ci->get('settings')->get('photo');

        $this->save_path = $configPhoto['save-path'];
        $this->extension = $configPhoto['extension-save'];
    }

    public function save($binary)
    {
        if (!is_dir($this->save_path))
            mkdir($this->save_path);

        $filename_saved = tempnam($this->save_path, "saved_");
        unlink($filename_saved);

        $filesaved = $filename_saved . $this->extension;
        file_put_contents($filesaved, $binary);
        
        return $filesaved;
    }

    public function getPathFile() {
        return $this->path_file;
    }

    public function setPathFile($pathFile) {
        $this->path_file = $pathFile;
    }

    public function fabImageWideImage($pathFilename) {
        return new ImageWideImage($pathFilename);
    }

    abstract function make();
}