<?php 
    class App{
        public function __construct(){
            $url = $this->parseUrl();
            //var_dump ($url);
            $controllerName = "{$url[0]}Controller";
            
            if(!file_exists("controllers/$controllerName.php"))
                $controllerName="HomeController";
                
            require_once "controllers/$controllerName.php";
            $controller = new $controllerName;
            $methodName = $url[1];
            
            
            if(!method_exists($controller,$methodName))
                $methodName="login";
            
            unset($url[0]);unset($url[1]);
            $params = $url ? array_values($url):Array();
            
            
            call_user_func_array(Array($controller,$methodName),$params);
            
        }
        public function parseUrl(){
            if(isset($_GET["url"])){
                $url=rtrim($_GET["url"],"/");
                $url = explode("/",$url);
                return $url;
            }
        }
    }
?>