<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
  
<%-- Importo las clases necesarias --%>
<%@ page  import="java.util.ArrayList" %>
<%@ page import="modelo.*" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Listado de Películas </title>
</head>
<body>
<!--  UTILIZANDO INSTRUCCIONES DE JAVA  -->

<%
//Hay que hacer un casting a ArrayList
ArrayList <Cliente> lista = (ArrayList <Cliente>) request.getAttribute("lista");
if (lista == null){
    	out.println( " Me han enviado una lista == NULL");
    	
}
else {
 	  // Si hay algun cliente
   	  if ( lista.size() != 0 ) {
	  %>

		<table border="1">
		<%
		for (Cliente cli : lista) {%>
		<tr>
		<td><%= cli.getTelefono() %></td>
		<td><%= cli.getNombre() %></td>
		<td><%= cli.getPuntos() %></td>
		</tr>

		<% }
		%>
		
		</table>
	<%} else { %>
	     <p> No existen clientes con ese número de puntos.</p>
<% 	}
  		
}
%> 	

</body>
</html>