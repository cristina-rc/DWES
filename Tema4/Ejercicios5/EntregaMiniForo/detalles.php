<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= calPalabras($_REQUEST['comentario']) ?></td></tr>
<tr><td>Letra/s + repetida/s:  </td><td><?= letrasRepetidas($_REQUEST['comentario']) ?></td></tr>
<tr><td>Palabra/s + repetida/s:</td><td><?= palabrasRepetidas($_REQUEST['comentario']) ?></td></tr>
</table>
</div>

