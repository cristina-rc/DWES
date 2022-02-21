package controladores;

import modelo.AccesoDatos;
import modelo.Producto;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class Acciones {

	HttpServletRequest request;
	HttpServletResponse response;

	Acciones(HttpServletRequest request, HttpServletResponse response) {
		this.request = request;
		this.response = response;
	}

	void accionAlta() throws ServletException, IOException {
		Producto prod = new Producto();
		request.setAttribute("orden", "Nuevo");
		request.setAttribute("prod", prod);
		request.getRequestDispatcher("/WEB-INF/layout/formulario.jsp").forward(request, response);
	}

	void accionBorrar(int id) {
		AccesoDatos db = AccesoDatos.initModelo();
		db.borrarProducto(id);
	}

	void accionModificar(int id) throws ServletException, IOException {
		AccesoDatos db = AccesoDatos.initModelo();
		Producto prod = db.getProducto(id);
		request.setAttribute("orden", "Modificar");
		request.setAttribute("prod", prod);
		request.getRequestDispatcher("/WEB-INF/layout/formulario.jsp").forward(request, response);

	}

	void accionDetalles(int id) throws ServletException, IOException {
		AccesoDatos db = AccesoDatos.initModelo();
		Producto prod = db.getProducto(id);
		request.setAttribute("orden", "Detalles");
		request.setAttribute("prod", prod);
		request.getRequestDispatcher("/WEB-INF/layout/formulario.jsp").forward(request, response);
	}

	void accionTerminar() {
		System.out.println("->>> accionTerminar   \n");
	}

	void accionPostAlta() {
		// Habría que controlar los datos de recibido <<<<<<<

		Producto prod = new Producto();
		prod.setProducto_no(Integer.parseInt(request.getParameter("producto_no")));
		prod.setDescripcion(request.getParameter("descripcion"));
		//Controlamos que no ocurra un error NumberFormatException al intentar convertir a Double con una coma		
		prod.setPrecio_actual(Double.parseDouble((request.getParameter("precio_actual").replace(",", "."))));
		prod.setStock_disponible((Integer.parseInt(request.getParameter("stock_disponible"))));
		AccesoDatos db = AccesoDatos.initModelo();
		db.addProducto(prod);
	}

	void accionPostModificar() {
		// Habría que controlar los datos de recibido <<<<<<<
		Producto prod = new Producto();
		prod.setProducto_no(Integer.parseInt(request.getParameter("producto_no")));
		prod.setDescripcion(request.getParameter("descripcion"));		
		//Controlamos que no ocurra un error NumberFormatException al intentar convertir a Double con una coma	
		prod.setPrecio_actual(Double.parseDouble((request.getParameter("precio_actual").replace(",", "."))));
		prod.setStock_disponible((Integer.parseInt(request.getParameter("stock_disponible"))));
		AccesoDatos db = AccesoDatos.initModelo();
		db.modProducto(prod);

	}
}
