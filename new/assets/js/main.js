// COUNTRIES NAME VARIABLE //
var C={locale:"en",countries:{AF:"Afghanistan",AL:"Albania",DZ:"Algeria",AS:"American Samoa",AD:"Andorra",AO:"Angola",AI:"Anguilla",AQ:"Antarctica",AG:"Antigua and Barbuda",AR:"Argentina",AM:"Armenia",AW:"Aruba",AU:"Australia",AT:"Austria",AZ:"Azerbaijan",BS:"Bahamas",BH:"Bahrain",BD:"Bangladesh",BB:"Barbados",BY:"Belarus",BE:"Belgium",BZ:"Belize",BJ:"Benin",BM:"Bermuda",BT:"Bhutan",BO:"Bolivia",BA:"Bosnia and Herzegovina",BW:"Botswana",BV:"Bouvet Island",BR:"Brazil",IO:"British Indian Ocean Territory",BN:"Brunei Darussalam",BG:"Bulgaria",BF:"Burkina Faso",BI:"Burundi",KH:"Cambodia",CM:"Cameroon",CA:"Canada",CV:"Cape Verde",KY:"Cayman Islands",CF:"Central African Republic",TD:"Chad",CL:"Chile",CN:"China",CX:"Christmas Island",CC:"Cocos (Keeling) Islands",CO:"Colombia",KM:"Comoros",CG:"Congo",CD:"Congo, the Democratic Republic of the",CK:"Cook Islands",CR:"Costa Rica",CI:"Cote D'Ivoire",HR:"Croatia",CU:"Cuba",CY:"Cyprus",CZ:"Czech Republic",DK:"Denmark",DJ:"Djibouti",DM:"Dominica",DO:"Dominican Republic",EC:"Ecuador",EG:"Egypt",SV:"El Salvador",GQ:"Equatorial Guinea",ER:"Eritrea",EE:"Estonia",ET:"Ethiopia",FK:"Falkland Islands (Malvinas)",FO:"Faroe Islands",FJ:"Fiji",FI:"Finland",FR:"France",GF:"French Guiana",PF:"French Polynesia",TF:"French Southern Territories",GA:"Gabon",GM:"Gambia",GE:"Georgia",DE:"Germany",GH:"Ghana",GI:"Gibraltar",GR:"Greece",GL:"Greenland",GD:"Grenada",GP:"Guadeloupe",GU:"Guam",GT:"Guatemala",GN:"Guinea",GW:"Guinea-Bissau",GY:"Guyana",HT:"Haiti",HM:"Heard Island and Mcdonald Islands",VA:"Holy See (Vatican City State)",HN:"Honduras",HK:"Hong Kong",HU:"Hungary",IS:"Iceland",IN:"India",ID:"Indonesia",IR:"Iran, Islamic Republic of",IQ:"Iraq",IE:"Ireland",IL:"Israel",IT:"Italy",JM:"Jamaica",JP:"Japan",JO:"Jordan",KZ:"Kazakhstan",KE:"Kenya",KI:"Kiribati",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KG:"Kyrgyzstan",LA:"Lao People's Democratic Republic",LV:"Latvia",LB:"Lebanon",LS:"Lesotho",LR:"Liberia",LY:"Libyan Arab Jamahiriya",LI:"Liechtenstein",LT:"Lithuania",LU:"Luxembourg",MO:"Macao",MK:"Macedonia, the Former Yugoslav Republic of",MG:"Madagascar",MW:"Malawi",MY:"Malaysia",MV:"Maldives",ML:"Mali",MT:"Malta",MH:"Marshall Islands",MQ:"Martinique",MR:"Mauritania",MU:"Mauritius",YT:"Mayotte",MX:"Mexico",FM:"Micronesia, Federated States of",MD:"Moldova, Republic of",MC:"Monaco",MN:"Mongolia",MS:"Montserrat",MA:"Morocco",MZ:"Mozambique",MM:"Myanmar",NA:"Namibia",NR:"Nauru",NP:"Nepal",NL:"Netherlands",NC:"New Caledonia",NZ:"New Zealand",NI:"Nicaragua",NE:"Niger",NG:"Nigeria",NU:"Niue",NF:"Norfolk Island",MP:"Northern Mariana Islands",NO:"Norway",OM:"Oman",PK:"Pakistan",PW:"Palau",PS:"Palestinian Territory, Occupied",PA:"Panama",PG:"Papua New Guinea",PY:"Paraguay",PE:"Peru",PH:"Philippines",PN:"Pitcairn",PL:"Poland",PT:"Portugal",PR:"Puerto Rico",QA:"Qatar",RE:"Reunion",RO:"Romania",RU:"Russian Federation",RW:"Rwanda",SH:"Saint Helena",KN:"Saint Kitts and Nevis",LC:"Saint Lucia",PM:"Saint Pierre and Miquelon",VC:"Saint Vincent and the Grenadines",WS:"Samoa",SM:"San Marino",ST:"Sao Tome and Principe",SA:"Saudi Arabia",SN:"Senegal",SC:"Seychelles",SL:"Sierra Leone",SG:"Singapore",SK:"Slovakia",SI:"Slovenia",SB:"Solomon Islands",SO:"Somalia",ZA:"South Africa",GS:"South Georgia and the South Sandwich Islands",ES:"Spain",LK:"Sri Lanka",SD:"Sudan",SR:"Suriname",SJ:"Svalbard and Jan Mayen",SZ:"Swaziland",SE:"Sweden",CH:"Switzerland",SY:"Syrian Arab Republic",TW:"Taiwan",TJ:"Tajikistan",TZ:"Tanzania, United Republic of",TH:"Thailand",TL:"Timor-Leste",TG:"Togo",TK:"Tokelau",TO:"Tonga",TT:"Trinidad and Tobago",TN:"Tunisia",TR:"Turkey",TM:"Turkmenistan",TC:"Turks and Caicos Islands",TV:"Tuvalu",UG:"Uganda",UA:"Ukraine",AE:"United Arab Emirates",GB:"United Kingdom",US:"United States of America",UM:"United States Minor Outlying Islands",UY:"Uruguay",UZ:"Uzbekistan",VU:"Vanuatu",VE:"Venezuela",VN:"Viet Nam",VG:"Virgin Islands, British",VI:"Virgin Islands, U.S.",WF:"Wallis and Futuna",EH:"Western Sahara",YE:"Yemen",ZM:"Zambia",ZW:"Zimbabwe",AX:"Åland Islands",BQ:"Bonaire, Sint Eustatius and Saba",CW:"Curaçao",GG:"Guernsey",IM:"Isle of Man",JE:"Jersey",ME:"Montenegro",BL:"Saint Barthélemy",MF:"Saint Martin (French part)",RS:"Serbia",SX:"Sint Maarten (Dutch part)",SS:"South Sudan",XK:"Kosovo"}}
// CLIENTS STATUS VARIABLE //
var C_status = [ ['Unknown', 'Desconocido', 'danger'],
                 ['Arrived', 'en Cuba', 'success'],
                 ['Overseas', 'en el Extranjero', 'warning'],
                 ['Arriving', 'Llegando', 'primary'],
                 ['Traveling', 'Viajando', 'info']
               ];

