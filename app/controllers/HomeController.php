<?php /** @noinspection PhpDocMissingThrowsInspection */

namespace App\controllers;

use App\components\Database;
use DateTime;
use League\Plates\Engine;
use \Tamtamchik\SimpleFlash\Flash;

class HomeController
{
    private $view;
    private $database;
    private $flash;

    /**
     * HomeController constructor.
     *
     * @param Engine $view
     * @param Database $database
     * @param Flash $flash
     */
    public function __construct(Engine $view, Database $database, Flash $flash)
    {
        $this->view = $view;
        $this->database = $database;
        $this->flash = $flash;
    }

    /**
     * Показываем главную страницу сайта
     */
    public function index()
    {
//        $news = $this->database->getFirstLastRows("news", 4, true);
//        $images = $this->database->getAll("slider_images");

        echo $this->view->render('home');
    }
}