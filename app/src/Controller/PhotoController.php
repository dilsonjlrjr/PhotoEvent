<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 26/08/16
 * Time: 21:16
 */

namespace App\Controller;

use App\Model\Image\ImageBase64;
use App\Model\Photo\MakePhoto;
use App\Model\Photo\Template\ListTemplate;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class PhotoController
 * @package App\Controller
 * @Controller
 * @Route("/photo")
 */
class PhotoController extends AbstractController
{
    /**
     * HomeController constructor.
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        parent::__construct($ci);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @Get(name="/", alias="photoevent.photo.index")
     * @return Response
     */
    public function indexAction(Request $request, Response $response) {
        return $this->view->render($response, 'Photo/index.twig', $this->getAttributeView());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     * @Post(name="/crop", alias="photoevent.photo.crop")
     */
    public function cropAction(Request $request, Response $response) {

        $fileUploaded = $request->getUploadedFiles();
        $fileUploaded = $fileUploaded['file-input-photo'];

        if ($fileUploaded->getError() === UPLOAD_ERR_OK) {
            $fileStream = $fileUploaded->getStream();
        } else {
            throw new \Exception('Fail moved file.');
        }

        $listTemplate = new ListTemplate();

        $base64 = new ImageBase64();
        $this->setAttributeView('photobase64', $base64->castBinary($fileStream->getContents()));
        $this->setAttributeView('arrayTemplate', $listTemplate->getAll());

        return $this->view->render($response, 'Photo/crop.twig', $this->getAttributeView());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     * @Post(name="/make", alias="photoevent.photo.make")
     */
    public function makeAction(REquest $request, Response $response) {

        $classTemplate = $request->getParam("option-template");
        $imageBase64 = $request->getParam("image");

        preg_match('/data:([^;]*);base64,(.*)/', $imageBase64, $arrayImage);
        $binaryImage =  base64_decode($arrayImage[2]);

        $temporaryFile = tempnam(sys_get_temp_dir(), 'TMP_');
        file_put_contents($temporaryFile, $binaryImage);

        $classTemplate = new $classTemplate();

        $makePhoto = new MakePhoto();
        $savedPhoto = $makePhoto->setPathFile($temporaryFile)->setClassTemplate($classTemplate)->make();

        $base64Convert = new ImageBase64();

        $imageBase64 = $base64Convert->castPathFile($savedPhoto);

        return $response->withJson([ "pictureedit" => $imageBase64 ]);
    }
}