// SOME MODAL DEFINITIONS //
var clientModalShow = true;
var add_client_modal = new bootstrap.Modal(document.getElementById('add_client_modal'));
var add_voucher_modal = new bootstrap.Modal(document.getElementById('add_voucher_modal'));


var clientModalLabel = new bootstrap.Modal(document.getElementById('clientModal'));
var clientModalBody = document.getElementById('clientModalBody');

var default_clientModalBody = null;
var comp = 1;
var offset = 1;


// COOKIES FUNCTIONS //
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

// Function to set the actual position in the NavBar
function set_position( login = false ){
    document.title = document.title + ' - ' + position['title'];
    document.getElementById('position_title').innerHTML = position['title'];
    document.getElementById('position_sub_title').innerHTML = position['sub_title'];

    if ( login === false )
        document.getElementById('nav_link_' + position['var']).classList.add('active');
}

// Function show_alert with a modified BootStrapGrowl
function show_alert(type, message, timer = 10)
{
    console.log("Mostrando alerta de tipo \"" + type + "\" con mensaje \"" + message + "\"" );

    $.bootstrapGrowl(message, {
        type: type,
        width: "auto",
        offset: {from: 'top', amount: 80},
        align: "right",
        delay: timer * 1000
    });
}

function tokenize(rep_array, value){
    for (var key in rep_array) {
        
        if ( key === "status") {
            
            switch (rep_array[key]){
                case C_status[1][0]: rep_array[key] = C_status[1][1]; break;
                case C_status[2][0]: rep_array[key] = C_status[2][1]; break;
                case C_status[3][0]: rep_array[key] = C_status[3][1]; break;
                case C_status[4][0]: rep_array[key] = C_status[4][1]; break;
                default: rep_array[key] = C_status[0][1]; break;
            }    
        }

        value = value.replaceAll("{" + key + "}", rep_array[key]);
      }

    return value;
}

