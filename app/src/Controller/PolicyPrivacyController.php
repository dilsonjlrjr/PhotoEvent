<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 27/06/17
 * Time: 23:21
 */

namespace App\Controller;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class PolicyPrivacyController
 * @package App\Controller
 * @Controller
 * @Route("/policyprivacy")
 */
class PolicyPrivacyController extends AbstractController
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
     * @Get(name="/", alias="photoevent.policyprivacy.index")
     * @return Response
     */
    public function indexAction(Request $request, Response $response) {
        return $this->view->render($response, 'PolicyPrivacy/index.twig', $this->getAttributeView());
    }

}