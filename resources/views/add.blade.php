<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
    
        <!-- Modal body -->
        <div class="modal-body">
            <form >
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre">
                  <input type="hidden" class="form-control" id="id" name="id">
                </div>
                <div class="form-group">
                  <label for="apellidos">apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos">
                </div>
                <div class="form-group">
                  <label for="correo">correo</label>
                  <input type="email" class="form-control" id="correo" name="correo">
                </div>
               
                <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
  <script>
     
  
   $("#guardar").click(function(e){
    
    e.preventDefault();
    var id = $("input[name=id]").val();
    var nombre = $("input[name=nombre]").val();
    var apellidos = $("input[name=apellidos]").val();
    var correo = $("input[name=correo]").val();
    var action="{{ route('usuarios.store') }}";
    var method="POST";
    if(id!=""){
      action='/usuarios/' + id;
      method="PUT";
    }

    $.ajax({
        type:method,
        url:action,
        dataType: 'json',
        data:{nombre:nombre, apellidos:apellidos, correo:correo},
        success:function(data){    
            limpiar();
            get();        
            document.getElementById("mensaje").innerHTML= data.success;
           $('#myModal').modal('hide');
          
           $('#mensaje').fadeIn(2000);
           $('#mensaje').fadeOut(4000);
          
        }
    });

});
</script>