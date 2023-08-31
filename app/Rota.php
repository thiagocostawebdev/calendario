<?php

class Rota {

    private $controlador = 'home';
    private $metodo = 'index';
    private $parametros = [];

    public function __construct()
    {
        $url = $this->url() ? $this->url() : [0];
        
        //Verifica a arquivo da classe existe se não mantém a "home".
        if(file_exists('./app/'.ucwords($url[0]).'.php')): 
            $this->controlador = ucwords($url[0]);
            unset($url[0]);
        endif;
        require_once './app/'.$this->controlador.'.php';
        $this->controlador = new $this->controlador;
        
        //Verifica se o metodo existe na classe,caso não, chama o método "index".
        if(isset($url[1])):
            if(method_exists($this->controlador,$url[1])):
                $this->metodo = $url[1];
                unset($url[1]);
            endif;
        endif;

        $this->parametros = $url ? array_values($url) : [""];
        //Chama o métodos conforme a url, por padrão chama home->index.
        call_user_func_array([$this->controlador,$this->metodo],$this->parametros); 
    }

        private function url(){
            $url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL); //Filtra a $url
            if(isset($url)):
                $url = trim(rtrim($url,'/')); //Remove espaço no inicio e final da $url
                $url = explode('/', $url); //Divide a string $url em vetor para cada '/'
                return $url;
            endif;     
        }
}