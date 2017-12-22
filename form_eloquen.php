<?php
require_once __DIR__."/vendor/autoload.php";
require_once "models/MainModel.php";
use App\MainModel;

$model=new MainModel();
$order=$model->getOrder();
$array_user['name']=trim( strip_tags($_POST['name']));
$array_user['phone']=trim( strip_tags($_POST['phone']));
$array_user['email']=trim( strip_tags($_POST['email']));
$array_user['street']=trim( strip_tags($_POST['street']));
$array_user['home']=trim( strip_tags($_POST['home']));
$array_user['appt']=trim( strip_tags($_POST['appt']));
$array_user['part']=trim( strip_tags($_POST['part']));
$array_order['comment']=trim( strip_tags($_POST['comment']));

$model->save($array_user,$array_order);
