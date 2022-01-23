package Ejercicios01;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Enumeration;
import java.util.HashMap;
import java.util.Map;
import java.util.Random;
import java.util.concurrent.ConcurrentHashMap;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/Ejercicio5")
public class Ejercicio5 extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private HashMap<String,String> periodicos = new HashMap<String,String>();
	private HashMap<Integer,String> periodicosnum = new HashMap<Integer,String>();
   
    public Ejercicio5() {
        super();
    }
    
    @Override
   public void init(ServletConfig config){
    	periodicos.put("El País", "https://elpais.com/");
    	periodicos.put("El Mundo", "https://www.elmundo.es/");
    	periodicos.put("ABC", "https://www.abc.es/");

    }


	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.setContentType("text/html;charset=UTF-8");
		PrintWriter out = response.getWriter();
		
		 out.println("<ul>");
		
		for (String clave:periodicos.keySet()) {
		    String valor = periodicos.get(clave);		    
		  
		    out.println("<li>");
		    out.println("<a href=" + valor + ">"+ clave + "</a>");
		    out.println("</li>");
		}
		
		int i = 1;
		for (String clave:periodicos.keySet()) {			
		    periodicosnum.put(i, clave);
		    i++;
		}
		
		int tamanoHash = periodicosnum.size();
		int random = (int)(Math.floor(Math.random()*(periodicosnum.size())+1));
		
		out.println("<br> El periódico recomendado de hoy es: <a href=" + periodicos.get(periodicosnum.get(random)) + ">"+ periodicosnum.get(random) + "</a>");
	}

	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
	}

}