function populate_data(clients_data, offset = 1, m_table, m_table_row, type='client'){
  
  m_table[0].innerHTML = "";

  pag_level = Math.ceil(clients_data['info'][0].total / pagination);
  
  show_total(clients_data['info'][0].total, pagination, offset);
  generate_pagination(pag_level, offset);
 
  delete clients_data.info;

  if ( Object.keys(clients_data).length === 0 ){
    const error_row = document.createElement('td');
    error_row.classList.add("alert-danger", "text-center");
    error_row.style="padding: 10px;"
    switch (type){
        case "client": error_row.colSpan=6; break;
        case "voucher": error_row.colSpan=8; break;
    }

    error_row.innerHTML = "No existen elementos...";
    m_table.append(error_row);
    return false;
  }

  $q = 0;
  Object.keys(clients_data).forEach(key => {
          const new_row = document.createElement('tr');
          new_row.id = "data_u" + $q;
          new_row.dataset.userId = "u" + clients_data[key].id;
         
          switch (type){
              case "client":
                new_row.setAttribute('onclick', "show_client_modal(" + clients_data[key].id + ")");
                clients_data[key].status_type = status_type(clients_data[key].status);
                clients_data[key].full_name = clients_data[key].prefix + " " + clients_data[key].name + " " + clients_data[key].lastname;
                clients_data[key].country_lowercase = clients_data[key].country.toLowerCase();
                clients_data[key].country_full = C.countries[clients_data[key].country];
                break;
              
              case "voucher":
                  clients_data[key].data = nl2br(clients_data[key].data, false);
                  clients_data[key].profile_picture = "<a class=\"text-dark\" onclick=\"show_client_modal(" + clients_data[key].id + ")\" href='#'>" + clients_data[key].profile_picture + "</a>";
                  clients_data[key].additional_clients = show_companions(clients_data[key].companions);
                break;
          }


          let in_html = m_table_row[0].innerHTML;
          
          in_html = tokenize(clients_data[key], in_html);
                      
          new_row.innerHTML = in_html;
          m_table.append(new_row);

          m_table = $("#main-table-body");
          console.log("Populating database");
          $q++;
  });
}

function show_client_modal(id){
    
    if (clientModalShow == true)
    {
        $.get( "./api/?clients&show&id=" + id, function( data ) {
            modal_data = JSON.parse(data);

            let in_html = clientModalBody.innerHTML;
            default_clientModalBody = in_html;
            

            modal_data.status_type = status_type(modal_data.status);
            modal_data.country_lowercase = modal_data.country.toLowerCase();
            modal_data.full_name =  modal_data.name + " " + modal_data.lastname;
            modal_data.country_full =  C.countries[modal_data.country];

            in_html = tokenize( modal_data, in_html);

            
            clientModalBody.innerHTML = in_html;
            clientModalLabel.show()
            console.log("Mostrar modal con Usuario: " + id);
        });
      
       
    }    

}

function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    $res = (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');

    if ( $res.length > 30) $res = $res.substring(0, 30) + "...";

    return $res;
}


function show_companions(companions){
    var ret = "";
        
    if ( companions ){
            companions.forEach(val => {
                ret += "<button onclick=\"show_client_modal(" + val.id + ")\" class=\"btn btn-dark btn-sm ms-1\" title=\"" + val.name + "\">" + val.profile_picture + "</button>";
                //console.dir(val);
            });
    } else {
        ret = "Ninguno";
    }

    return ret;
}

function status_type(status){
        let status_type;
            switch (status.toLowerCase()){

                case C_status[1][0].toLowerCase(): status_type = C_status[1][2]; break;
                case C_status[3][0].toLowerCase(): status_type = C_status[3][2]; break;
                case C_status[2][0].toLowerCase(): status_type = C_status[2][2]; break;
                case C_status[4][0].toLowerCase(): status_type = C_status[4][2]; break;
                default: status_type = C_status[0][2]; break;
            }
        return status_type;
    }
    

