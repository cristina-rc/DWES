package controladores;
import java.util.ArrayList;

import modelo.AccesoDatos;
import modelo.Producto;

public class Funciones {
   
	
	static String  mostrarDatos (){
	    
		String msg ="";
	    String titulos []= { "PRODUCTO_NO","DESCRIPCION","PRECIO_ACTUAL","STOCK"};
	    msg += "<table>\n";
	     // Identificador de la tabla
	    msg += "<tr>";
	    for (int j=0; j < titulos.length; j++){
	        msg += "<th>"+titulos[j]+"</th>";
	    }  
	    msg += "</tr>";
	    AccesoDatos db = AccesoDatos.initModelo();
	    ArrayList <Producto> tprod = db.getProductos();
	    for (Producto prod: tprod) {
	        msg += "<tr>";
	        msg += "<td>"+prod.getProducto_no()  +"</td>";
	        msg += "<td>"+prod.getDescripcion()   +"</td>";
	        msg += "<td>"+prod.getPrecio_actual()+"</td>";
	        msg += "<td>"+prod.getStock_disponible()+"</td>";
	        msg +="<td><a href='#' onclick=\"confirmarBorrar('"+prod.getProducto_no()+"','"+prod.getDescripcion()+"');\" >Borrar</a></td>\n";
	        msg +="<td><a href='?orden=Modificar&producto_no="+ prod.getProducto_no() +"'>Modificar</a></td>\n";
	        msg +="<td><a href='?orden=Detalles&producto_no=" + prod.getProducto_no() +"' >Detalles</a></td>\n";
	        msg +="</tr>\n";
	        
	    }
	    msg += "</table>";
	   
	    return msg;    
	}
}
