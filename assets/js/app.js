var actualClientId = 0;
function goTo(URI)
{
    window.location = URI;
}

function deleteUser(id, name)
{
    confVar = confirm("Esta seguro de eliminar al cliente \"" + name + "\" con ID: " + id);

    if ( confVar )
    {
        window.location = "/?del_user=" + id;
    }
}

// initialize validation messages variable
$.validation = {
    messages: {}
};

// add validation templates to show fancy icons with message text
$.extend($.validation.messages, {
    required: '<i class="fa fa-exclamation-circle"></i> Este campo es requerido.',
});

// call our 'validateContactForm' function when page is ready
$(document).ready(function () {
    validateContactForm();
});

// bind jQuery validation event and form 'submit' event
var validateContactForm = function () {
    var modal_contact = $('#modal_contact');
    var modal_form_contact = $('#modal_form_contact');

    modal_form_contact.validate({
        rules: {
            modal_contact_firstname: {
                required: true      // firstname field is required
            },
            modal_contact_email: {
                required: true,
                email: true      // lastname field is required
            },
            modal_contact_phone: {
                required: true      // lastname field is required
            },
            modal_contact_passport: {
                required: true,     // email field is required
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            modal_contact_message: {
                required: false      // message field is required
            }
        },
        messages: {
            modal_contact_firstname: {
                required: $.validation.messages.required
            },
            modal_contact_phone: {
                required: $.validation.messages.required
            },
            modal_contact_passport: {
                required: $.validation.messages.required
            },
            modal_contact_email: {
                required: $.validation.messages.required
            },
            modal_contact_message: {
                required: $.validation.messages.required
            }
        },
        errorPlacement: function (error, element) {
            // insert error message after invalid element
            error.insertAfter(element);

            // hide error message on window resize event
            $(window).resize(function () {
                error.remove();
            });
        },
        invalidHandler: function (event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
            } else {
            }
        }
    });

    modal_contact.on('hide.bs.modal', function (e) {
        // reset form fields and validation errors
        modal_form_contact.validate().resetForm();
        modal_form_contact.trigger('reset');
    });
}



