<?php
namespace Clases;
require '../vendor/autoload.php';
Use Clases\Users;
use Faker\Factory;
class Datos{
    public $faker;

    public function __construct($tabla,$cantidad)
    {
        $this->faker=Factory::create('es_ES');
        switch($tabla){
            case "users":
                $this->crearUsuarios($cantidad);
                break;
            case "tags":    
                $this->crearTags($cantidad);
                break;
        }
    }
    public function crearUsuarios($n){
        //creamos un usuario admin
        $usuario=New Users();
        //Borro todos los anteriores
        $usuario->borrarTodo();
        $usuario->setNombre("Manolo");
        $usuario->setApellidos("Gil Gil");
        $usuario->setUsername("admin");
        $usuario->setMail("admin@gmail.com");
        $pass=hash('sha256',"secret0");
        $usuario->setPass($pass);
        $usuario->create();
        //creamos el resto de usuarios
        for($i=0; $i<$n-1; $i++){
            $usuario->setNombre=($this->faker->firstName());
            $usuario->setApellidos=($this->faker->lastName(). " ". $this->faker->lastName());
            $usuario->setUsername($this->faker->unique()->userName);
            $usuario->setMail($this->faker->unique()->email);
            $usuario->setPass($this->faker->sha256);
            $usuario->create();
        }
        $usuario=null;

    }
    public function crearTags($n){

    }
}