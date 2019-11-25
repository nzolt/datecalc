<?php


namespace App\Controller;


use App\Data\NameValidator;
use App\Data\Validators\Exceptions\InvalidDateException;
use App\Data\Validators\Exceptions\InvalidNameException;
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
    protected $dateError;
    protected $nameError;

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
        $requestVars = $this->getRequestObject();
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
        $request = $this->getRequestObject();
        try{
            $dateDTO = new DTOdateTime($request->getPost('date'), $request->getPost('name'));
            if($dateDTO !== false){
                $this->sessionManager->addDate($dateDTO->__toArray());
            }
        } catch (InvalidDateException $e){
            $this->dateError = $e->getMessage();
        } catch (InvalidNameException $e){
            $this->nameError = $e->getMessage();
        }

        $this->setNewCsrfToken();
        return [
            'csrft' => $this->sessionManager->getCsrf(),
            'dates' => $this->sessionManager->getDates(),
            'dateError' => $this->dateError,
            'nameError' => $this->nameError,
            ];
    }

    protected function getRequestObject()
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