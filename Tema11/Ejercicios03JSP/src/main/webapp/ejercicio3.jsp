<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    
<%! 
public String dameColorAleatorio(){
     String rcolor = "rgb(" + (int)(Math.random()*(256)) + "," + (int)(Math.random()*(256)) + "," + (int)(Math.random()*(256)) + ")";

    return rcolor;
}

%>
    
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Tablero de colores</h1>
		</div>
		<div id="content">
			<table>

<%

for (int i = 1; i <= 10; i ++) {
    out.println ("<tr>");
    for (int j = 1; j <= 10; j ++) {
        String color = dameColorAleatorio();
        %>
        <td style='background-color:<%=color%>; height:40px; width:40px'></td>
     <%}
    out.println("</tr>");
}
%>
        </table>
		</div>
	</div>
	</div>
<hr>

</body>
</html>