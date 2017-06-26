<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 22/10/15
 * Time: 21:01
 */

namespace App\Model\Image;

use WideImage\WideImage;

class ImageWideImage
{

    private $left = NULL;
    private $top = NULL;
    private $opacity = 100;

    /**
     * @var \WideImage\Image|\WideImage\PaletteImage|\WideImage\TrueColorImage
     */
    protected $image;

    /**
     * ImageWideImage constructor.
     */
    public function __construct($pathImage)
    {
        $this->image = WideImage::load($pathImage);
    }

    public function load($pathImage) {
        $this->image = WideImage::load($pathImage);
    }

    public function merge($newImage)
    {
        $this->image = $this->image->merge($newImage, $this->left, $this->top, $this->opacity);
    }

    public function resizePercent($percent)
    {
        $this->image = $this->image->resize($percent);
    }

    public function get()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param mixed $left
     * @return ImageWideImage
     */
    public function setLeft($left)
    {
        $this->left = $left;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * @param mixed $opacity
     * @return ImageWideImage
     */
    public function setOpacity($opacity)
    {
        $this->opacity = $opacity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param mixed $top
     * @return ImageWideImage
     */
    public function setTop($top)
    {
        $this->top = $top;
        return $this;
    }

    public function getWidth()
    {
        return $this->image->getWidth();
    }

    public function getHeight()
    {
        return $this->image->getHeight();
    }

    public function saveTemporaryFile() {
        $temporaryFile = tempnam(sys_get_temp_dir(), 'TMP_');
        file_put_contents($temporaryFile, $this->get());
        return $temporaryFile;
    }

}