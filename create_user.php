<?php
include 'vendor/autoload.php';

use App\Model\UserModel;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use App\Entity\User;



//dump($_POST);
if(!empty($_POST)){
    $folders=['uploads','avatars'];

    $svg=SvgAvatarFactory::getAvatar(3,7);
    //var_dump($svg);

    $filename=sha1(uniqid(rand(),true));

    $fs=new FileSystemHelper();

    //$fs->searchFolder($folders);
    // dump($svg);
    $fs->write('uploads/avatars/'.$filename.'.svg',$svg);
    //dump($_POST);
    $userModel= new UserModel();
    try{
        $user=new User($_POST);
        $user->setAvatar($filename);
        //dump($user);
        $userModel->insert($user);

        // $userModel->create($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password'],$filename);
    }catch(Exeption $e){
        dump($e->getMessage());
        die;
    }
    

}



include 'template/create_user.phtml';
