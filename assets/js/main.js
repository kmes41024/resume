$(document).ready(function() {
	$('#example0').DataTable();
} );

$(document).ready(function() {
	var table = $('#example').DataTable({
		"columnDefs": [
			{ "visible": false, "targets": 2 }
		],
		"order": [[ 2, 'asc' ]],
		"displayLength": 25,
		"drawCallback": function ( settings ) {
			var api = this.api();
			var rows = api.rows( {page:'current'} ).nodes();
			var last=null;
 
			api.column(2, {page:'current'} ).data().each( function ( group, i ) {
				if ( last !== group ) {
					$(rows).eq( i ).before(
						'<tr class="group"><td colspan="5">'+group+'</td></tr>'
					);
 
					last = group;
				}
			} );
		}
	} );
 
	// Order by the grouping
	$('#example tbody').on( 'click', 'tr.group', function () {
		var currentOrder = table.order()[0];
		if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
			table.order( [ 2, 'desc' ] ).draw();
		}
		else {
			table.order( [ 2, 'asc' ] ).draw();
		}
	} );
} );

function downLoad(path)
{
	$("#download").attr('href',path); 
	$("#download").attr('download','resume.pdf') ;  
}

function review(filepath)
{
	var dir = "ViewerJS/web/download.html?file="+filepath;
	$("#reviewModal #reviewModel_title").html('履历查看');
	$("#reviewModal iframe").prop('src', dir);
	$("#reviewModal").modal({backdrop:'static',show:true,keyboard:false});
}

function exitPreview()
{
	$("#editModal").modal('hide');
}

function edit(id)
{
	console.log(id);
}