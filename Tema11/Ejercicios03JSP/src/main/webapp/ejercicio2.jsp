 <%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
	<%if ( request.getParameter("usuario") == null && request.getParameter("clave") == null ){%>
		<form  action="ejercicio2.jsp">
		  Usuario 	 <input type="text" name="usuario"><BR>
		  Contraseña <input type="password" name="clave"><BR>
		  <input type="submit" value="Enviar">
		</form>
<%} 
	String usuario  = request.getParameter("usuario");
	String clave    = request.getParameter("clave");
       try {
	       	if ( usuario != null && clave != null &&
	       		 usuario.contentEquals("alumno") &&
	       		   clave.contentEquals("alumno") ) {%>
	       		<h1> Bienvenido al sistema </h1>
	       <%}
	       	else if ( usuario != null && clave != null ){%>
	       		<body><h1> ACCESO NO AUTORIZADO </h1><BR>
	       		Introduzca un usuario y contraseÃ±a correctos 
	       		</body></html>
	       		<%response.setHeader("Refresh", "3; URL=ejercicio2.jsp");
	       		
	       	}
    
   	 } finally { 
       		out.close();
  	 }	
%>
