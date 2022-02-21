/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(id, nombre){
  if (confirm("¿Quieres eliminar el producto:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&producto_no="+id;
  }
}