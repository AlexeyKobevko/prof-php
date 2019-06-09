<?php


namespace app\controllers;


use app\interfaces\IRender;
use app\models\repositories\BasketRepository;
use app\models\repositories\UsersRepository;


abstract class Controller implements IRender
{
    protected $action;
    protected $layout = "main";
    protected $useLayout = true;

    private $renderer;

    public function __construct(IRender $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null) {
        $this->action = $action ?: 'index';
        $method = "action" . ucfirst($this->action);

        if (method_exists($this, $method)) {

            $this->$method();

        } else {
            echo "404";
        }
    }

    public function render($template, $params = []) {

        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'content' => $this->renderTemplate($template, $params),
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }

}