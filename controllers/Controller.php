<?php


namespace app\controllers;

require_once '../vendor/autoload.php';

use app\engine\TemplaterTwig;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected $action;
    protected $layout = "index";
    protected $useLayout = true;

    protected $template;
    protected $twig;

    public $session;

    public function __construct()
    {
        $this->session = &$_SESSION;
        $this->twig = TemplaterTwig::getInstance()->twig;
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
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params = []);
        }
    }

    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);
        $templatePath = "../views/templates/" . $template . ".php";
        if (file_exists($templatePath)) {
            include $templatePath;
        } return ob_get_clean();
    }

    public function renderTwig($template = null, $params = [])
    {
        if (!$template) {
            $template = $this->template;
        }
            $twig = $this->twig->load($template);
            $params = array_merge([
                'session' => $this->session,
            ], $params);
            return $twig->render($params);
    }

}