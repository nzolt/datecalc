<?php


namespace App\Controller;


use Josantonius\Session\Session;
use Nette\Http\RequestFactory;
use Jenssegers\Blade\Blade;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Data\SessionManager;
use App\Data\DTOdateTime;

class IndexController
{
    protected $sessionManager;

    /**
     * IndexController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->sessionManager = new SessionManager();

    }

    /**
     * Genrate initial page
     * @return array
     */
    public function index()
    {
        $requestVars = $this->getRequestObjest();
        Session::destroy('dates');

        $this->setNewCsrfToken();
        return ['csrft' => $this->sessionManager->getCsrf(), 'dates' => $this->sessionManager->getDates()];
    }

    /**
     * Process the POST Request
     * @return array
     * @throws \Exception
     */
    public function process()
    {
        $requestVars = $this->getRequestObjest();
        $dateDTO = new DTOdateTime($requestVars->getPost('date'));
        if($dateDTO !== false){
            $this->sessionManager->addDate($dateDTO->__toArray());
        }

        $this->setNewCsrfToken();
        return ['csrft' => $this->sessionManager->getCsrf(), 'dates' => $this->sessionManager->getDates()];
    }

    protected function getRequestObjest()
    {
        // Create Request instance
        $factory = new RequestFactory;
        $request = $factory->fromGlobals();
        return $request;
    }

    protected function setNewCsrfToken()
    {
        $uuid1 = Uuid::uuid1();
        $uuid = $uuid1->toString();
        $this->sessionManager->setCsrf($uuid);
    }
}