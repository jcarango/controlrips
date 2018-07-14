var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(0);
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
	$("#estado").val("");
	$("#estadopersistencia").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag == 1)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#listadoregistroshistorial").hide();
		//$("#btnagregar").hide();
	}
	else if (flag == 0)
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#listadoregistroshistorial").hide();
		//$("#btnagregar").show();
	}
	else
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").hide();
		$("#listadoregistroshistorial").show();
		//$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(0);
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
					url: '../ajax/cuentasmedicas.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 7,//Paginación
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
		url: "../ajax/cuentasmedicas.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(0);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idAF)
{
	$.post("../ajax/cuentasmedicas.php?op=mostrar",{idAF : idAF}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(1);

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
		$("#estado").val(data.estado);
		$("#estadopersistencia").val(data.estadopersistencia);
		$("#fecharadicado").val(data.fecharadicado);
 	});

}

function mostrarhistorialx(idAF)
{
	$.post("../ajax/cuentasmedicas.php?op=mostrarhistorial",{idAF : idAF}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(2);

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
		$("#estado").val(data.estado);
		$("#estadopersistencia").val(data.estadopersistencia);
		$("#fecharadicado").val(data.fecharadicado);
 	});

}

//Función para desactivar registros
function desactivar(idAF)
{
	bootbox.confirm("¿Está Seguro de actualizar el Registro?", function(result){
		if(result)
        {
        	$.post("../ajax/cuentasmedicas.php?op=desactivar", {idAF : idAF}, function(e){
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
        	$.post("../ajax/cuentasmedicas.php?op=activar", {idAF : idAF}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

init();
