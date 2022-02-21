package Ejercicios02;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class Adivina
 */
@WebServlet("/Adivina")
public class Adivina extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    public Adivina() {
        super();
    }

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        
        HttpSession s = request.getSession();
        int maxIntentos = 5;
        int numeroUsuario = 0;

        //Si intentamos asignar el GET a una variable, tiene que ser con Integer para poder igualarlo a null
        if (s.getAttribute("numeroOculto") == null){
        	int random = (int) (Math.random()*20)+1;
        	s.setAttribute("numeroOculto", random);
        	s.setAttribute("intentos", 0);
            out.println("<H1> !! BIENVENIDO !! </H1> ");
        }else {
              if (request.getParameter("numeroUsuario") != null){
                  int numOculto = (int)s.getAttribute("numeroOculto");
                  s.setAttribute("intentos", (int)s.getAttribute("intentos")+1);    
                  out.println("INTENTOS =" + s.getAttribute("intentos") + "<br>");
                  
                  if (numOculto == numeroUsuario){
                      out.println("Enhorabuena has acertado <br>");
                      s.invalidate();
                      out.println("Se ha generando un nuevo número a adivinar");
                      response.setIntHeader("Refresh", 3);
                      return;
                  }else {
                	  
	                  if((int)s.getAttribute("intentos") >= maxIntentos){
	                	  out.println("Superado el número de intentos <br>");
	                	  s.invalidate();
	                	  out.println("Se ha generando un nuevo número a adivinar");
	                	  response.setIntHeader("Refresh", 3);
	                      return;
	                  }else if ( numOculto > numeroUsuario){
	                	  out.println("No llegas <br>");
	                  }else {
	                	  out.println("Te pasas <br>");
	                  }
                  }          
             }
        }
          
        
		out.println("<form method='get'>");
		out.println("Introduce un número: <input name='numeroUsuario' type='number' size='5'>");
		out.println("</form>");
	}


	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
	}

}
