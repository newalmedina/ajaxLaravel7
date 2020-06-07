@extends('layout')
@section('contenido')
    <div class="row">
        <div class="col-12 mt-2">
            <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo usuario</button> 
              <br>
              <br>
              <div class="alert alert-success m-2" style="display: none" id="mensaje"></div>
              <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>CORREO</th>
                        <th>ACCIONES</th>
                    </tr>    
                </thead> 
                <tbody id="resultado">
                     
                </tbody>   
            </table>    
        </div>    
    </div>  
    <div class="row">
        <div class="col-12">
            @include('add')
          
        </div>
        <div class="col-12">
            @include('show')
          
        </div>
        
       
    </div>  
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       

        function get() {
            $.ajax({
            type:'get',
            url:"{{ route('usuarios.index') }}",
            dataType: 'json',           
            success:function(data){
                    var tabla="";
                    for(let item of  data['usuarios']){
                            tabla += `
                            <tr>
                                <td >${item.id}</td>
                                <td>${item.nombre}</td>
                                <td>${item.apellidos}</td>
                                <td>${item.correo}</td>                              
                                <td>
                                    
                                     <button  id='editar' onclick='editar(${item.id})'  name="btnEditar" class="btn btn-primary "  >Editar </button>
                                     <button  id='show' onclick='show(${item.id})'  name="btnShow" class="btn btn-primary "  >ver </button>
                                     <button  id='eliminar' onclick='if(confirm("estas seguro?"))  eliminar(${item.id}) '  name="btnBorrar" class="btn btn-danger "  >Eliminar </button>
                                </td >                              
                                
                            </tr>
                            `;
                        }
                        
                        document.getElementById("resultado").innerHTML= tabla;
                }
            });
        }
        
        function limpiar() {
            $("#nombre").val("");
            $("#id").val("");
            $("#apellidos").val("");
            $("#correo").val("");
        }
        function editar(id) {
            $.ajax({
                type:'GET',
                 url: '/usuarios/' + id+ '/edit',
                dataType: 'json',
                success:function(data){   
                    $("#nombre").val(data['usuario'].nombre);
                    $("#id").val(data['usuario'].id);
                    $("#apellidos").val(data['usuario'].apellidos);
                    $("#correo").val(data['usuario'].correo);
                    $('#myModal').modal('show');
                },
                error:function(){   
                   console.log("error");
                }
            });
           
        }

       function eliminar(id) {
                $.ajax({
                type:'DELETE',
                 url: '/usuarios/' + id,
                dataType: 'json',
                success:function(data){            
                    document.getElementById("mensaje").innerHTML= data.success;

                    $('#mensaje').fadeIn(2000);
                    $('#mensaje').fadeOut(4000);
                    get();
                }
            });
       }
    </script>
@endsection