<?php
/**
 * User: dilsonrabelo
 * Date: 26/08/16
 * Time: 20:40
 */

namespace App\Controller;


use App\Facilitator\App\SessionFacilitator;
use Interop\Container\ContainerInterface;
use RKA\Session as SessionSlim;
use Slim\Views\Twig;

abstract class AbstractController
{

    protected $_databaseManager;

    /**
     * @var ContainerInterface $_ci
     */
    protected $_ci;

    /**
     * @var SessionSlim
     */
    private $session;

    /**
     * @var Twig
     */
    protected $view;

    /**
     * @var array
     */
    protected $attributeView;

    /**
     * AbstractAction constructor.
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        $this->_ci = $ci;
        $this->_dm = $ci->get('database');
        $this->session = $this->_ci->get('session');
        $this->view = $this->_ci->get('view');
        $arraySession = SessionFacilitator::getAttributeSession();

        $this->setAttributeView('attributeSession', $arraySession);
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setAttributeView($key = '', $value = '') {
        $this->attributeView[$key] = $value;
    }

    /**
     * @return array
     */
    public function getAttributeView() {
        return $this->attributeView;
    }

}