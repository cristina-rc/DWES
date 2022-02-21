package controladores;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Principal
 */
@WebServlet({ "/Principal", "/indice" })
public class Principal extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public Principal() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		String valororden = request.getParameter("orden");
		if (valororden != null) {
            Acciones acciones = new Acciones(request,response);
			switch (valororden) {
			case "Nuevo":
				acciones.accionAlta();
				break;
			case "Borrar":
				acciones.accionBorrar(Integer.parseInt(request.getParameter("producto_no")));
				break;
			case "Modificar":
				acciones.accionModificar(Integer.parseInt(request.getParameter("producto_no")));
				break;
			case "Detalles":
				 acciones.accionDetalles(Integer.parseInt(request.getParameter("producto_no")));
				 break;
			case "Terminar":
				acciones.accionTerminar();
				break;

			}
		}
		
		// En los demas no es necesario 
		if (valororden == null ||  valororden.equals("Borrar")){
   		String contenido = Funciones.mostrarDatos();
   		request.setAttribute("contenido", contenido);
		request.getRequestDispatcher("/WEB-INF/layout/principal.jsp").forward(request, response);
	   }

	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
//		
		String valororden = request.getParameter("orden");
		if (valororden != null) {

			Acciones acciones = new Acciones(request,response);
			switch (valororden) {
			case "Nuevo":
				acciones.accionPostAlta();
				break;
			case "Modificar":
				acciones.accionPostModificar();
				break;
			case "Detalles":
				; // No hago nada
			}

		}
		String contenido = Funciones.mostrarDatos();
   		request.setAttribute("contenido", contenido);
		request.getRequestDispatcher("/WEB-INF/layout/principal.jsp").forward(request, response);
	}
}
