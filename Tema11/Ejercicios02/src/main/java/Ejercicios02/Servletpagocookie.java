package Ejercicios02;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


@WebServlet({"/Servletpagocookie", "/pagoc"})
public class Servletpagocookie extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    public Servletpagocookie() {
        super();
    }

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        
        String tarjetaGET = request.getParameter("nuevatarjeta");
        String tarjetaActual = null;
        
        Cookie nuevaTarjeta = null;
        
        
        if(tarjetaGET != null) {   
        	nuevaTarjeta =  new Cookie("tipotarjeta", tarjetaGET);            
            
            nuevaTarjeta.setMaxAge(7*24*3600);
            response.addCookie(nuevaTarjeta);
            
            out.println("<br><h1> Cambiando su tipo de tarjeta...</h1>");
            out.println("<img src='Ejercicios02tarjetas/waiting.gif' />");
			response.setHeader("Refresh", "3, URL=Servletpagocookie");
            out.println("<body></html>");
            return;
            
        }else {
        	Cookie[] cookies = request.getCookies();
            
            //Si existe, asignamos el valor inicial a la cookie "tipotarjeta"
            for (int i = 0; i < cookies.length; i++) {
    	        if (cookies[i].getName().equals("tipotarjeta")) {
    	            nuevaTarjeta = cookies[i];
    	            response.addCookie(nuevaTarjeta);
    			}
    		}
            
            tarjetaActual= nuevaTarjeta.getValue();
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
        out.println("<title>Pago cookies</title>");
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
