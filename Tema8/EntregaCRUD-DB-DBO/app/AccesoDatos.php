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
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
       
         $this->dbh = new mysqli(DB_SERVER,DB_USER,DB_PASSWD,DATABASE);
         
      if ( $this->dbh->connect_error){
         die(" Error en la conexión ".$this->dbh->connect_errno);
        } 

    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Usuarios
    public function getProductos ():array {
        $tproducts = [];
        // Crea la sentencia preparada
        $stmt_products  = $this->dbh->prepare("select * from productos");
        // Si falla termian el programa
        if ( $stmt_products == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        // Ejecuto la sentencia
        $stmt_products->execute();
        // Obtengo los resultados
        $result = $stmt_products->get_result();
        // Si hay resultado correctos
        if ( $result ){
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ( $product = $result->fetch_object('Producto')){
               $tproducts[]= $product;
            }
        }
        // Devuelvo el array de objetos
        return $tproducts;
    }
    
    // SELECT Devuelvo un usuario o false
    public function getProducto ($num_product) {
        $product = false;
        
        $stmt_product   = $this->dbh->prepare("select * from productos where PRODUCTO_NO =?");
        if ( $stmt_product == false) die ($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_product->bind_param("i",$num_product);
        $stmt_product->execute();
        $result = $stmt_product->get_result();
        if ( $result ){
            $product = $result->fetch_object('Producto');
            }
        
        return $product;
    }
    
    // UPDATE
    public function modProducto($product):bool{
      
        $stmt_modproduct   = $this->dbh->prepare("update productos set DESCRIPCION=?, PRECIO_ACTUAL=?, STOCK_DISPONIBLE=? where PRODUCTO_NO=?");
        if ( $stmt_modproduct == false) die ($this->dbh->error);

        $stmt_modproduct->bind_param("sdii",$product->DESCRIPCION, $product->PRECIO_ACTUAL, $product->STOCK_DISPONIBLE, $product->PRODUCTO_NO);
        $stmt_modproduct->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($product):bool{
       
        $stmt_creaproduct  = $this->dbh->prepare("insert into productos (PRODUCTO_NO,DESCRIPCION,PRECIO_ACTUAL,STOCK_DISPONIBLE) Values(?,?,?,?)");
        if ( $stmt_creaproduct == false) die ($this->dbh->error);

        $stmt_creaproduct->bind_param("isdi",$product->PRODUCTO_NO, $product->DESCRIPCION, $product->PRECIO_ACTUAL, $product->STOCK_DISPONIBLE);
        $stmt_creaproduct->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto($num_product):bool {
        $stmt_borproduct   = $this->dbh->prepare("delete from productos where PRODUCTO_NO =?");
        if ( $stmt_borproduct == false) die ($this->dbh->error);
       
        $stmt_borproduct->bind_param("i", $num_product);
        $stmt_borproduct->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

