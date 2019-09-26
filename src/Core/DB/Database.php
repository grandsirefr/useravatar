<?php

namespace Core\DB;
use \PDO;


class Database implements DatabaseInterface {

	private $pdo;

	public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }

    // Requête SQL (paramètres, éxécution, résultats) utilisable dans tous les cas grâce aux paramètres
	function queryAll($sql, array $params = []) {

		$query = $this->executeQuery($sql, $params);
		return $query->fetchAll();
	}


	function queryOne ($sql, array $params = []) {

		$query = $this->executeQuery($sql, $params);
		return $query->fetch();
	}

	// Requête sql d'action
	function queryAction($sql, array $params = []) {

		$this->executeQuery($sql, $params);
	}
	
	//
	function executeQuery($sql, array $params = []) {

		$query = $this->pdo->prepare($sql);
		$query->execute($params);
		return $query;
	}
}
