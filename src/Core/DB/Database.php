<?php

namespace Core\DB;
use \PDO;
class Database {

	// Création de la connexion PDO
	const DB_HOST = 'localhost';
	const DB_NAME = 'avatarpixel';
	const DB_USER = 'root';
	const DB_PASSWORD = '';
	
	function getPDOConnexion() {

		$pdo = new PDO ('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASSWORD, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
		$pdo->exec('SET NAMES UTF8');
		return $pdo;
	}

	// Requête SQL (paramètres, éxécution, résultats) utilisable dans tous les cas grâce aux paramètres
	function queryAll($sql, array $params = []) {

		$query = $this->executeQuery($sql, $params);
		return $query->fetchAll();
	}

	//
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

		$pdo = $this->getPDOConnexion();
		$query = $pdo->prepare($sql);
		$query->execute($params);
		return $query;
	}
}