//Generate the pagination based of total pages, and the offset
function generate_pagination(total_pages, offset)
{
    // Getting the pagination start DOM
    pag_nav = $("#main_client_pagination");
    pag_nav.empty();

    // Creating pagination "BACK" element
    let pag_nav_back = document.createElement("li");
    pag_nav_back.classList.add("page-item");

    let pag_nav_back_link = document.createElement("a");
    pag_nav_back_link.classList.add("page-link");
    pag_nav_back_link.innerHTML = "Atras";

    
    pag_nav_back.append(pag_nav_back_link);
    
    // Populating the pagination
    if (offset > 1)
        pag_nav_back.setAttribute('onclick', "pag_offset(" + (offset - 1 )+ ")");

    let pag_nav_foward = document.createElement("li");
    pag_nav_foward.classList.add("page-item");

    let pag_nav_foward_link = document.createElement("a");
    pag_nav_foward_link.classList.add("page-link");
    pag_nav_foward_link.innerHTML = "Siguiente";

    
    pag_nav_foward.append(pag_nav_foward_link);

    if (offset != total_pages)
        pag_nav_foward.setAttribute('onclick', "pag_offset(" + (offset + 1 )+ ")");

   pag_nav.append(pag_nav_back);

   for ( q = 1; q <= total_pages; q++ )
   {
        let pag_nav_q = document.createElement("li");
        let pag_nav_q_link = document.createElement("a");

        pag_nav_q.classList.add("page-item");

        if ( q == offset)
            pag_nav_q.classList.add("active");
        else
            pag_nav_q.setAttribute('onclick', "pag_offset(" + q + ")");

        pag_nav_q_link.id = "pag_offset";
        pag_nav_q_link.classList.add("page-link");
        pag_nav_q_link.innerHTML =  q;

        pag_nav_q.append(pag_nav_q_link);

        if ( (q === 1 || q === total_pages) && q !== offset){
           
            if ( offset > 3 && q === 1 ){
                pag_nav_q_link.innerHTML =  "Primera...";
                pag_nav_q_link.title =  "Ir a la primera pagina";
                pag_nav_q_link.classList.add("btn-white", "text-primary");
            } else if ( offset < total_pages - 3 && q === total_pages ) {
                pag_nav_q_link.innerHTML =  "...Ultima";
                pag_nav_q_link.title =  "Ir a la ultima pagina";
                pag_nav_q_link.classList.add("btn-white", "text-primary");
            }
            
        }   

        if ( q === 1 || q >= (offset - 2) && q <= (offset + 2) || q === total_pages )
         pag_nav.append(pag_nav_q);
   }

   pag_nav.append(pag_nav_foward);
    //console.log(total_pages)
    if ( total_pages <= 1)
        pag_nav.hide();
    else
        pag_nav.show();
}

// get the data depending the offset of the table
function pag_offset(offset)
{
    let search_value = $('#main_search')[0].value;

    $.get( "./api/?clients&list&pagination=" + pagination + "&offset=" + offset + "&data=" + search_value, function( data ) {
        populate_data(JSON.parse(data), offset, main_table, main_table_row); 
    });

}

function show_total(total_results, pagination, offset){
    let table_label_total = $('#table-label-total')[0];
    let table_label_min = $('#table-label-min')[0];
    let table_label_max = $('#table-label-max')[0];

    let total_min = (pagination * (offset - 1) );
    let total_max = (pagination * offset );

    if (total_max >= total_results)
        total_max = total_results;

    table_label_min.innerHTML = total_min;
    table_label_max.innerHTML = total_max;
    table_label_total.innerHTML = total_results;

    // if TOTAL is less than the pagination minimun, hide the pagination
    if ( total_results == 0)
        $('.table-label').hide();
    else
        $('.table-label').show();

}

function select_name(element, name , id) {
    
    $(element + "_autocomplete").empty();
    
    $(element + "_button").removeClass( "input-group-text" ).addClass( "btn btn-danger" );
    $(element + "_button").attr('onclick', "deselect(\"" + element + "\")");
    $(element + "_button").attr('title', "Cambiar cliente");

    $(element)[0].value = name;
    $(element + "_id")[0].value = id;

    $(element)[0].disabled = true;
    
    console.log("Selecting client " + name + " with ID: " + id);
}

function deselect(element) {

    $(element + "_button").removeClass( "btn btn-danger" ).addClass( "input-group-text" );
    $(element + "_button").attr('title', "");
    $(element)[0].disabled = false;
    $(element)[0].value = "";
}

function autocomplete_clients(element){

    $("#" + element.id + "_autocomplete").empty();

    if (element.value.length > 2)
    {
        $.get( "./api/?clients&list_min&data=" + element.value, function( data ) {
            data = JSON.parse(data);
            Object.keys(data).forEach(key => {
                main_element = document.createElement("div");
                main_element.classList.add("auto-element", "p-2");
                let full_name = data[key].name + " " + data[key].lastname;
                main_element.innerHTML = full_name;

                main_element.setAttribute('onclick', "select_name(\"#" + element.id + "\", \"" + full_name + "\", " + data[key].id + " )");
    
                $("#" + element.id + "_autocomplete").append(main_element);
            });
        });
    }
}

