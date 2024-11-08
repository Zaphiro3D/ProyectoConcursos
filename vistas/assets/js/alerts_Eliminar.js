$(document).on("click", ".btnEliminarProducto", function () {
   
  let id_producto = $(this).attr("id_producto"); 

  Swal.fire({
    title: "Está seguro de eliminar el producto?",
    text: "Sino lo está puede cancelar la acción",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar producto",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?pagina=productos&id_producto_eliminar=" + id_producto;
    }
  });
});