<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    
<%@ page import="java.util.*" %>
    
<%  
HashMap<String, String> simbolos = new HashMap<>();
simbolos.put("PIEDRA",   "&#x1F91C");
simbolos.put("PIEDRA2",   "&#x1F91B");
simbolos.put("TIJERAS",   "&#x1F596");
simbolos.put("PAPEL",   "&#x1F91A");

// Tabla de mensajes en función del ganador
String msg[] = new String[3];

msg[0] = "¡Empate !";
msg[1] = " Ha ganado el jugador 1";
msg[2] =" Ha ganado el jugador 2";

%>

<%!public int calcularGanador (String valor1, String valor2){
    
    int ganador = 0;
    
    if (valor1 == valor2) return ganador;
    
    switch (valor1){
        case "PIEDRA":  ganador = (valor2.equals("TIJERAS"))?1:2; break;
        case "TIJERAS": ganador = (valor2.equals("PAPEL"))?1:2; break;
        case "PAPEL":   ganador = (valor2.equals("PIEDRA"))?1:2; break;
    }
    return ganador;
} %>

<%
String valores[] = new String[3];

valores[0] = "PIEDRA";
valores[1] = "PAPEL";
valores[2] = "TIJERAS";

int random1 = (int)(Math.random()*3);
int random2 = (int)(Math.random()*3);

String jugador1 = valores[random1];
String jugador2 = valores[random2];


%>

<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>

    <p>Actualice la página para mostrar otra partida.</p>

    <table>
      <tr>
        <th>Jugador 1</th>
        <th>Jugador 2</th>
      </tr>
      <tr>
        <td><span style="font-size: 7rem"><%=simbolos.get(jugador1)%></span></td>
        <td><span style="font-size: 7rem"><%=(jugador2 == "PIEDRA")?simbolos.get("PIEDRA2"):simbolos.get(jugador2)%></span></td>
      </tr>
      <tr>
        <th colspan="2"><%= msg[calcularGanador(jugador1,jugador2)] %></th>
      </tr>
    </table>
</body>
</html>