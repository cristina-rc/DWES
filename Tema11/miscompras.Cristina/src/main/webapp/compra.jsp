<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>COMPRA SOCIOS</title>
</head>
<body>
<%

Cookie[] todasLasCookies = request.getCookies();

if (todasLasCookies != null) {
    for (Cookie cookie : todasLasCookies) {
        if ( cookie.getName().contentEquals("ultimoacceso") ){
        	  String fechaUltima = cookie.getValue();
        	  
        	 out.println("<b>Bienvenido. Su última visita fue el " + fechaUltima + "</b>");
        }
    }   
    
}else{
	%><p><b>Bienvenido, esta es su primera visita</b></p>
	
	<%
}

String fechaactual = new java.util.Date().toString();
Cookie ultimoacceso = new Cookie("ultimoacceso", fechaactual);
response.addCookie(ultimoacceso);



%>
<h1> INTRODUZCA LOS DATOS DE SU COMPRA</h1>
<form method="get" action="realizarcompra">
Código de cliente:<input type="text" name="cod_cliente"><br>
Clave:   <input type="text" name="clave"><br>
Código de producto:   <input type="text" name="cod_producto"><br>
<input type="submit" value=" Enviar ">
</form>
</body>
