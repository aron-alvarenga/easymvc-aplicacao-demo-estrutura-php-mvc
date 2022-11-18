<?php

/**
 * Controlador Principal
 * Carrega os Models e Views
 */
class Controller
{
  // Carrega Model
  public function model($model)
  {
    // Puxando arquivo do Model
    require_once '../app/models/' . $model . '.php';

    // Instanciando Model
    return new $model();
  }

  // Carrega View
  public function view($view, $data = [])
  {
    // Checar se existe arquivo view correspondente
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once '../app/views/' . $view . '.php';
    } else {
      // Caso a o arquivo view nao existir
      die('Esta página não existe!');
    }
  }
}
