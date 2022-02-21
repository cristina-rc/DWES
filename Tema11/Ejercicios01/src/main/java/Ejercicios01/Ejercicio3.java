package Ejercicios01;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Ejercicio3
 */
@WebServlet("/Ejercicio3")
public class Ejercicio3 extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Ejercicio3() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

		response.setContentType("text/html;charset=UTF-8");
		
		String usuario = request.getParameter("usuario");
		String password = request.getParameter("password");
		PrintWriter out = response.getWriter();
		
		try {
			out.println("<html><body>");
			if(usuario != null && password != null && usuario.contentEquals("alumno") && password.contentEquals("alumno")){
				out.println("<h1>Bienvenido</h1>");				
			}else{
				out.println("<h1>Acceso no autorizado</h1>");
				response.setHeader("Refresh", "3, URL=Ejercicio3"
						+ "/acceso.html");
			}
			
			out.println("<html><body>");
			
		}finally {
			out.close();
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
	}

}
