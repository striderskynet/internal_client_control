
const main_table_row = $("#data-default");
var main_table = $("#main-table-body");

$.get( "./api/?clients&list", function( data ) {
    //console.log(data);
    populate_data(JSON.parse(data),1 , main_table, main_table_row); 
});

// Execute every time there is a click in a pagination element
$("a[id^='pag_offset']").click(function(){
});

// Reading sccs_visual_size Cookie and executing code for table size formatting
let size = getCookie('sccs_visual_size');
    if (  size == "small" )
    {
        $("#small_table_value").prop('checked', true);
        $("#clients_table").addClass("table-sm");
    }

// Execute every time there is a search in the search bar
$('#main_search').on("input propertychange", function () { 

    // only if value.length is bigger than the min_lenght
    if (this.value.length >= 3 )
    {
        let search_value = this.value;
        console.log ( "Searching for '" + search_value + "'");

        $data = "";
        // Executing API request for clients and especific search value
        $.get( "./api/?clients&list&data=" + search_value, function( data ) {

            // IF the API requst is not empty
            if ( data.toString() != null )
                populate_data(JSON.parse(data),1 , main_table, main_table_row); 

        });
    } else {
        // if value.lenght is shorter that min_lenght, show all results
        if ( this.value == "" )
        {
            $.get( "./api/?clients&list", function( data ) {
                populate_data(JSON.parse(data),1 , main_table, main_table_row); 
            });
        }
        
    }

});

// Execute the upload form
function upload_client_picture(){
    //var input_dom = document.createElement('input');
    
    setTimeout(function(){
        $('#upload_client_file').click();
    },200);
}

// Reload image frame on upload
$("#upload_client_file").on('change', function () {
    $("#upload_client_icon").hide();
    $("#upload_client_image")[0].src = URL.createObjectURL(this.files[0]);
    $("#upload_client_image").removeClass("hide");
   
    //console.dir(this.files[0]);
});

// Populate the Add Client Form countries select with C
function populate_countries_select()
{
    country_select = $("#acf_contact_country");
    Object.keys(C['countries']).forEach(key => {

        country_select.append($('<option>', {
            value: key,
            text: C['countries'][key]
        }));

    });
}
/*
// Some validation custom messages in spanish
$("#add_client_form").validate({
    messages: {
        acf_contact_name: "<span class='valid-error'>Escribe el nombre</span>",
        acf_contact_lastname: "<span class='valid-error'>Escribe el apellido</span>",
        acf_contact_email: {
        required: "<span class='valid-error'>Escribe el correo del contacto</span>",
        email: "<span class='valid-error'>Tu correo debe ser con formato: name@domain.com</span>"
      }
    }
  });
*/


// Add new client button 
$("#add_client_form").submit(function(e) {

    e.preventDefault();

    // Getting the form and the validator data
    var form = $(this);
   

    // Execute only of validator is passed
        var form_data = new FormData();
        var files = form[0].acf_client_picture.files[0];
        form_data.append('file',files);
        form_data.append('passport', form[0].acf_contact_passport.value);
        form_data.append('name', form[0].acf_contact_name.value);
        form_data.append('lastname', form[0].acf_contact_lastname.value);
        
        $.ajax({
            url: './api/?clients&upload',
            type: 'post',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(msg){
                //console.log(msg);
            },
        });
            
        
        // Executing API request to Insert Clients into Database
        $.ajax({
            method: "POST",
            url: "./api/?clients&add",
            // Passing all the variables
            data: { 
                name: form[0].acf_contact_name.value,
                lastname: form[0].acf_contact_lastname.value,
                prefix: form[0].acf_contact_prefix.value,
                passport: form[0].acf_contact_passport.value,
                phone: form[0].acf_contact_phone.value,
                email: form[0].acf_contact_email.value,
                country: form[0].acf_contact_country.value,
                company: form[0].acf_contact_company.value,
                status: form[0].acf_contact_status.value,
                observations: form[0].acf_contact_observations.value,
                last_touch: "ahora" 
            }
        }).done(function( msg ) {
            // if result is OK then close de Modal
            add_client_modal.hide();
            show_alert( "success", "Se ha agregado correctamente el usuario " + form[0].acf_contact_name.value + " " + form[0].acf_contact_lastname.value )
            
            $("#add_client_form")[0].reset();
            // Reload the main table data
            $.get( "./api/?clients&list", function( data ) {
                populate_data(JSON.parse(data),1 , main_table, main_table_row); 
            });
        });
    
    //}
});

function button_user_del(button){
    //$("#button_user_del").click(function(){
        clientModalShow = false;
    
        var user_id = button.dataset.userId.replace("u", "");
        let url_del_user = './api/?clients&delete&id=' + user_id;
        console.log("Llamando a api: " + url_del_user);
    
        $.get( url_del_user, function( data ) {
            show_alert('danger', "Se ha eliminado el usuario con ID: " + user_id, 5);
            //console.log(data);
            
            $.get( "./api/?clients&list", function( data ) {
                populate_data(JSON.parse(data),1 , main_table, main_table_row); 
            });
            
          });
          
        setTimeout(function(){
            clientModalShow = true;
        }, 200);
    };


$("#small_table_value").click(function(){
    if ( this.checked == true )
    {
        $("#clients_table").addClass("table-sm");
        setCookie('sccs_visual_size', 'small', 7)
    }
    else
    {
        $("#clients_table").removeClass("table-sm");
        setCookie('sccs_visual_size', 'normal', 7)
    }

    console.dir("Cambiando la vista de la tabla principal");
    //$("#clients_table").classList.add("table-sm");
    // show_alert('success', "Agregar reserva a usuario: " + this.dataset.userId, 5);
    //  console.log(document.cookie);
});
    
function button_voucher_add(button){

    clientModalShow = false;

    add_voucher_modal.show();

    let id = button.dataset.userId;
    let name = button.dataset.userName;
    
    select_name("#mres_client_name", name, id);

    setTimeout(function(){
        clientModalShow = true;
    }, 200);
    
};
    
$("#button_client_add").click(function(){

    console.log("Mostrando modal de Cliente Nuevo");
    add_client_modal.show();
    console.log("Populando lista de paises");
    populate_countries_select();
    

    //show_alert('success', 'Nuevo cliente agregado', 5);
});

    
function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}