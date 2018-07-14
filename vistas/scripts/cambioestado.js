 var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}

//Función limpiar
function limpiar()
{
	$("#idAF").val("");
	$("#codprestadorservicio").val("");
	$("#razonsocial").val("");
	$("#tipoidentificacion").val("");
	$("#numeroidentificacion").val("");
	$("#numerofactura").val("");
	$("#fechaexpedicionfactura").val("");
	$("#fechainiciofactura").val("");
	$("#fechafinalfactura").val("");
	$("#codigoentidadadministradora").val("");
	$("#nombreentidadadministradora").val("");
	$("#numerocontacto").val("");
	$("#plandebeneficios").val("");
	$("#numerodepoliza").val("");
	$("#valorcopago").val("");
	$("#valorcomision").val("");
	$("#valordescuentos").val("");
	$("#valorneto").val("");
	$("#fecharadicado").val("");
	$("#glosa").val("");
	$("#valorglosa").val("");
	$("#devolucion").val("");
	$("#notacredito").val("");
	$("#observaciones").val("");
	$("#usuario").val("");
	$("#estado").val("");
	$("#estadopersistencia").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/cambioestado.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/cambioestado.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idAF)
{
	$.post("../ajax/cambioestado.php?op=mostrar",{idAF : idAF}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idAF").val(data.idAF);
		$("#codprestadorservicio").val(data.codprestadorservicio);
		$("#razonsocial").val(data.razonsocial);
		$("#tipoidentificacion").val(data.tipoidentificacion);
		$("#numeroidentificacion").val(data.numeroidentificacion);
		$("#numerofactura").val(data.numerofactura);
		$("#fechaexpedicionfactura").val(data.fechaexpedicionfactura);
		$("#fechainiciofactura").val(data.fechainiciofactura);
		$("#fechafinalfactura").val(data.fechafinalfactura);
		$("#codigoentidadadministradora").val(data.codigoentidadadministradora);
		$("#nombreentidadadministradora").val(data.nombreentidadadministradora);
		$("#numerocontacto").val(data.numerocontacto);
		$("#plandebeneficios").val(data.plandebeneficios);
		$("#numerodepoliza").val(data.numerodepoliza);
		$("#valorcopago").val(data.valorcopago);
		$("#valorcomision").val(data.valorcomision);
		$("#valordescuentos").val(data.valordescuentos);
		$("#valorneto").val(data.valorneto);
		$("#fecharadicado").val(data.fecharadicado);
		$("#glosa").val(data.glosa);
		$("#valorglosa").val(data.valorglosa);
		$("#devolucion").val(data.devolucion);
		$("#notacredito").val(data.notacredito);
		$("#observaciones").val(data.observaciones);
		$("#usuario").val(data.usuario);
		$("#estado").val(data.estado);
		$("#estadopersistencia").val(data.estadopersistencia);
 	});
}

//Función para desactivar registros
function desactivar(idAF)
{
	bootbox.confirm("¿Está Seguro de desactivar el Registro?", function(result){
		if(result)
        {
        	$.post("../ajax/cambioestado.php?op=desactivar", {idAF : idAF}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idAF)
{
	bootbox.confirm("¿Está Seguro de activar el Registro?", function(result){
		if(result)
        {
        	$.post("../ajax/cambioestado.php?op=activar", {idAF : idAF}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();