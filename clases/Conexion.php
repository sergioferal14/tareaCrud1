<?php
namespace Clases;
use PDO;
use PDOException;
//creo la clase, tiene que tener el mismo
//nombre que el archivo,en este caso Conexion
class Conexion{
    protected static $conexion;

    public function __construct()
    {
        if(self::$conexion==null){
            self::crearConexion();
        }
    }
    public static function crearConexion(){
        //1.- leemos el archivo de conficuracion (.config)
        $opciones=parse_ini_file('../.config');
        $mibase=$opciones["bbdd"];
        $miUser=$opciones["usuario"];
        //$miPass=$opciones["pass"];
        $miHost=$opciones["host"];
        //2.- creo el dsn (descriptor de servicio) con estos parametros
        $dns="mysql:host=$miHost;dbname=$mibase;charset=utf8mb4";
        //3.- Creo la conexion
        try{
            self::$conexion=new PDO($dns,$miUser);
            //lo siguiente solo para depurar errores
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $ex){
            die("Error al conectar a la BBDD, mansaje: ".$ex->getMessage());
        }

    }
}
