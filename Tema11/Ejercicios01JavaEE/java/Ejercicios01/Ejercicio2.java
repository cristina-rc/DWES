package Ejercicios01;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Ejercicio2
 */
@WebServlet("/Ejercicio2")
public class Ejercicio2 extends HttpServlet {
	private static final long serialVersionUID = 1L;

	protected void processRequest(HttpServletRequest request, HttpServletResponse response)
		    throws ServletException, IOException {

		        String nombre = request.getParameter("nombre");
		        String apellidos = request.getParameter("apellidos");
		        String edad = request.getParameter("edad");
		        String[] hobbies = request.getParameterValues("hobbies");
		        String sexo = request.getParameter("sexo");

		        response.setContentType("text/html;charset=UTF-8");
		        PrintWriter out = response.getWriter();
		        try {
		            out.println("<html>");
		            out.println("<head>");
		            out.println("<title>Servlet que procesa un formulario basico</title>");
		            out.println("</head>");
		            out.println("<body>");
		            out.println("<h1>" + "Hola " + nombre + " " + apellidos+  "</h1>");
		            
		            if(sexo.equals("mujer")) {
		            	out.print("<img src=\"./Ejercicio2/mspotato.JPG\" width='200px'></img><br>");
		            }else{
		            	out.print("<img src=\"./Ejercicio2/mrpotato.JPG\" width='200px'></img><br>");
		            }	            
		                   
		            out.println("Tu Franja de edad es " + edad + " tu sexo es " + sexo + " y tus hobbies son:");
		            
		            out.println("<ul>");
		            for (String hobby : hobbies) {
		                out.println("<li>" + hobby + "</li>");
		            }
		            
		            out.println("</ul>");
		            out.println("Este formulario ha sido invocado con Los siguientes parametros:<br/>");
		            out.println(request.getQueryString());

		            out.println("</body>");
		            out.println("</html>");
		            
		        } finally { 
		            out.close();
		        }
		    } 


	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		 processRequest(request, response);
	}


	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		processRequest(request, response);
	}

}
