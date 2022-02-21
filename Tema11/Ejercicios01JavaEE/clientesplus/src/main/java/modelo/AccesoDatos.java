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
	private Connection conexion = null;
	private PreparedStatement sentenciapreparada1 = null;

	public static synchronized AccesoDatos initModelo() {
		if (modelo == null) {
			modelo = new AccesoDatos();
		}
		return modelo;
	}

	// Creo un lista de alimentos, podría obtenerse de una base de datos
	private AccesoDatos() {
		try {
			// Class.forName("org.apache.derby.jdbc.ClientDriver");
			Class.forName("com.mysql.jdbc.Driver");

			conexion = DriverManager.getConnection("jdbc:mysql://localhost/telefonia", "root", "");

			sentenciapreparada1 = conexion.prepareStatement("SELECT * FROM clientes WHERE puntos>= ?");


		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}

	// Devuelvo la lista de clientes
	public ArrayList<Cliente> obtenerListaClientes(int importe_puntos) {
		ArrayList<Cliente> listaresu = new ArrayList<Cliente>();
		ResultSet rs;
		try {
			// Acceso sincronizado la sentencia y la conexión se comparten
			synchronized (sentenciapreparada1) {
				sentenciapreparada1.setInt(1, importe_puntos);
				rs = sentenciapreparada1.executeQuery();

				// Vuelco el resultado de ResultSet al ArrayList
				while (rs.next()) {
					Cliente nueva = new Cliente();
					// En este ejercicio no es necesario rellenar todos los atributos
					nueva.setTelefono(rs.getInt("telefono"));
					nueva.setNombre(rs.getString("nombre"));
					nueva.setPuntos(rs.getInt("puntos"));
					listaresu.add(nueva);
				}
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return listaresu;
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