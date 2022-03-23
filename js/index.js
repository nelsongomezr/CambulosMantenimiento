//buscardor de usuarios
$(buscar());
function buscar(consulta)
{

    $.ajax({
        url: "userbuscador.php",
        type: 'POST',
        datatype: 'html',
        data: {consulta, consulta},
        success: function( respuesta ) {
          $( "#datos" ).html(respuesta);
        }
      });
}
$(document).on('keyup','#caja_busqueda', function(){
  var valor =$(this).val();
  if(valor!=""){
    buscar(valor);
  }else{
    buscar();
  }
})
// fin buscardor de usuarios

//buscardor de conductores
$(buscarconductor());
function buscarconductor(consulta)
{
    $.ajax({
        url: "conductorbuscador.php",
        type: 'POST',
        datatype: 'html',
        data: {consulta, consulta},
        success: function( respuesta ) {
          $( "#datosconductor" ).html(respuesta);
        }
      });
}
$(document).on('keyup','#caja_busquedaconductor', function(){
  var valorconductor =$(this).val();
  if(valorconductor!=""){
    buscarconductor(valorconductor);
  }else{
    buscarconductor();
  }
})
//fin buscardor de conductores

//buscardor de vehiculos
$(buscarvehiculo());
function buscarvehiculo(consulta)
{
    $.ajax({
        url: "vehiculobuscador.php",
        type: 'POST',
        datatype: 'html',
        data: {consulta, consulta},
        success: function( respuesta ) {
          $( "#datosvehiculo" ).html(respuesta);
        }
      });
}
$(document).on('keyup','#caja_busquedavehiculo', function(){
  var valorvehiculo =$(this).val();
  if(valorvehiculo!=""){
    buscarvehiculo(valorvehiculo);
  }else{
    buscarvehiculo();
  }
})
// fin buscardor de vehiculos
// muestra lineas correspondientes a cada marca, segun la marca seleccionada
$(buscarmarca());
function buscarmarca(consulta)
{
    $.ajax({
        url: "selectlinea.php",
        type: 'POST',
        datatype: 'html',
        data: {consulta, consulta},
        success: function( respuesta ) {
          $( "#datoslinea" ).html(respuesta);
        }
      });
}
$(document).on('change','#selectmarca', function(){
  var valormarca =$(this).val();
  if(valormarca!=""){
    buscarmarca(valormarca);
  }else{
    buscarmarca();
  }
})
//fin muestra lineas correspondientes a cada marca, segun la marca seleccionada

//validacion formularios
  const formulario=document.getElementById('formulario');
  const inputs = document.querySelectorAll('#formulario input');
  const expresiones ={
    usuario: /^[0-9]$/;
    pass: /^[a-zA-Z0-9]$/;
  }
  const validaformulario = (e) =>{
    switch(e.target.name){
      case"usuario":
        if(expresiones.usuario.test(e.target.value)){
            
        }else{
          document.querySelector('#grupo__usuario.formulario__input-error').classList.add('formulario__input-error-activo');
        }
      break;

      case"pass":

      break;
    }
  }
  inputs.forEach((input)=>{
    input.addEventListener('keyup', validaformulario);
    input.addEventListener('blur',validaformulario);
  });

  formulario.addEventListener('submit',(e)=>{
    e.preventDefault();
  })
//validacion formularios