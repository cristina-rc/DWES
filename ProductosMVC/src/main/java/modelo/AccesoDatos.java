package modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;



//Implemento el modelo con  Patrón Singleton es casi equivalente a crear a conexión
//en el método init de Servlet

public class AccesoDatos {

	private static AccesoDatos modelo;
	private static Connection conexion = null;
	private PreparedStatement stmt_productos = null;
    private PreparedStatement stmt_producto  = null;
    private PreparedStatement stmt_borprod  = null;
    private PreparedStatement stmt_modprod  = null;
    private PreparedStatement stmt_creaprod = null;
	
	public static synchronized  AccesoDatos initModelo(){
		if (modelo == null){
			modelo = new AccesoDatos();
		}
		return modelo;
	}
	
	// Creo un lista de alimentos, podría obtenerse de una base de datos
	private AccesoDatos (){
		try {
			
			Class.forName("com.mysql.jdbc.Driver");

			conexion = DriverManager.getConnection(
					"jdbc:mysql://localhost/empresa", "root", "");

			
			 this.stmt_productos  = conexion.prepareStatement("select * from productos");
		     this.stmt_producto   = conexion.prepareStatement("select * from productos where PRODUCTO_NO=?");
		     this.stmt_borprod   = conexion.prepareStatement("delete from productos where PRODUCTO_NO =?");
		     this.stmt_modprod   = conexion.prepareStatement("update productos set DESCRIPCION=?, PRECIO_ACTUAL=?, STOCK_DISPONIBLE=? where PRODUCTO_NO=?");
		     this.stmt_creaprod  = conexion.prepareStatement("insert into productos (PRODUCTO_NO,DESCRIPCION,PRECIO_ACTUAL,STOCK_DISPONIBLE) values(?,?,?,?)");
			

		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}
	
	
	 public static void closeModelo(){
	        if (modelo != null){
	           try {
				conexion.close();
			} catch (Exception e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	        }
	    }

    // Devuelvo la lista de Productos
    public ArrayList<Producto> getProductos () {
        ArrayList <Producto> tprod = new ArrayList<Producto>();
        
        ResultSet rs; 
        try {
			rs =  this.stmt_productos.executeQuery();
			  while ( rs.next()) {
		        	Producto prod = new Producto();
		        	prod.setProducto_no(rs.getInt("PRODUCTO_NO"));
		        	prod.setDescripcion(rs.getString("DESCRIPCION"));
		        	prod.setPrecio_actual(rs.getDouble("PRECIO_ACTUAL"));
                    prod.setStock_disponible(rs.getInt("STOCK_DISPONIBLE"));
                    tprod.add(prod);
			  }
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
      
    
        return tprod;
    }
	
    // Obtengo un usuario
    public Producto getProducto(int id) {
    	Producto prod = null;
    	
        ResultSet rs; 
        try {
        	this.stmt_producto.setInt(1, id);
			rs =  this.stmt_producto.executeQuery();
			  if  ( rs.next()) {
		        	prod = new Producto();
		        	prod.setProducto_no(rs.getInt("PRODUCTO_NO"));
		        	prod.setDescripcion(rs.getString("DESCRIPCION"));
		        	prod.setPrecio_actual(rs.getDouble("PRECIO_ACTUAL"));
                    prod.setStock_disponible(rs.getInt("STOCK_DISPONIBLE"));
			  }
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
          	return prod;
    }
	
    // UPDATE
    public boolean modProducto(Producto prod){
      
    	boolean resu = false;
        try {
		
			stmt_modprod.setString(1,prod.getDescripcion());
	        stmt_modprod.setDouble(2,prod.getPrecio_actual());
	        stmt_modprod.setInt(3,prod.getStock_disponible());
	    	stmt_modprod.setInt(4,prod.getProducto_no());
	        resu = stmt_modprod.execute();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}       
        return resu;
    }
    
    //INSERT
    public boolean addProducto(Producto prod){
        boolean resu = false;
    	try {
    		stmt_creaprod.setInt(1,prod.getProducto_no());
    		stmt_creaprod.setString(2,prod.getDescripcion());
    		stmt_creaprod.setDouble(3,prod.getPrecio_actual());
    		stmt_creaprod.setInt(4,prod.getStock_disponible());

	    	resu = stmt_creaprod.execute();
    	} catch (SQLException e) {
    		e.printStackTrace();
    	}
        return resu;
    }
    
    
    // DELETE Elimino un producto
    public boolean borrarProducto(int id)  {
        boolean resu = false;
    	
        try {
        	this.stmt_borprod.setInt (1, id);
			resu = this.stmt_borprod.execute();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
       return resu; 
        
    }  
    
    
    
	
	// Evito que se pueda clonar el objeto.
 @Override
 public AccesoDatos clone(){
         try {
             throw new CloneNotSupportedException();
         } catch (CloneNotSupportedException ex) {
         	ex.printStackTrace();
         }
         return null; 
     }    
}
