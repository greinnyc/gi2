function uploadFile(){
	var formData = new FormData();
	//var documento = $('#eventos-file');
	//var documento = document.getElementById('eventos-file');
	var documento = $("#eventos-file").prop("files")[0]; 
	console.log(documento)
	formData.append("file", documento);
	console.log(formData);
	var url = $('.file_url').attr('id');
	console.log(url);
	$.ajax({
		url: url,
		type: "post",
		enctype: 'multipart/form-data',
		data: formData,
		contentType: false,
        cache: false,
        processData: false,
	})
	.done(function(res){
		console.log(res);
	});

	


	//formData.append("dato", "valor");

}


//selecciona un empleado del staff del evento para editarlo
function selecionarEmpleadoStaff(id){
	var url =$('.staff_empleado_url').attr('id');
	url = url+'?empleadoStaff='+id;
	//console.log(url+'?empleadoStaff='+id);

	$.post(url, function( data ) {
		data.forEach( function(valor, indice, array) {
			console.log(valor);
			$('#staff_empleado').val(valor.empleado_codigo).trigger('change');
			$('#staff_tarea').val(valor.tarea_codigo).trigger('change');
			$('#estado_staff_empleado').val(valor.activo).trigger('change');
			$('#id_staff').val(id);


		});
	});
}

//agrega o edita un empleado del staff de un evento
function saveEmpleadoStaff(){
	var empleado_staff = $('#staff_empleado').val();
	var tarea_staff = $('#staff_tarea').val();
	var estado_staff = $('#estado_staff_empleado').val();
	var staff_codigo = $('#id_staff').val();
	var evento_codigo = $('#evento_codigo').val();
	var url =$('.save_staff_empleado').attr('id');
	url = url+'?staff_codigo='+staff_codigo+'&staff_empleado='+empleado_staff+'&tarea_codigo='+tarea_staff+'&activo='+estado_staff+'&evento_codigo='+evento_codigo;
	$.post(url, function( data ) {
		$.pjax.reload({
                container:"#staff_evento",
                replace: false,
                push:false,
                timeout:5000
            });
	});
	$('#staff_empleado').val('').trigger('change');
	$('#staff_tarea').val('').trigger('change');
	$('#estado_staff_empleado').val('').trigger('change');
	$('#id_staff').val(0);

}
	
var items_obj = [];
function agregarItems(){
	if($('#id_item').val() != ""){
		//editar item
		items_obj.forEach( function(valor, indice, array) {
			if(valor.id == $('#id_item').val()){
				    
					valor.item_nombre = $( "#item_codigo option:selected" ).text();;
					valor.item_codigo = $('#item_codigo').val();
					valor.item_cantidad= $('#eventos-cantidad').val();;
					valor.item_stock = $('#eventos-cantidad').val();
	                valor.item_estado = ($('#eventos-estado_item').is(":checked") == true)?'1':'0';


			}
	    });
	}else{
		//agregar item
		//se capturan los datos
		var item_codigo = $('#item_codigo').val();
		var nombre_item = $( "#item_codigo option:selected" ).text();
		var cantidad = $('#eventos-cantidad').val();	
		var estado = ($('#eventos-estado_item').is(":checked") == true)?'1':'0';
		var ind = items_obj.length;
	    var btn = '<a class="btn-editar-item" id="btn-'+ind+'"><span class="glyphicon glyphicon-pencil" title="Editar"></span></a>'

		var item =  {
						id:ind,
						item_evento_codigo:0,
						item_nombre:nombre_item,
						item_codigo:item_codigo,
						item_cantidad:cantidad,
						item_stock:cantidad,
		                item_estado:estado,
						btn:btn
			        }

	    items_obj.push(item);
	}
	//se arma el array para imprimir el datatable
    var array_datatable = []
    items_obj.forEach( function(valor, indice, array) {
        var data_datatable = [];
    	data_datatable = [
                            valor.item_nombre,
                            valor.item_cantidad,
                            valor.item_stock,
                            valor.item_estado,
                            valor.btn
                         ]
        array_datatable.push(data_datatable);

    });
    var table = $('#table_items').DataTable();
    table.destroy();   
    $('#table_items').DataTable( {
            'responsive': true,
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "lengthMenu": [ 4 ],
            "info":     false,
            "paging":false,
            data:  array_datatable,
            columns: [
                        { title: "Nombre" },
                        { title: "Cantidad" },
                        { title: "Stock" },
                        { title: "Estado" },
                        { title: "" },
                    ]
    });

	$('#item_codigo').val("").trigger('change');
	$("#eventos-estado_item").attr("checked", false);
	$("#id_item").val("");
	$('#eventos-cantidad').val("");
    $('#table_items_data').val(JSON.stringify(items_obj));

}

$(document).on('click', '.btn-editar-item', function(id){
	var id = this.id;
	id = id.split('-');
	id = id[1];
	items_obj.forEach( function(valor, indice, array) {
		if(valor.id == id){
			var estado = (valor.item_estado == '1')?true:false;
			$('#item_codigo').val(valor.item_codigo).trigger('change');
			$("#eventos-estado_item").attr("checked", estado);
			$("#id_item").val(id);
			$('#eventos-cantidad').val(valor.item_cantidad);

			/*var $el = $('#eventos-estado_item'), opts = $el.attr('data-krajee-bootstrapSwitch');
			console.log(opts);
    		$el.bootstrapSwitch(opts);*/

		}
   

    });

})


function cargarDatatable(){
	$.post($('.item_url').attr('id'), function( data ) {
        data = [data.data];
        var array_datatable = []
        var array_obj = []
        var ind = 0;
        data[0].forEach( function(valor, indice, array) {
            var btn = '<a class="btn-editar-item" id="btn-'+ind+'"><span class="glyphicon glyphicon-pencil" title="Editar"></span></a>'
        	//valores de un item
        	data_datatable = [];
        	var item = {};
        	item ={
            				id:ind,
            				item_evento_codigo:valor.item_evento_codigo,
            				item_nombre:valor.nombre,
            				item_codigo:valor.item_codigo,
            				item_cantidad:valor.cantidad,
            				item_stock:valor.stock,
            				item_estado:valor.estado,
            				btn:btn
        			  }

		    data_datatable = [
	                            valor.nombre,
	                            valor.cantidad,
	                            valor.stock,
	                            valor.estado,
	                            btn
	                         ]
         	items_obj.push(item);

         	//array que se imprime en el datatable
            array_datatable.push(data_datatable);
            ind++;
        });

        var table = $('#table_items').DataTable();
        table.destroy();   
        $('#table_items').DataTable( {
	            'responsive': true,
	            "searching": false,
	            "lengthChange": false,
	            "ordering": false,
	            "lengthMenu": [ 4 ],
	            "info":     false,
	            "paging":false,
	            data:  array_datatable,
	            columns: [
	                        { title: "Nombre" },
	                        { title: "Cantidad" },
	                        { title: "Stock" },
	                        { title: "Estado" },
	                        { title: "" },

	                    ]
	    });
	$('#table_items_data').val(JSON.stringify(items_obj));

    })
}
