<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 25/06/17
 * Time: 11:15
 */

namespace App\Controller;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController
 * @package App\Controller
 * @Controller
 * @Route("/panel")
 */
class PanelController extends AbstractController
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
     * @Get(name="/", alias="photoevent.panel.index")
     * @return Response
     */
    public function indexAction(Request $request, Response $response) {
        $settings = $this->_ci->get('settings');
        $pathPhoto = $settings['photo']['save-path'];

        $arrayPhotos = [];
        $iteratorDirectory = new \DirectoryIterator($pathPhoto);

        foreach ($iteratorDirectory as $filename) {
            if ($filename->isDot()) continue;
            if ($filename->getFilename()[0] == ".") continue;

            $arrayPhotos[] = array(
                "path_full" => $filename->getPathname(),
                "filename" => $filename->getFilename()
            );
        }

        $dirAbsoluteSave = basename($pathPhoto);

        $this->setAttributeView('dirsave', $dirAbsoluteSave);
        $this->setAttributeView('arrayPhotos', $arrayPhotos);

        return $this->view->render($response, 'Panel/index.twig', $this->getAttributeView());
    }
}