<?php
include 'vendor/autoload.php';

use Core\DB\Database;
use App\Model\UserModel;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use App\Entity\User;
use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;



//on vas chercher dans le fichier .env les informations de connection a la bdd
$dotenv=new Dotenv();
$dotenv->load(__DIR__.'/.env');



//si la variable globale POST n'est pas vide on se connecte a la base de données
if(!empty($_POST)){

    $container=ContainerBuilder::buildDevContainer();
    //Création de la boite a outil (du caontainer)version 6

    $container->set('db.config',function(){
        $config=explode('##',$_ENV['DATABASE']);
        return [
            'host'=> $config[0],
            'dbname'=>$config[1],
            'user'=>$config[2],
            'password'=>$config[3]

        ];
    });
    $container->set(PDO::class,function($c){
        $config=$c->get('db.config');
        $pdo=new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'],$config['user'],$config['password']);
        $pdo->exec('SET NAMES UTF8');
        return $pdo;

    });


    dump($container->get('db.config'));
    dump($container->get(PDO::class));

    //connection a la base de données par injection
    //$pdo = new PDO ('mysql:host='.$config[0].';dbname='.$config[1],$config[2], $config[3], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    //$pdo->exec('SET NAMES UTF8');
    $db=new Database($container->get(PDO::class));

    //on indique le chemin des fichier pour stocker le fichier svg
    $folders=['uploads','avatars'];

    // constructeur de svg
    $svg=SvgAvatarFactory::getAvatar(3,7);

    // On donne un nom aléatoire au fichier svg
    $filename=sha1(uniqid(rand(),true));

    //on instancie la classe File system pour creer le fichier en .svg
    $fs=new FileSystemHelper();
    $fs->write('uploads/avatars/'.$filename.'.svg',$svg);

    //On
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
