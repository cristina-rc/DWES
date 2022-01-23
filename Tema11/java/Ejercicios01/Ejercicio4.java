package Ejercicios01;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Ejercicio4
 */
@WebServlet("/Ejercicio4")
public class Ejercicio4 extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
       public Ejercicio4() {
        super();
        // TODO Auto-generated constructor stub
    }

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		response.setContentType("text/html;charset=UTF-8");
		PrintWriter out = response.getWriter();
		
		int[] arrayAleatorios = generarArray(20);
		
		int minimo = minimoArray(arrayAleatorios);
		int maximo = maximoArray(arrayAleatorios);
		int moda = modaArray(arrayAleatorios);
		
		try {
			out.println("<html><body>");
			out.println("<h1>Array</h1>");
			
			out.println("<table>");
			out.println("<tr>");
			
			for (int numero: arrayAleatorios) {
				 out.println("<td>" + numero + "</td>");
			}			 
			 
			out.println("</tr>");
			out.println("</table>");

			out.println("Número mínimo: " + minimo + "<br>");
			out.println("Número máximo: " + maximo + "<br>");
			out.println("Moda " + moda + "<br>");

			out.println("<html><body>");
			
		}finally {
			out.close();
		}
	}
	
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
	}
	
	public static int[] generarArray(int longitud) {		
		int[] arrayAleatorios = new int[longitud];
		
		for (int i=0;i<arrayAleatorios.length;i++) {
			arrayAleatorios[i] = (int)(Math.random()*10)+1;
		}
				
		return arrayAleatorios;
		
	}
	
	public static int minimoArray(int[]arrayAleatorios) {			
		int minimo;			
		minimo = arrayAleatorios[0];
		
		for(int i=0; i<arrayAleatorios.length; i++) {				
			if(arrayAleatorios[i]<minimo) {					
				minimo = arrayAleatorios[i];
			}
		}
		
		return minimo;
	}
	
	public static int maximoArray(int[]arrayAleatorios) {		
		int maximo;		
		maximo = arrayAleatorios[0];
		
		for(int i=0; i<arrayAleatorios.length; i++) {			
			if(arrayAleatorios[i]>maximo) {				
				maximo = arrayAleatorios[i];
			}
		}
		
		return maximo;
	}
	
	public static int modaArray(int[]arrayAleatorios) {	
		int moda = 0;
		int mayor = 0;
		
		HashMap<Integer, Integer> mapa = new HashMap<>();
		for (int i=0; i<arrayAleatorios.length; i++) {
			int numero = arrayAleatorios[i];
			if (mapa.containsKey(numero)) {
				mapa.put(numero, mapa.get(numero) + 1);
			} else {
				mapa.put(numero, 1);
			}
		}
		
		for (HashMap.Entry<Integer, Integer> entry : mapa.entrySet()) {
			if (entry.getValue() > mayor) {
				mayor = entry.getValue();
				moda = entry.getKey();
			}
		}
		
		return moda;
	}

}
