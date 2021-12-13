/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(descripcion,numero){
  if (confirm("¿Quieres eliminar el producto:  "+descripcion+"?"))
  {
   document.location.href="?orden=Borrar&id="+numero;
  }
}