<?php
class App {

    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        if(file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

//         Если функция должна принимать параметры, то вам необходимо установить проверку:
//         Предположим что контроллер contact и в нем функция about должна принимать один параметр
//         Мы добавляем сюда тогда проверку

        $correctUrl = false; // Изначально наш URL думаем что некорректный
        // Если контроллер Contact и метод называется about
        // и количество дополнительных параметров меньше или равно 1,
        // то в таком случае это нормальный URL и не нужно вызывать страницу 404
        if(is_a($this->controller, 'Contact') && $this->method == 'about' && count($this->params) <= 1)
            $correctUrl = true; // Здесь говорим что URL корректный

        // Дополнительная проверка

        else if(is_a($this->controller, 'Categories') && $this->method == 'index' && count($this->params) <= 1)
            $correctUrl = true; // Здесь говорим что URL корректный
        else if(is_a($this->controller, 'User') && $this->method == 'reg' && count($this->params) <= 1)
            $correctUrl = true; // Здесь говорим что URL корректный
        else if(is_a($this->controller, 'User') && $this->method == 'daschboard' && count($this->params) <= 1)
            $correctUrl = true; // Здесь говорим что URL корректный
        else if(is_a($this->controller, 'User') && $this->method == 'auth' && count($this->params) <= 1)
            $correctUrl = true; // Здесь говорим что URL корректный
        else if(is_a($this->controller, 'Contact') )
            $correctUrl = true; // Здесь говорим что URL корректный
        elseif (is_a($this->controller, 'Categories'))
            $correctUrl = true; // Здесь говорим что URL корректный
        elseif (is_a($this->controller, 'Product') )
            $correctUrl = true; // Здесь говорим что URL корректный
        elseif (is_a($this->controller, 'Bas') )
            $correctUrl = true; // Здесь говорим что URL корректный
        // Если переменная $correctUrl равна false и параметров больше чем 0, то выдаем страницу 404
        if(count($this->params) != 0 && !$correctUrl)
            $this->errorPage404();

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(
                rtrim($_GET['url'], '/'),
                FILTER_SANITIZE_STRING
            ));
        }
    }

    public function errorPage404() {
        $host = '/404.php';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location: '.$host);
    }
}