package Ejercicios01;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Enumeration;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Ejercicio1
 */
@WebServlet("/Ejercicio1")
public class Ejercicio1 extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
	protected void procesaPeticion(HttpServletRequest request, HttpServletResponse response)
	throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        
        try {
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet user-agent</title>");
            out.println("</head>");
            out.println("<body>");
            
            if(request.getHeader("user-agent").toLowerCase().contains("firefox")){
            	out.println("<h1>Ud. está usando el navegador Firefox</h1>");
            }else {
            	out.println("<h1>Ud. está usando un navegador diferente a Firefox</h1>");
            }
            
            out.println(request.getHeader("user-agent"));
           
            out.println("</body>");
            out.println("</html>");

        } finally {
            out.close();
        }
    }
	

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		procesaPeticion(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		procesaPeticion(request, response);
	}

}
