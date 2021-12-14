<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_productos = null;
    private $stmt_producto  = null;
    private $stmt_borproducto  = null;
    private $stmt_modproducto  = null;
    private $stmt_creaproducto = null;

    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=EMPRESA;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_productos  = $this->dbh->prepare("select * from productos");
        $this->stmt_producto   = $this->dbh->prepare("select * from productos where PRODUCTO_NO =:numero");
        $this->stmt_borproducto   = $this->dbh->prepare("delete from productos where PRODUCTO_NO =:numero");
        $this->stmt_modproducto   = $this->dbh->prepare("update productos set DESCRIPCION=:descripcion, PRECIO_ACTUAL=:precio, STOCK_DISPONIBLE=:stock where PRODUCTO_NO=:numero");
        $this->stmt_creaproducto  = $this->dbh->prepare("insert into productos (PRODUCTO_NO,DESCRIPCION,PRECIO_ACTUAL,STOCK_DISPONIBLE) Values(?,?,?,?)");
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->stmt_productos = null;
            $obj->stmt_producto  = null;
            $obj->stmt_borproducto  = null;
            $obj->stmt_modproducto  = null;
            $obj->stmt_creaproducto = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Usuarios
    public function getProductos ():array {
        $tproductos = [];
        $this->stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        
        if ( $this->stmt_productos->execute() ){
            while ( $producto = $this->stmt_productos->fetch()){
               $tproductos[]= $producto;
            }

        }        
        return $tproductos;
    }
    
    // SELECT Devuelvo un usuario o false
    public function getProducto ($num_product) {
        $product = false;
        
        $this->stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $this->stmt_producto->bindParam(':numero', $num_product);
        if ( $this->stmt_producto->execute() ){
             if ( $obj = $this->stmt_producto->fetch()){
                $product= $obj;
            }
        }
        
        return $product;
    }
    
    // UPDATE
    public function modProducto($product):bool{

        $this->stmt_modproducto->bindValue(':descripcion',$product->DESCRIPCION);
        $this->stmt_modproducto->bindValue(':precio',$product->PRECIO_ACTUAL);
        $this->stmt_modproducto->bindValue(':stock',$product->STOCK_DISPONIBLE);
        $this->stmt_modproducto->bindValue(':numero',$product->PRODUCTO_NO);
        $this->stmt_modproducto->execute();
        $resu = ($this->stmt_modproducto->rowCount () == 1);
        return $resu;

    }

    //INSERT
    public function addProducto($product):bool{

        $this->stmt_creaproducto->execute( [$product->PRODUCTO_NO, $product->DESCRIPCION, $product->PRECIO_ACTUAL, $product->STOCK_DISPONIBLE]);
        $resu = ($this->stmt_creaproducto->rowCount () == 1);
        return $resu;

    }

    //DELETE
    public function borrarProducto($num_product):bool {
               
        $this->stmt_borproducto->bindParam(':numero', $num_product);
        $this->stmt_borproducto->execute();
        $resu = ($this->stmt_borproducto->rowCount () == 1);
        return $resu;
        
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

