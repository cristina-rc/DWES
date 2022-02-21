

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import modelo.*;

/**
 * Servlet implementation class Servletpedidos
 */
@WebServlet({ "/Servletclientes", "/verpuntos" })
public class Servletclientes extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Servletclientes() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		AccesoDatos ac =  AccesoDatos.initModelo();
		String puntos = request.getParameter("puntos");
		boolean error = false;
		int importe_puntos = -1;
		
		try {
			importe_puntos = Integer.parseInt(puntos);
		} catch ( NumberFormatException ex) {
			error = true;
		}
		
		// Comprueba si los parámetros son correctos
		if ( puntos == "" ) {
			String mensaje = "Introduzca un valor de puntos";
		    request.setAttribute("mensaje", mensaje);
			request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);
			return;
		}
		
		if(error) {
			String mensaje = "Introduzca un valor correcto";
		    request.setAttribute("mensaje", mensaje);
			request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);
			return;			
		}
		
		// Obtengo los datos del modelo
		ArrayList <Cliente> lista = ac.obtenerListaClientes(importe_puntos);

		request.setAttribute("lista",lista);
		// Se lo envio a la vista
		request.getRequestDispatcher("/WEB-INF/listaCliente.jsp").forward(request, response);

	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}

