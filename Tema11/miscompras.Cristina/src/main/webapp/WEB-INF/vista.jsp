<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
<%-- Importo las clases necesarias --%>
<%@ page  import="java.util.ArrayList" %>
<%@ page import="modelo.Producto" %>
<%@ page import="modelo.Socio" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Consulta de movimientos </title>
</head>
<body>


<!--  UTILIZANDO INSTRUCCIONES DE JAVA  -->
<%

//Se puede usar {socio.nombre} en vez de recuperar los atributos
	Socio socio = (Socio)request.getAttribute("socio");
	Producto producto = (Producto)request.getAttribute("producto");	
	
    if (socio == null || producto == null){
    	out.println( "ERROR: Me han enviado una lista == NULL");	
    }
    else 
    {
%>
<H1>BIENVENIDO <%=socio.getNombre()%> </H1>

<p> ${msg}  <%=producto.getNombre_pro()%> por <%=producto.getPrecio()%> euros.
Su límite actual de compra es de: <%=socio.getCantidad_max()%> euros.

</p>
<% } %>
</body>
</html>