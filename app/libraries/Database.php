<?php

/**
 * Class de Banco de Dados PDO
 * Conectar com Banco de Dados
 * Criar prepared statements
 * Valores de Vinculação (Bind Values)
 * Retornar linhas e resultados
 */
class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $dbh;
  private $stmt;
  private $error;

  // Construct para realizar a conexao
  public function __construct()
  {
    // Configurando o DSN (Database Source Name)
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

    // Configuracoes adicionais PDO
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    // Criando uma instancia PDO
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  // Prepara a declaracao com a consulta
  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  // BindValue() 
  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  // Executando a declaracao preparada
  public function execute()
  {
    return $this->stmt->execute();
  }

  // Puxando o resultado como um array de objetos
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Pegando um resultado unico com um objeto
  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  // Pegando o numero de linhas
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}
