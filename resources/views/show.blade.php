<!-- The Modal -->
<div class="modal" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
    
        <!-- Modal body -->
        <div class="modal-body">
           <div id="datos">

           </div>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
  <script>
      function show(id) {
            $.ajax({
                type:'GET',
                 url: '/usuarios/'+ id,
                dataType: 'json',
                success:function(data){   
                    var info="nombre es:"+data['usuario'].nombre+ "<br> apellidos es:"+data['usuario'].apellidos+ ",<br> correo es:"+data['usuario'].correo ;

                    document.getElementById("datos").innerHTML= info;
                 
                    $('#myModal2').modal('show');
                }
            });
           
        }
  </script>