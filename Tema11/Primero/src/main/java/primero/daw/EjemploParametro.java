package primero.daw;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class EjemploParametro
 */
@WebServlet("/EjemploParametro")
public class EjemploParametro extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public EjemploParametro() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
	        response.setContentType("text/html");
	        PrintWriter out = response.getWriter();
	        out.println("<html>");
	        out.println("<head>");
	        out.println("<title>Request Parameters Example</title>");
	        out.println("</head>");
	        out.println("<body>");
	        out.println("<h3> EJEMPLO DE PARAMETROS </h3>");
	        out.println("Parámetros recibidos:<br>");
	        String nombre = request.getParameter("nombre");
	        String apellido = request.getParameter("apellido");
	        

	        if (nombre != null || apellido != null) {
	            out.println("Nombre:");
	            out.println(" = " + nombre + "<br>");
	            out.println("Apellido");
	            out.println(" = " + apellido);
	        } else {
	            out.println("Rellene los datos");
	        }
	        
	        out.println("<P>");
	        out.print("<form action=\"");
	        out.print("EjemploParametro\" ");
	        out.println("method=GET>");
	        out.println("Nombre:");
	        out.println("<input type=text size=20 name=nombre>");
	        out.println("<br>");
	        out.println("Apellido:");
	        out.println("<input type=text size=20 name=apellido>");
	        out.println("<br>");
	        out.println("<input type=submit>");
	        out.println("</form>");
	        out.println("</body>");
	        out.println("</html>");
	    }
	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