C={locale:"en",countries:{AF:"Afghanistan",AL:"Albania",DZ:"Algeria",AS:"American Samoa",AD:"Andorra",AO:"Angola",AI:"Anguilla",AQ:"Antarctica",AG:"Antigua and Barbuda",AR:"Argentina",AM:"Armenia",AW:"Aruba",AU:"Australia",AT:"Austria",AZ:"Azerbaijan",BS:"Bahamas",BH:"Bahrain",BD:"Bangladesh",BB:"Barbados",BY:"Belarus",BE:"Belgium",BZ:"Belize",BJ:"Benin",BM:"Bermuda",BT:"Bhutan",BO:"Bolivia",BA:"Bosnia and Herzegovina",BW:"Botswana",BV:"Bouvet Island",BR:"Brazil",IO:"British Indian Ocean Territory",BN:"Brunei Darussalam",BG:"Bulgaria",BF:"Burkina Faso",BI:"Burundi",KH:"Cambodia",CM:"Cameroon",CA:"Canada",CV:"Cape Verde",KY:"Cayman Islands",CF:"Central African Republic",TD:"Chad",CL:"Chile",CN:"China",CX:"Christmas Island",CC:"Cocos (Keeling) Islands",CO:"Colombia",KM:"Comoros",CG:"Congo",CD:"Congo, the Democratic Republic of the",CK:"Cook Islands",CR:"Costa Rica",CI:"Cote D'Ivoire",HR:"Croatia",CU:"Cuba",CY:"Cyprus",CZ:"Czech Republic",DK:"Denmark",DJ:"Djibouti",DM:"Dominica",DO:"Dominican Republic",EC:"Ecuador",EG:"Egypt",SV:"El Salvador",GQ:"Equatorial Guinea",ER:"Eritrea",EE:"Estonia",ET:"Ethiopia",FK:"Falkland Islands (Malvinas)",FO:"Faroe Islands",FJ:"Fiji",FI:"Finland",FR:"France",GF:"French Guiana",PF:"French Polynesia",TF:"French Southern Territories",GA:"Gabon",GM:"Gambia",GE:"Georgia",DE:"Germany",GH:"Ghana",GI:"Gibraltar",GR:"Greece",GL:"Greenland",GD:"Grenada",GP:"Guadeloupe",GU:"Guam",GT:"Guatemala",GN:"Guinea",GW:"Guinea-Bissau",GY:"Guyana",HT:"Haiti",HM:"Heard Island and Mcdonald Islands",VA:"Holy See (Vatican City State)",HN:"Honduras",HK:"Hong Kong",HU:"Hungary",IS:"Iceland",IN:"India",ID:"Indonesia",IR:"Iran, Islamic Republic of",IQ:"Iraq",IE:"Ireland",IL:"Israel",IT:"Italy",JM:"Jamaica",JP:"Japan",JO:"Jordan",KZ:"Kazakhstan",KE:"Kenya",KI:"Kiribati",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KG:"Kyrgyzstan",LA:"Lao People's Democratic Republic",LV:"Latvia",LB:"Lebanon",LS:"Lesotho",LR:"Liberia",LY:"Libyan Arab Jamahiriya",LI:"Liechtenstein",LT:"Lithuania",LU:"Luxembourg",MO:"Macao",MK:"Macedonia, the Former Yugoslav Republic of",MG:"Madagascar",MW:"Malawi",MY:"Malaysia",MV:"Maldives",ML:"Mali",MT:"Malta",MH:"Marshall Islands",MQ:"Martinique",MR:"Mauritania",MU:"Mauritius",YT:"Mayotte",MX:"Mexico",FM:"Micronesia, Federated States of",MD:"Moldova, Republic of",MC:"Monaco",MN:"Mongolia",MS:"Montserrat",MA:"Morocco",MZ:"Mozambique",MM:"Myanmar",NA:"Namibia",NR:"Nauru",NP:"Nepal",NL:"Netherlands",NC:"New Caledonia",NZ:"New Zealand",NI:"Nicaragua",NE:"Niger",NG:"Nigeria",NU:"Niue",NF:"Norfolk Island",MP:"Northern Mariana Islands",NO:"Norway",OM:"Oman",PK:"Pakistan",PW:"Palau",PS:"Palestinian Territory, Occupied",PA:"Panama",PG:"Papua New Guinea",PY:"Paraguay",PE:"Peru",PH:"Philippines",PN:"Pitcairn",PL:"Poland",PT:"Portugal",PR:"Puerto Rico",QA:"Qatar",RE:"Reunion",RO:"Romania",RU:"Russian Federation",RW:"Rwanda",SH:"Saint Helena",KN:"Saint Kitts and Nevis",LC:"Saint Lucia",PM:"Saint Pierre and Miquelon",VC:"Saint Vincent and the Grenadines",WS:"Samoa",SM:"San Marino",ST:"Sao Tome and Principe",SA:"Saudi Arabia",SN:"Senegal",SC:"Seychelles",SL:"Sierra Leone",SG:"Singapore",SK:"Slovakia",SI:"Slovenia",SB:"Solomon Islands",SO:"Somalia",ZA:"South Africa",GS:"South Georgia and the South Sandwich Islands",ES:"Spain",LK:"Sri Lanka",SD:"Sudan",SR:"Suriname",SJ:"Svalbard and Jan Mayen",SZ:"Swaziland",SE:"Sweden",CH:"Switzerland",SY:"Syrian Arab Republic",TW:"Taiwan",TJ:"Tajikistan",TZ:"Tanzania, United Republic of",TH:"Thailand",TL:"Timor-Leste",TG:"Togo",TK:"Tokelau",TO:"Tonga",TT:"Trinidad and Tobago",TN:"Tunisia",TR:"Turkey",TM:"Turkmenistan",TC:"Turks and Caicos Islands",TV:"Tuvalu",UG:"Uganda",UA:"Ukraine",AE:"United Arab Emirates",GB:"United Kingdom",US:"United States of America",UM:"United States Minor Outlying Islands",UY:"Uruguay",UZ:"Uzbekistan",VU:"Vanuatu",VE:"Venezuela",VN:"Viet Nam",VG:"Virgin Islands, British",VI:"Virgin Islands, U.S.",WF:"Wallis and Futuna",EH:"Western Sahara",YE:"Yemen",ZM:"Zambia",ZW:"Zimbabwe",AX:"Åland Islands",BQ:"Bonaire, Sint Eustatius and Saba",CW:"Curaçao",GG:"Guernsey",IM:"Isle of Man",JE:"Jersey",ME:"Montenegro",BL:"Saint Barthélemy",MF:"Saint Martin (French part)",RS:"Serbia",SX:"Sint Maarten (Dutch part)",SS:"South Sudan",XK:"Kosovo"}}

    const data = JSON.parse(dataText);
    
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
  "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];
          
    function monthDiff(d1, d2) {
        var months;
        months = (d2.getFullYear() - d1.getFullYear()) * 12;
        months -= d1.getMonth();
        months += d2.getMonth();
        return months <= 0 ? 0 : months;
    }

    function populateCountry(select)
    {
        Object.keys(C.countries).forEach(key => {

                var opt = document.createElement('option');
                opt.value = key;
                opt.innerHTML =C.countries[key];
                select.appendChild(opt);
        });
    }

    function populateTable(search)
    {

        var output = "";
        var lastDate = new Date("1977/02/02");
        Object.keys(data).forEach(key => {
           
            inDate = new Date(data[key].date.toLowerCase());

            if ( !search || 
            data[key].name.toLowerCase().search(search.toLowerCase()) >= 0 || 
            data[key].passport.toLowerCase().search(search.toLowerCase()) >= 0 ||
           //data[key].phone.toLowerCase().search(search.toLowerCase()) >= 0 ||
            data[key].date.toLowerCase().search(search.toLowerCase()) >= 0 ||
            C.countries[data[key].country].toLowerCase().search(search.toLowerCase()) >= 0 ||
            data[key].email.toLowerCase().search(search.toLowerCase()) >= 0)
            {
                if ( monthDiff(lastDate, inDate) > 0 )
                    output += "<div role=\"subheader\">\n<span role=\"cell\">" + monthNames[inDate.getMonth()] + "</span>\n</div>";
                    
                sid = data[key].status;
                output += ("\n<div class=\"mainRow\" role=\"row\">\n" + 
                "<input  id=\"row-" + data[key].id + "\" name=\"#\" type=\"checkbox\" />\n" +
                "<div class=\"expandable\" role=\"cell\">\n<div role=\"row\">" + data[key].message + "</div>\n</div>\n" +
                "<span role=\"cell\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click para ver el cliente\" class='clickable' onClick=\"showCard(" + data[key].id + ")\"  role=\"cell\" data-header=\"ID\" style='text-align: center;'><a  href=\"#\">" + data[key].id + "</a></span>" + 
                "<span role=\"cell\" data-header=\"Nombre\" >" + data[key].name + "</span>" + 
                "<span role=\"cell\" data-header=\"Pasaporte\"><span>" + data[key].passport + "</span></span>" + 
                "<span role=\"cell\" data-header=\"Telefono\">" + data[key].phone + "</span>" + 
                "<span role=\"cell\" data-header=\"eMail\">" + data[key].email + "</span>" + 
                "<span role=\"cell\" data-header=\"Pais\"><span><span class='f16'><i class='flag "+ data[key].country.toLowerCase() +"'></i></span></span> " + C.countries[data[key].country] + "</span>" + 
                "<span role=\"cell\" data-header=\"Fecha\"><span>" + data[key].date + "</span></span>" + 
                "<span role=\"cell\" data-header=\"Empresa\">" + data[key].source + "</span>" + 
                "<span role=\"cell\" data-header=\"Informacion\"><label for=\"row-" + data[key].id + "\"></label>" +
                "<label onclick=\"deleteUser(" + data[key].id + ", '" + data[key].name + "')\" class='delete-user'></label></span>" + 
                "</div>");
                lastDate = inDate;
            }
           
            //console.log(data[key]);
        });
        
        return output;
    }
    
    function searchInput()
    {   
        defInput = document.getElementById("search-input");
        val = defInput.value;

        rg = document.getElementById("row-group");
        rg.innerHTML = populateTable(val);
    }

    function showCard(id)
    {
       var popupTemplate = 
    '    <div class="modal-dialog modal-xl">' +
    '        <div class="modal-content">' +
    '        <div class="modal-header">' +
    '            <h5 class="modal-title">Tarjeta de Cliente</h5>' +
    '            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
    '        </div>' +
    '        <ul class="nav nav-tabs" id="myTab" role="tablist">' +
    '            <li class="nav-item" role="presentation">' +
    '                 <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">Datos</button>' +
    '            </li>' +
    '            <li class="nav-item" role="presentation">' +
    '                <button class="nav-link" id="reserv-tab" data-bs-toggle="tab" data-bs-target="#reserv" type="button" role="tab" aria-controls="reserv" aria-selected="false">Reservas</button>' +
    '            </li>' +
    '            <li class="nav-item" role="presentation">' +
    '                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Detalles</button>' +
    '            </li>' +
    '        </ul>' +
    '       <div class="tab-content" id="myTabContent">' + 
    '        <div class="modal-body clientCard tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">'  +
    '                   <div class="form-group">'+
    '                       <label class="leftLabel col-form-label">Nombre:</label>'+
    '                       <label class="rightLabel">'+ data[id].prefix +' '+ data[id].name +'</label>'+
    '                   </div>'+
    '                   <div class="form-group">'+
    '                         <label class="leftLabel col-form-label">Pasaporte:</label>'+
    '                         <label class="rightLabel">'+ data[id].passport +'</label>'+
    '                        <label class="col-form-label">Telefono:</label>'+
    '                        <label class="rightLabel">'+ data[id].phone +'</label>'+
    '                   </div>'+
    '                   <div class="form-group">'+
    '                       <label class="leftLabel col-form-label">eMail:</label>'+
    '                       <label class="rightLabel">'+ data[id].email +'</label>'+
    '                          <label class="col-form-label">Empresa:</label>'+
    '                           <label class="rightLabel">'+ data[id].source +'</label>'+
    '                   </div>'+
    '                   <div class="form-group">'+
    '                       <label class="leftLabel col-form-label">Pais:</label>'+
    '                       <label class="rightLabel"><span><span class="f16"><i class="flag '+ data[id].country.toLowerCase() +'"></i></span></span> ' + C.countries[data[id].country] +'</label>'+
    '                   </div>'+
    '                       <div class="form-group">'+
    '                           <label class="leftLabel col-form-label">Agregado:</label>'+
    '                           <label class="rightLabel">'+ data[id].date +'</label>'+
    '                       </div>'+
    '                   <hr>'+
    '                   <div class="form-group" style="font-size: 10px;">'+
    '                       <label style="color: red;" class="col-form-label">Ultimo Accesso:</label>'+
    '                       <label class="rightLabel">'+ data[id].lastTouch +'</label>'+
    '                   </div>'+
    '        </div>' +
    '       <div class="modal-body tab-pane fade" id="reserv" role="tabpanel" aria-labelledby="reserv-tab">'+
    '       <div id="reservation-body" class="reservation"></div></div>' +
    '       <div class="modal-body tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">Detalles</div>' +
    '       </div>' +
    '        <div class="modal-footer">' +
    '            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' + 
    '            <!--<button type="button" class="btn btn-primary">Save changes</button>-->'+
    '        </div>' +
    '        </div>' +
    '    </div>' +
    '';
        actModal = document.getElementById('newModal');
        actModal.innerHTML = popupTemplate;
        var newModal = new bootstrap.Modal(actModal)
        actualClientId = id;
        newModal.show(); 
    }

    countryPicker = document.getElementById("countrypicker");
    populateCountry(countryPicker);

    function voucher(id)
    {
        window.open("voucher.php?id=" + id, '_blank').focus();
    }

    function addReservation()
    {
       
        var mres_data = [];
        mres_data['main_client'] = document.getElementById("mres_client_id").value;
        mres_data['main_client_name'] = document.getElementById("mres_client_name").value;
        mres_data['additional_clients'] = document.getElementById("mres_additional_clients").value;
        mres_data['type'] = document.getElementById("mres_type").value;
        mres_data['details'] = document.getElementById("mres_details").value;
        mres_data['inDate'] = document.getElementById("mres_inDate").value;
        mres_data['outDate'] = document.getElementById("mres_outDate").value;
        mres_data['servicePartner'] = document.getElementById("mres_servicePartner").value;
        mres_data['observations'] = document.getElementById("mres_observations").value;
        mres_data['reservation_number'] = document.getElementById("mres_confNumber").value;


        $.ajax('/?agregar_reserva', {
            type: 'POST',  // http method
            data: { 
            main_client: mres_data['main_client'],
            main_client_name: mres_data['main_client_name'],
            additional_clients: mres_data['additional_clients'],
            type: mres_data['type'],
            details: mres_data['details'],
            inDate: mres_data['inDate'],
            outDate: mres_data['outDate'],
            servicePartner: mres_data['servicePartner'],
            observations: mres_data['observations'],
            reservation_number: mres_data['reservation_number']
             },  // data to submit
            success: function (data, status, xhr) {
                $('#addReservation').modal('hide');
                $('#newModal').modal('show');
              
                $("#toast-body").html("Se ha agregado la reserva correctamente");
                $("#myToast").toast("show");
            },
            error: function (jqXhr, textStatus, errorMessage) {
                    $('p').append('Error' + errorMessage);
            }
        });
    }

    var myModalEl = document.getElementById('newModal');
    myModalEl.addEventListener('show.bs.modal', function (event) {
        $.ajax({
            url: "core/integrators/reservations.php?client=" + actualClientId,
            cache: false
          })
            .done(function( result ) {
               console.log("Retrieving data for client" + actualClientId);
               insertHTML("reservation-body", result);
            });
    })

function delRes(id, clientID, exit)
  {
    
    confVar = confirm("Esta seguro de eliminar la reserva con ID: " + id);

    if (confVar == true)
    {
        $.ajax({
                url: "?agregar_reserva&delete=" + id,
                cache: false
            })
                .done(function( html ) {
                $.ajax({
                    url: "core/integrators/reservations.php?client=" + clientID,
                    cache: false
                })
                    .done(function( result ) {
                    insertHTML("reservation-body", result);

                    $("#toast-body").html("Se ha eliminado la reserva correctamente");
                    $("#myToast").toast("show");

                    if (exit == true)
                        window.location = "/?reservas";
                    });
                });

        
        console.log("Deleting data \"" + id + "\" from client \"" + clientID + "\"");
    }   
  }

function insertHTML(elem, content)
{
    $("#" + elem).html(content);
    /*item = document.getElementById(elem);
    item.innerHTML = content;*/
}

function showAddReserv()
{
    item = document.getElementById("mres_client_name");
    item.value = data[actualClientId].name;

    item = document.getElementById("mres_client_id");
    item.value = actualClientId;
}


