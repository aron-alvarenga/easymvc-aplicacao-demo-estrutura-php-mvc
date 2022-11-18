<?php

/*
Classe Principal
Cria as URLs e carrega o Controller Principal
Formato da URL = /controller/metodo/parametros
*/
class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    // print_r($this->getUrl());

    $url = $this->getUrl();

    // Buscando nos controllers se existe um arquivo na pasta controllers correspondente ao primeiro valor da URL
    if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {

      // Se existir, configurar o controller correspondente
      $this->currentController = ucwords($url[0]);

      // Zerando o indice 0 (Correspondente ao Controller)
      unset($url[0]);
    }

    // Requisitar o Controller atual
    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instanciar a class do controller atual
    $this->currentController = new $this->currentController;

    // CHECANDO A SEGUNDA PARTE DA URL (Correspondente ao metodo)
    if (isset($url[1])) {

      // Checando se existe o metodo no controller
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];

        // Zerando o indice 1 (Correspondente ao Metodo)
        unset($url[1]);
      }
    }

    // Pegando os parametros do que restou do Array $url
    $this->params = $url ? array_values($url) : [];

    // Chamando o callback com Array de parametros
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  } // >>FIM DA FUNCAO __contruct()

  public function getUrl()
  {
    if (isset($_GET['url'])) {
      // Retirando a ultima / da URL
      $url = rtrim($_GET['url'], '/');
      // Retirando caracteres ilegais da URL
      $url = filter_var($url, FILTER_SANITIZE_URL);
      // Criando um array a partir da URl
      $url = explode('/', $url);
      return $url;
    } else {
      // Caso a URL nao apresentar nenhum valor (Controller/Metodos/Atributos), o padrao Pages sera retornado
      return ['pages'];
    }
  } // >>FIM DA FUNCAO getUrl()
}
