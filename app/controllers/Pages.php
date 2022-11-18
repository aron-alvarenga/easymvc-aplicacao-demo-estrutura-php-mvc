<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  // metodo index() é obrigatorio em todos os controllers criados
  public function index()
  {

    $data = [
      'titleHTML' => ' - Minha estrutura MVC favorita',
      'title' => 'EasyMVC',
      'description' => 'Minha estrutura favorita para padrão de arquitetura MVC usando PHP'
    ];

    $this->view('pages/index', $data);
  }

  public function about()
  {
    $data = [
      'titleHTML' => ' - Sobre Mim',
      'title' => 'Sobre Mim',
      'description' => 'Me chamo Aron Alvarenga e atualmente sou desenvolvedor PHP/Laravel.'
    ];
    $this->view('pages/about', $data);
  }
}
