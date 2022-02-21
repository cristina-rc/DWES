import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import modelo.AccesoDatos;
import modelo.Socio;
import modelo.Producto;

/**
 * Servlet implementation class Servletconsulta
 */
@WebServlet({ "/Servletconsulta", "/realizarcompra" })
public class Servletcompra extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Servletcompra() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		String cod_cliente = request.getParameter("cod_cliente");
		String clave = request.getParameter("clave");
		String cod_producto = request.getParameter("cod_producto");
		
		//Hay que comprobar si los parámetros vienen vacíos
		
		AccesoDatos mimodelo = AccesoDatos.initModelo(); 
		
		String msg;
		
		Socio socio = mimodelo.obtenerSocio(cod_cliente, clave);
		Producto producto = mimodelo.ObtenerProducto(cod_producto);
		
		if (socio == null) {
			msg = "ERROR:  Los valores de código de cliente y contraseña no son válidos ";
			request.setAttribute("msg", msg);
			request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);
			return;
		}
		
		if (producto == null) {
			msg = "ERROR:  No se encuentra ningún producto con el código: " + cod_producto + " en nuestro catálogo ";
			request.setAttribute("msg", msg);
			request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);
			return;
		}
		
		
		if(producto.getPrecio() <= socio.getCantidad_max()) {
			msg = "Se ha efectuado la compra del producto: ";
			mimodelo.modCantidad(socio, producto.getPrecio());
			
		}else {
			msg = "No se ha podido efectuar la compra del producto: ";
		}
		
		//Vuelvo a recuperar el socio después de comprar el producto
		socio = mimodelo.obtenerSocio(cod_cliente, clave);
		
		request.setAttribute("socio", socio);
		request.setAttribute("producto", producto);
		request.setAttribute("msg", msg);
		request.getRequestDispatcher("/WEB-INF/vista.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}