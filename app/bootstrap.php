<?php
// Carrega as configuracoes
require_once 'config/config.php';

// Carrega as bibliotecas
// require_once 'libraries/core.php';
// require_once 'libraries/controller.php';
// require_once 'libraries/database.php';

// Auto Carregamento das principais bibliotecas
spl_autoload_register(function ($className) {
  require_once 'libraries/' . $className . '.php';
});
