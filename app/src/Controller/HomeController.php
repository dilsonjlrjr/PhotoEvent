<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 26/08/16
 * Time: 21:16
 */

namespace App\Controller;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController
 * @package App\Controller
 * @Controller
 */
class HomeController extends AbstractController
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
     * @Get(name="/", alias="photoevent.home.index")
     * @return Response
     */
    public function indexAction(Request $request, Response $response) {
        return $this->view->render($response, 'Home/index.twig', $this->getAttributeView());
    }
}