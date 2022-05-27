<?php 

namespace src\utils;

class Router {

    public Request $request;
    public Response $response;

    public array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {

        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if(!$callback) {
            $this->response->setStatusCode(404);
            return $this->renderView('404');
        }

        if(is_array($callback)) {
            Application::$application->setController(new $callback[0]);
            $callback[0] = Application::$application->getController();
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
        }

        call_user_func($callback, $this->request);

        // echo '<pre>'; var_dump($this->request->getFormInputs()); echo '</pre>';
    }

    public function renderView($view, $params = []) {
        $layout = $this->showLayout();
        $viewContent = $this->showOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layout);
    }

    public function showOnlyView($view, $params = []) {
        foreach($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOTH."/src/views/$view.php";
        include_once Application::$ROOTH."/src/views/newsletter.php";

        return ob_get_clean();
        
    }

    public function showLayout() {
        $layout = Application::$application->getController()->layout;
        ob_start();
        include_once Application::$ROOTH."/src/views/layout/$layout.php";
        return ob_get_clean();
    }
    // echo '<pre>'; var_dump($_SERVER['REQUEST_URI']); echo '</pre>';
}