<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

class MainModel
{
    protected $capsule;
    public $user;
    public $order;
    
    function __construct()
    {
        $this->capsule = new Capsule;
        
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'burgers',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
        
    }
    
    public function getOrder()
    {
        return $this->capsule->table('info_user')
            ->get();
    }
    
    protected function uniqueUser($email)
    {
        $flag = $this->capsule->table('info_user')
            ->where('email', $email)
            ->first();
        if (!empty($flag)) {
            return $flag->id_user;// такой пользователь есть
        } else {
            return false; // новый пользователь
        }
        
    }
    public function save ($user, $order){
        $id_user=$this->uniqueUser($user['email']);
        if ($id_user!=false){
            //если такой пользовтель есть, записыв данные о заказе
            $order['id_user']=$id_user;
            $this->capsule->table('order')->insert($order);
            echo '1';
        }else{
            //новый пользователь, запис.его в базу и и в заказы
            $new_id_user=$this->capsule->table('info_user')->insertGetId($user);
            $order['id_user']=$new_id_user;
            $this->capsule->table('order')->insert($order);
        }
    }
    public function goList(){
    
    }
}