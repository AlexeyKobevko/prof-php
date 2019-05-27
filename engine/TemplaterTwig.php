<?php


namespace app\engine;


use app\traits\Tsinglton;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplaterTwig
{
    use Tsinglton;

    public $twig;

    protected function __construct()
    {

        $loader = new FilesystemLoader(TPL_DIR);

        $this->twig = new Environment($loader, $params = []);
    }
}