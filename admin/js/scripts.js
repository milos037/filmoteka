$(document).ready(function(){
   

    // BULK OPTIONS
    $('#selectAllBoxes').click(function(){

        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;

            });
        }  else {
             $('.checkBoxes').each(function(){
                this.checked = false;
        	});
         }
        });
   

    
    

            
});

$(document).ready(function() {
    $('#example').DataTable({
        pageLength: 25,
        order: [ 1, 'desc' ]
    });
} );

$('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 