<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
		<html><body>
		<% String detallesNavegador = request.getHeader("User-Agent");
		if ( detallesNavegador.indexOf("Firefox") >= 0) {%>
			<h1> Usas Firefox</h1>
		<%}
		else {%>
			<h1> No usas Firefox</h1>
		<%}%>
		
		</body></html>
				

</body>
</html>