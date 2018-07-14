var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();
	//$("#fechainicio").change(listar);
	//$("#fechafin").change(listar);
}

//Función Listar
function listar()
{
	//var fechainicio = $("#fechainicio").val();
	//var fechafin = $("#fechafin").val();

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
					url: '../ajax/informeliquidacionAC.php?op=listar',
					//data:{fechainicio: fechainicio, fechafin: fechafin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

init();