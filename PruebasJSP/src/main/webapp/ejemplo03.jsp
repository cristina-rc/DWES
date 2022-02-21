<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Prueba de JSP:ejemplo03.jsp</title>
</head>
<body>
<H1>Declaraciones JSP</H1>
<!-- Con esta notación se genera una variable que se guarda en el servidor, 
común para todas las peticiones, para reiniciarla habría que reiniciar el tomcat-->
<%! private int accessCount = 0; %>
<H2>Número de accesos al servidor desde que se inicio:
<%= ++accessCount %></H2>
</body>
</html>