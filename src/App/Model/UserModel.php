<?php

namespace App\Model;
use \PDO;
use Core\DB\Database;
use Core\DB\AbstractModel;
use \Exception;

// include_once 'Database.php';
// include_once 'AbstractModel.php';

class UserModel extends AbstractModel {


	// Ajouter un utilisateur, enregistrer ses infos dans la BDD
	public function create($firstname, $lastname, $email, $password,$avatar) {
		

		// Vérifier que l'email n'existe pas
		self::insert($email);
		// Si l'email existe, on lance une exception
		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$sql='INSERT INTO user(firstname,lastname,email,password,createdAt,avatar) VALUES (?,?,?,?,NOW(),?)';
		$this->db->queryAction($sql,[$firstname,$lastname,$email,$hashedPassword,$avatar]);
	}

	// Vérifier les infos rentrées à la connection, l'adresse mail existe ? Le mot de passe correspond ?
	public function checkUser($email, $password) {

		$sql='	SELECT Id, Lastname, Firstname, Email, Password 
				FROM User 
				WHERE Email = ?';

		// Le $email remplace le ? de la requête sql
		$user = $this->db->queryOne($sql,[$email]);

		// On vérifie le password
		if (!empty($user)) {

			// return $user;
			if (password_verify($password, $user['Password'])) {
				return $user;
			}
		}
		throw new Exception('Identifiants incorrects');
	}

	public function getUserByEmail(string $email){
		return $this->db->queryOne('SELECT * FROM user WHERE email=?',[$email]);
	}

	public function insert($email){
		$user=$this->getUserByEmail($email);
		if($user){
			throw new Exception("cet email existe déja", 1);
			
		}
	}
}
