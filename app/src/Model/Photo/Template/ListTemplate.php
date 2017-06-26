<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 19/06/17
 * Time: 21:55
 */

namespace App\Model\Photo\Template;


use App\Facilitator\App\ContainerFacilitator;
use App\Model\Image\ImageBase64;

class ListTemplate
{

    private function iteratorTemplates($pathTemplates) {
        $arrayReturn = [];

        foreach (new \DirectoryIterator($pathTemplates) as $fileInfo) {
            if($fileInfo->isDot() || (!$fileInfo->isDir())) continue;

            $path = $fileInfo->getPath() . DIRECTORY_SEPARATOR . $fileInfo->getFilename();
            $arrayAttribute = $this->iteratorConfiguration($path);
            if (count($arrayAttribute) > 0) {
                $arrayReturn[] = $this->iteratorConfiguration($path);
            }
        }

        return $arrayReturn;
    }

    private function iteratorConfiguration($path) {

        $arrayReturn = [];

        $directoryIterator = new \RecursiveDirectoryIterator($path);
        $directoryRegex = new \RecursiveRegexIterator($directoryIterator, '/config\.json/', \RecursiveRegexIterator::GET_MATCH);

        foreach ($directoryRegex as $key => $fileInfoRegex) {
            $arrayJson = json_decode(file_get_contents($path . DIRECTORY_SEPARATOR . $fileInfoRegex[0]));
            $fileImage = $path . DIRECTORY_SEPARATOR . $arrayJson->example;

            $image64 = new ImageBase64();
            $arrayReturn['templateImgBase64'] = $image64->castPathFile($fileImage);
            $arrayReturn['templateName'] = $arrayJson->name;
            $arrayReturn['templateClass'] = $arrayJson->class;
        }

        return $arrayReturn;
    }

    public function getAll() {
        $ci = ContainerFacilitator::getContainer();
        $pathTemplates = $ci->get('settings')->get('path-templates');
        return $this->iteratorTemplates($pathTemplates);
    }
}