function reload_autocomplete(){
    $('.basicAutoComplete').autoComplete({
        resolver: 'custom',
        events: {
            search: function (qry, callback) {
                // let's do a custom ajax call
                $.ajax(
                    './api/?clients&list_min',
                    {
                        data: { 'q': qry}
                    }
                ).done(function (res) {
                    callback(JSON.parse(res))
                });
            }
        }
    });
    
    $('.basicAutoComplete').on('autocomplete.select', function (evt, item) {
        select_name("#" + this.id, item.text, item.value);
    });    
}

// ACTIONS //

// On Logout Button Click just LOGOUT and Reload
$("#logout_button").click(function() {
    $.get( "./api/?users&logout" );
    console.log("Login out user");
  
    setTimeout(function(){
      document.location = "./";
    }, 1 * 500);
  });
  
// Clear ClientModal and restoring
$("#clientModal").on("hidden.bs.modal", function () {
    clientModalBody.innerHTML = default_clientModalBody;
    console.log ("Cerrando modal y restableciendo por defecto...")
});

// On Remove Companion inside Modal
$("#remove_voucher_companion").click(function(){
    //console.log( "#companion_div_element_" + (comp - 1) );
    var companion_div = $("#companion_div_element_" + (comp - 1));
    var companion_div_auto = $("#avf_companion_" + (comp - 1) + "_autocomplete");
    companion_div.remove();
    companion_div_auto.remove();

    if (comp > 1){
        comp--;
    }
});

// On Add Companion inside Modal
$("#add_voucher_companion").click(function(){
    console.log ("Adding voucher companion");

    var companion_div = $("#voucher_companion_div");

    var companion_input = document.createElement('input');
    companion_input.type = "name";
    companion_input.placeholder = "Nombre del acompañante";
    companion_input.id = "avf_companion_" + comp;
    companion_input.name = "avf_companion[]";
    companion_input.classList.add("form-control", "basicAutoComplete");
    companion_input.setAttribute('autocomplete', "off");
    //companion_input.setAttribute('oninput', "autocomplete_clients(this)");
    

    var companion_input_hidden = document.createElement('input');
    companion_input_hidden.type = "hidden";
    companion_input_hidden.name = "avf_companion_id[]";
    companion_input_hidden.id = companion_input.id + "_id";


    var companion_autocomplete = document.createElement('div');
    companion_autocomplete.id = companion_input.id + "_autocomplete";

    const input_group = document.createElement("div");
    input_group.classList.add("input-group");
    input_group.id = companion_input.id + "_group";
    
    const input_group_text = document.createElement("span");
    input_group_text.classList.add("input-group-text");
    input_group_text.id = companion_input.id + "_button";

    const icon = document.createElement("i");
    icon.classList.add("fa", "fa-edit");
    

    input_group_text.append(icon);
    input_group.append(input_group_text);
    input_group.append(companion_input);
    input_group.append(companion_input_hidden);


    const companion = document.createElement('div');
    companion.id="companion_div_element_" + comp;
    companion.classList.add('w-100','d-flex', 'mt-2');
    companion.prepend(input_group);
    //companion.innerHTML = "<input type=\"name\" id=\"avf_companion[]\" placeholder=\"Nombre\" name=\"avf_companion[]\" class=\"form-control\"/>";

    companion_div.append(companion);
    companion_div.append(companion_autocomplete);
    comp++;

    reload_autocomplete();
});

// On submit the ADD Voucher Form
$("#add_voucher_form").submit(function(e) {
    e.preventDefault(); // Avoid form to execute

    // Getting the form and the validator data
    var form = $(this);
   
    // Execute only of validator is passed
        var form_data = new FormData(form[0]);
        
    // Execute the Database Query
        $.ajax({
            url: './api/?vouchers&add',
            type: 'POST',
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

// Setting Cookie for table size
$("#small_table_value").click(function(){
    if ( this.checked == true ){
        $("#main-table").addClass("table-sm");
        setCookie('sccs_visual_size', 'small', 7)
    } else {
        $("#main-table").removeClass("table-sm");
        setCookie('sccs_visual_size', 'normal', 7)
    }
    console.dir("Cambiando la vista de la tabla principal");
    
    // show_alert('success', "Agregar reserva a usuario: " + this.dataset.userId, 5);
    //  console.log(document.cookie);
});


$(document).ready(function() { 
   
    reload_autocomplete();

    // Reading sccs_visual_size Cookie and executing code for table size formatting
    if (  getCookie('sccs_visual_size') == "small" ) {
        $("#small_table_value").prop('checked', true);
        $("#main-table").addClass("table-sm");
    }

});

