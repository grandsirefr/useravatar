<?php

namespace App\Model;
use \PDO;
use Core\DB\Database;
use Core\DB\AbstractModel;
use \Exception;
use App\Entity\User;


class UserModel extends AbstractModel {

    //protected $db;

    /*public function __construct(Database $db)
    {
        $this->db=$db;
    }*/

    // Ajouter un utilisateur, enregistrer ses infos dans la BDD
	public function insert(User $user) {
		dump($user);
		$newuser=$this->getUserByEmail($user->getemail());

		if($newuser){
			throw new Exception("cet email existe déja", 1);
		}
		//dump($user);
		// Vérifier que l'email n'existe pa
		// Si l'email existe, on lance une exception
		
		$hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
		$sql='INSERT INTO user(firstname,lastname,email,password,createdAt,avatar) VALUES (?,?,?,?,NOW(),?)';
		$this->db->queryAction($sql,[$user->getFirstname(),$user->getLastname(),$user->getEmail(),$hashedPassword,$user->getAvatar()]);
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

}
