<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CONSULTA DE MOVIMIENTOS</title>
</head>
<body>

<%

Cookie[] todasLasCookies = request.getCookies();

if (todasLasCookies != null) {
    for (Cookie cookie : todasLasCookies) {
        if ( cookie.getName().contentEquals("ultimoacceso") ){
        	  String fechaUltima = cookie.getValue();
        	  
        	 out.println("Bienvenido. Su �ltima visita fue el " + fechaUltima);
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

<h1> CONSULTA DE MOVIMIENTOS</h1>

<form method="get" action="procesarconsultabbdd">
C�digo de cliente:<input type="text" name="cod_cliente"><br>
Importe m�nimo:   <input type="text" name="importe_min"><br>
Importe m�ximo:   <input type="text" name="importe_max"><br>
<input type="submit" value=" Enviar ">
</form>
</body>
</html>