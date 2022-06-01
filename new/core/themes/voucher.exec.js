const voucher_default_row = $("#data-default");
var voucher_main_table = $("#main-table-body");

// Populate the main Table on Load
$.get( "./api/?vouchers&list", function( data ) {
    populate_data(JSON.parse(data),1, voucher_main_table, voucher_default_row, "voucher" ); 
});

// Execute when "ADD Voucher" button is clicked
$("#button_voucher_add").click(function(){
    
    console.log("Mostrando modal de Reserva Nueva");

    // Show "ADD Voucher" modal
    add_voucher_modal.show();
});

// Execute every time there is a search in the search bar
$('#main_search').prop("disabled", true);
$('#main_search').prop("title", "Deshabilitada la busqueda hasta nueva version");


$("#add_voucher_form").submit(function(e) {

    e.preventDefault();

    // Getting the form and the validator data
    var form = $(this);
   
    // Execute only of validator is passed
        var form_data = new FormData(form[0]);
        
    // Execute the Database Query
        $.ajax({
            url: './api/?vouchers&add',
            type: 'post',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(msg){
           
                add_voucher_modal.hide();
                show_alert( "success", "Se ha agregado correctamente la reserva" );
                
                $("#add_voucher_form")[0].reset();
                // Reload the main table data
                $.get( "./api/?vouchers&list", function( data ) {
                    populate_data(JSON.parse(data),1 , voucher_main_table, voucher_default_row, "voucher"); 
                });
        }
    });
    
});

// Execute when "DEL Voucher" button is pressed
function button_voucher_del(button){
    //$("#button_user_del").click(function(){
        clientModalShow = false;
    
        // Getting voucherID from DataSet
        var voucher_id = button.dataset.userId.replace("v", "");
        let url_del_voucher = './api/?vouchers&delete&id=' + voucher_id;
    
        // Executing the API for VOUCHER DELETION
        $.get( url_del_voucher, function( data ) {
            show_alert('danger', "Se ha eliminado el Voucher con ID: " + voucher_id, 5);
            
            // Populate the main Table
            $.get( "./api/?vouchers&list", function( data ) {
                populate_data(JSON.parse(data),1 , voucher_main_table, voucher_default_row, "voucher"); 
            });
            
          });
          
        // Wait TIME for reloading
        setTimeout(function(){
            clientModalShow = true;
        }, 200);
    };


var add_voucher_modal_shown = document.getElementById('add_voucher_modal')
add_voucher_modal_shown.addEventListener('shown.bs.modal', function (event) {
});