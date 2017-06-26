<?php

namespace Templates\Template1;


use App\Model\Photo\Template\AbstractPhotoTemplate;

class Photo extends AbstractPhotoTemplate
{
    CONST TEMPLATE_RESOURCE_PATH = __DIR__ . "/Resources";

    /**
     * @var ImageWideImage
     */
    private $template;

    /**
     * @var ImageWideImage
     */
    private $baloons;

    /**
     * @var ImageWideImage
     */
    private $image;

    public function make()
    {
        $this->template = parent::fabImageWideImage(self::TEMPLATE_RESOURCE_PATH . "/template.png" );
        $this->baloons = parent::fabImageWideImage(self::TEMPLATE_RESOURCE_PATH . "/resource-1.png" );
        $this->image = parent::fabImageWideImage($this->getPathFile());

        $this->template->setLeft("right-25")->setTop("bottom-105")->setOpacity(100)->merge($this->image->get());
        $temporaryFile = $this->template->saveTemporaryFile();

        $this->image = NULL;
        $this->image = parent::fabImageWideImage($temporaryFile);

        $this->image->setLeft(0)->setTop(0)->setOpacity(100)->merge($this->baloons->get());
        return $this->save($this->image->get());
    }

}