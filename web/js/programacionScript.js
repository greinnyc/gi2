var programacion_obj = [];
function agregarProgramacion(){
	if($('#id_programa').val() != ""){
		//editar programa
		programacion_obj.forEach( function(valor, indice, array) {
			if(valor.id == $('#id_programa').val()){
				valor.fecha_inicial = $("#dateini").val();
				valor.fecha_final = $("#datefin").val();
				valor.hora_inicio= $("#timeini").val();
                valor.hora_fin = $("#timefin").val();
			}
	    });
	}else{
		//agregar programa
		//se capturan los datos
		var fecha_inicial = $("#dateini").val();
		var fecha_final = $("#datefin").val();
		var hora_inicio = $("#timeini").val();
		var hora_fin = $("#timefin").val();
		var ind = programacion_obj.length;
	    var btn = '<a class="btn-editar-programa" id="btn-'+ind+'"><span class="glyphicon glyphicon-pencil" title="Editar"></span></a>';
	    programa ={
        				id:ind,
        				programacion_codigo:0,
        				fecha_inicial:fecha_inicial,
        				fecha_final:fecha_final,
        				hora_inicio:hora_inicio,
        				hora_fin:hora_fin,
        				btn:btn
    			  }
	
	    programacion_obj.push(programa);
	}
	//se arma el array para imprimir el datatable
    var array_datatable = [];
    programacion_obj.forEach( function(valor, indice, array) {
        var data_datatable = [];
        data_datatable = [
                            valor.fecha_inicial,
                            valor.fecha_final,
                            valor.hora_inicio,
                            valor.hora_fin,
                            valor.btn
                         ]
        array_datatable.push(data_datatable);

    });
    var table = $('#table_programacion').DataTable();
    table.destroy();   
    $('#table_programacion').DataTable( {
            'responsive': true,
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "lengthMenu": [ 4 ],
            "info":     false,
            "paging":false,
            data:  array_datatable,
            columns: [
                        { title: "Fecha Inicial" },
                        { title: "Fecha Final" },
                        { title: "Hora Inicial" },
                        { title: "Hora Final" },
                        { title: "" },

                    ]
    });

	$('#dateini').val("");
	$('#datefin').val("");
	$('#timeini').val("");
	$('#timefin').val("");
	$("#id_programa").val("");

    $('#table_program_data').val(JSON.stringify(programacion_obj));

}

$(document).on('click', '.btn-editar-programa', function(id){
	var id = this.id;
	id = id.split('-');
	id = id[1];
	programacion_obj.forEach( function(valor, indice, array) {
		if(valor.id == id){
			var fecha_inicial = valor.fecha_inicial.split("/");
			var fecha_final = valor.fecha_final.split("/");
			var hora_inicio = valor.hora_inicio.split(":");
			var hora_fin    = valor.hora_fin.split(":");
			//$("#dateini").kvDatepicker("update", new Date(fecha_inicial[2], fecha_inicial[1]-1, fecha_inicial[0]));
			//$("#datefin").kvDatepicker("update", new Date(fecha_final[2], fecha_final[1]-1, fecha_final[0]));

			$("#dateini").val(valor.fecha_inicial);
			$("#datefin").val(valor.fecha_final);
			$('#timeini').val(hora_inicio[0]+":"+hora_inicio[1]);
			$('#timefin').val(hora_fin[0]+":"+hora_fin[1]);
			$("#id_programa").val(id);
		}
   

    });

})


function cargarDatatableProgramacion(){
	$.post($('.programacion_url').attr('id'), function( data ) {
                data = [data.data];
                var array_datatable = []
                var array_obj = []
                var ind = 0;
                data[0].forEach( function(valor, indice, array) {
                	console.log(indice);
                	console.log(valor.fecha_inicial);
                    var btn = '<a class="btn-editar-programa" id="btn-'+ind+'"><span class="glyphicon glyphicon-pencil" title="Editar"></span></a>';
                	//valores de un programa
                	data_datatable = [];
                	var programa = {};
                	var fecha_inicial = valor.fecha_inicial;
                	var fecha_final = valor.fecha_final;
                	fecha_inicial = fecha_inicial.split("-");
                	fecha_inicial = fecha_inicial[2]+"/"+fecha_inicial[1]+"/"+fecha_inicial[0];
                	fecha_final = fecha_final.split("-");
                	fecha_final = fecha_final[2]+"/"+fecha_final[1]+"/"+fecha_final[0];
                	programa ={
	                				id:ind,
	                				programacion_codigo:valor.programacion_codigo,
	                				fecha_inicial:fecha_inicial,
	                				fecha_final:fecha_final,
	                				hora_inicio:valor.hora_inicio,
	                				hora_fin:valor.hora_fin,
	                				btn:btn
                			  }

    			    data_datatable = [
			                            fecha_inicial,
			                            fecha_final,
			                            valor.hora_inicio,
			                            valor.hora_fin,
			                            btn
			                         ]
                 	programacion_obj.push(programa);
                 	//array que se imprime en el datatable
                    array_datatable.push(data_datatable);
                    ind++;
                });

                var table = $('#table_programacion').DataTable();
                table.destroy();   
                $('#table_programacion').DataTable( {
			            'responsive': true,
			            "searching": false,
			            "lengthChange": false,
			            "ordering": false,
			            "lengthMenu": [ 4 ],
			            "info":     false,
			            "paging":false,
			            data:  array_datatable,
			            columns: [
			                        { title: "Fecha Inicial" },
			                        { title: "Fecha Final" },
			                        { title: "Hora Inicial" },
			                        { title: "Hora Final" },
			                        { title: "" },

			                    ]
			    });
    			$('#table_program_data').val(JSON.stringify(programacion_obj));

    })
}
