package Ejercicios02;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class Servletpagosesion
 */
@WebServlet({"/Servletpagosesion", "/pagos"})
public class Servletpagosesion extends HttpServlet {
	private static final long serialVersionUID = 1L;
       

    public Servletpagosesion() {
        super();
    }


	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
			response.setContentType("text/html;charset=UTF-8");
	        PrintWriter out = response.getWriter();
	        
	        String tarjetaGET = request.getParameter("nuevatarjeta");
	        HttpSession sesion = request.getSession();
	        String tarjetaActual = null;
	        
	        if(tarjetaGET != null) {
	            tarjetaActual= tarjetaGET;
	            
	            sesion.setAttribute("tipoTarjeta", tarjetaActual);
	            sesion.setMaxInactiveInterval(10);
	            
	            out.println("<br><h1> Cambiando su tipo de tarjeta...</h1>");
	            out.println("<img src='Ejercicios02tarjetas/waiting.gif' />");
				response.setHeader("Refresh", "3, URL=Servletpagosesion");
	            out.println("<body></html>");
	            return;
	            
	        }else {
	            if (sesion.getAttribute("tipoTarjeta") != null){
	                tarjetaActual= (String) sesion.getAttribute("tipoTarjeta");
	            }
	        }
	        
	        if (tarjetaActual != null){
	        	out.println("<H2> SU FORMA DE PAGO ACTUAL ES</H2> </br> ");
	        	out.println("<img src='Ejercicios02tarjetas/" + tarjetaActual + ".gif'/></a>");
	        }else {
	        	out.println("<H2> NO TIENE FORMA  DE PAGO ASIGNADA</H2> </br>");
	        	out.println("<br><br>");
	        }

	        
	        out.println("<html>");
	        out.println("<head>");
	        out.println("<title>Pago Sesiones</title>");
	        out.println("</head>");
	        out.println("<body>");		
	        out.println("<h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>");
	        out.println("<a href='?nuevatarjeta=cashu'><img src='Ejercicios02tarjetas/cashu.gif' /></a>");
	        out.println("<a href='?nuevatarjeta=cirrus1'><img  src='Ejercicios02tarjetas/cirrus1.gif' /></a>");
	        out.println("<a href='?nuevatarjeta=dinersclub'><img  src='Ejercicios02tarjetas/dinersclub.gif' /></a>");
	        out.println("<a href='?nuevatarjeta=mastercard1'><img  src='Ejercicios02tarjetas/mastercard1.gif'/></a>");
	        out.println(" <a href='?nuevatarjeta=paypal'><img  src='Ejercicios02tarjetas/paypal.gif' /></a>"); 
	        out.println("<a href='?nuevatarjeta=visa1'><img  src='Ejercicios02tarjetas/visa1.gif' /></a>"); 
	        out.println("<a href='?nuevatarjeta=visa_electron'><img  src='Ejercicios02tarjetas/visa_electron.gif'/></a>"); 		
	}

	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
	}

}
