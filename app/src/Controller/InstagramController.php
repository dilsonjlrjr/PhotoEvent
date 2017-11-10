<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 06/11/2017
 * Time: 13:57
 */

namespace App\Controller;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use GuzzleHttp\Client as GuzzClient;

/**
 * Class HomeController
 * @package App\Controller
 * @Controller
 * @Route("/instagram")
 */
class InstagramController extends AbstractController
{
    /**
     * InstagramController constructor.
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        parent::__construct($ci);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @Get(name="/get/json/hashtag", alias="photoevent.instagram.getjsonhashtag")
     * @return Response
     */
    public function indexAction(Request $request, Response $response) {

        $hashtag = $request->getQueryParam('name');

        $client = new GuzzClient(['base_uri' => 'https://www.instagram.com']);
        $requestGuzz = $client->request("GET", "/explore/tags/$hashtag/?__a=1");
        echo $requestGuzz->getBody();

    }

}