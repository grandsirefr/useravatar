<?php
include 'vendor/autoload.php';

use Core\DB\Database;
use App\Model\UserModel;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use App\Entity\User;

//const DB_HOST = 'localhost';
//const DB_NAME = 'avatarpixel';
//const DB_USER = 'root';
//const DB_PASSWORD = '';

//dump($_POST);
if(!empty($_POST)){

    //connection a la base de données par injection
    $pdo = new PDO ('mysql:host=localhost;dbname=avatarpixel','root', '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $pdo->exec('SET NAMES UTF8');
    $db=new Database($pdo);

    //on indique le chemin des fichier pour stocker le fichier svg
    $folders=['uploads','avatars'];

    $svg=SvgAvatarFactory::getAvatar(3,7);

    $filename=sha1(uniqid(rand(),true));

    $fs=new FileSystemHelper();


    $fs->write('uploads/avatars/'.$filename.'.svg',$svg);

    $userModel= new UserModel($db);
    try{
        $user=new User($_POST);
        $user->setAvatar($filename);
        $userModel->insert($user);

    }catch(Exeption $e){
        dump($e->getMessage());
        die;
    }
    

}



include 'template/create_user.phtml';
