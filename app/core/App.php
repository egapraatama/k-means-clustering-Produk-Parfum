<?php 

class App {


    protected $controller = 'Landingpage'; // Ganti 'Home' jadi 'Landingpage' atau 'Login'
    // protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

  
    public function __construct() 
    {
        $url = $this->parseUrl();

        if( isset($url[0]) ) {
            if(file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }
        // var_dump($url); 

            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller =  new $this->controller;


            // Kita bikin method 
            if(isset($url[1])) {
              if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]); 
            }
        }
            //params
            if(!empty($url)) {
                $this->params = array_values($url); 
            }

            // Jalankan controllers & method, serta kirimkan params jika ada
            call_user_func_array([$this->controller, $this->method], $this->params);
 


    }   


   public function parseUrl() 
   {

    if(isset($_GET ['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var   ($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);  
        return  $url;
    }
    return [];
   }


}
