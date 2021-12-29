<?php

/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;

    private static $select1 = "SELECT P.PEDIDO_NO, P.PRODUCTO_NO, PR.DESCRIPCION, P.UNIDADES, PR.PRECIO_ACTUAL FROM pedidos P, productos PR WHERE P.PRODUCTO_NO = PR.PRODUCTO_NO AND P.UNIDADES <= PR.STOCK_DISPONIBLE AND P.CLIENTE_NO = ?";
    private static $select2 = "SELECT P.PEDIDO_NO, P.PRODUCTO_NO, PR.DESCRIPCION, P.UNIDADES, PR.PRECIO_ACTUAL FROM pedidos P, productos PR WHERE P.PRODUCTO_NO = PR.PRODUCTO_NO AND P.UNIDADES > PR.STOCK_DISPONIBLE AND P.CLIENTE_NO = ?";
    //Obtenemos los números de pedido pendientes de entregar
    private static $select3 = "SELECT P.PEDIDO_NO FROM pedidos P, productos PR WHERE P.PRODUCTO_NO = PR.PRODUCTO_NO AND P.UNIDADES <= PR.STOCK_DISPONIBLE AND P.CLIENTE_NO = ?";
    
    //Obtenemos el número de producto de cada pedido pendiente
    private static $select4 = "SELECT PRODUCTO_NO FROM pedidos WHERE PEDIDO_NO = ?";

    //Obtenemos las unidades vendidas del producto para descontarlas del stock en caso de que se pueda procesar el pedido
    private static $select5 = "SELECT UNIDADES FROM pedidos WHERE PRODUCTO_NO = ? AND PEDIDO_NO = ?";

    //Eliminamos uno por uno los pedidos pendientes siempre y cuando haya stock suficiente del producto
    private static $delete1 = "DELETE FROM pedidos WHERE PEDIDO_NO = (SELECT P.PEDIDO_NO FROM pedidos P, productos PR WHERE P.PRODUCTO_NO = PR.PRODUCTO_NO AND P.UNIDADES <= PR.STOCK_DISPONIBLE AND P.PEDIDO_NO = ?);";

    //Actualizamos el stock del producto en caso de que se haya podido procesar el pedido
    private static $update1 = "UPDATE productos SET STOCK_DISPONIBLE = (STOCK_DISPONIBLE - ?) WHERE PRODUCTO_NO = ?";


    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=Empresa;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }      
    }

    public function consultaDisp (int $cod_cliente):array{
        $resu = [];
        $stmt = $this->dbh->prepare(self::$select1);
        $stmt->bindValue(1,$cod_cliente);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
               $resu[]= $fila;
            }
        }
        return $resu;
    }

    public function consultaPtes (int $cod_cliente):array{
        $resu = [];
        $stmt = $this->dbh->prepare(self::$select2);
        $stmt->bindValue(1,$cod_cliente);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
               $resu[]= $fila;
            }
        }
        return $resu;
    }

    public function procesar (int $cod_cliente){
        $stmt = $this->dbh->prepare(self::$select3);
        $stmt->bindValue(1,$cod_cliente);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
               $pedidos[]= $fila;
            }
        }

        foreach($pedidos as $pedido=>$numero_pedido){
            foreach($numero_pedido as $num_pedido){
            
                //Obtenemos el número de producto del pedido
                $stmt = $this->dbh->prepare(self::$select4);
                $stmt->bindValue(1,$num_pedido);
                $stmt->execute();
                $num_product = $stmt->fetchColumn();

                //Obtenemos el número de unidades del producto en el pedido
                $stmt = $this->dbh->prepare(self::$select5);
                $stmt->bindValue(1,$num_product);
                $stmt->bindValue(2,$num_pedido);
                $stmt->execute();
                $num_unidades = $stmt->fetchColumn();

                //Intentamos eliminar pedido por pedido siempre y cuando haya stock disponible
                $stmt = $this->dbh->prepare(self::$delete1);
                $stmt->bindValue(1,$num_pedido);
                $stmt->execute();
                $filas_afectadas = $stmt->rowCount();

                //Si las filas afectadas es = 1 (se ha podido procesar y eliminar el pedido), descontamos el stock del producto:
                if($filas_afectadas == 1){
                    $stmt = $this->dbh->prepare(self::$update1);
                    $stmt->bindValue(1,$num_unidades);
                    $stmt->bindValue(2,$num_product);
                    $stmt->execute();
                }        
            }
        }
    }

    // Evito que se pueda clonar el objeto.
    public function __clone(){ 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}