package modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

//Implemento el modelo con  Patr贸n Singleton
public class AccesoDatos {

	private static AccesoDatos modelo;
	private Connection conexion = null;
	private PreparedStatement sentenciapreparada1 = null;
	private PreparedStatement sentenciapreparada2 = null;
	private PreparedStatement stmt_modcantidad  = null;

	public static synchronized AccesoDatos initModelo() {
		if (modelo == null) {
			modelo = new AccesoDatos();
		}
		return modelo;
	}

	// Creo un lista de Movimientos, podr铆a obtenerse de una base de datos
	private AccesoDatos() {
		try {
			// Class.forName("org.apache.derby.jdbc.ClientDriver");
			Class.forName("com.mysql.jdbc.Driver");

			conexion = DriverManager.getConnection("jdbc:mysql://localhost/comprasdb", "root", "");

			sentenciapreparada1 = conexion.prepareStatement(
					"select * from socios where cod_socio = ? and clave = ?");
			sentenciapreparada2 = conexion.prepareStatement("select * from productos where cod_pro = ?");
			stmt_modcantidad = conexion.prepareStatement("update socios set cantidad_max = cantidad_max - ? where cod_socio = ?");

		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}

	/*
	 * DEVUELVE UN NUEVO ARRAYLIST CON LOS MOVIMIENTOS QUE CUMPLEN LA CONDICION
	 * DEVUELVE UN ARRAYLIST VACIO SI NO HAY MOVIMIENTOS PARA ESE CLIENTE
	 */

	public Socio obtenerSocio(String cod_socio, String clave) {
		ResultSet rs;
		Socio resu = null;
		try {
			// Acceso sincronizado la sentencia y la conexi贸n se comparten
			synchronized (sentenciapreparada1) {
				sentenciapreparada1.setString(1, cod_socio);
				sentenciapreparada1.setString(2, clave);
				rs = sentenciapreparada1.executeQuery();
				
				// Si es correcto existe
				if (rs.next()) {
					resu = new Socio();
					
					resu.setCod_socio(rs.getString("cod_socio"));
					resu.setNombre(rs.getString("nombre"));
					resu.setClave(rs.getString("clave"));
					resu.setCantidad_max(rs.getInt("cantidad_max"));
				}
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return resu;
	}

	// Devuelve TRUE o FALSE si hay algun Movimiento con ese c贸digo de cliente
	public Producto ObtenerProducto(String cod_pro) {
		ResultSet rs;
		Producto resu = null;
		try {
			// Acceso sincronizado la sentencia y la conexi贸n se comparten
			synchronized (sentenciapreparada2) {
				sentenciapreparada2.setString(1, cod_pro);
				rs = sentenciapreparada2.executeQuery();
				// Si es correcto existe
				
				if (rs.next()) {
					resu = new Producto();
					resu.setCod_pro(rs.getString("cod_pro"));
					resu.setNombre_pro(rs.getString("nombre_pro"));
					resu.setPrecio(rs.getInt("precio"));
				}
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return resu;
	}
	
	
	  // UPDATE
    public boolean modCantidad(Socio socio, int cantidad){
      
    	boolean resu = false;
        try {
        	//Para ver el n鷐ero de filas afectadas, lo hacemos con synchronized y if(updatesocios.executeUpdate() == 1){resu = true;}
			stmt_modcantidad.setInt(1,cantidad);
	        stmt_modcantidad.setString(2,socio.getCod_socio());
	        resu = stmt_modcantidad.execute();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}       
        return resu;
    }
	

	// Evito que se pueda clonar el objeto.
	@Override
	public AccesoDatos clone() {
		try {
			throw new CloneNotSupportedException();
		} catch (CloneNotSupportedException ex) {
			ex.printStackTrace();
		}
		return null;
	}
}
