
function goTo(URI)
{
    window.location = URI;
}

function deleteUser(id, name)
{
    confVar = confirm("Esta seguro de eliminar al cliente \"" + name + "\" con ID: " + id);

    if ( confVar )
    {
        window.location = "/?del_client=" + id;
    }
}

function countClients()
{
    item = document.getElementById("mres_additional_clients");
    itemTotal = document.getElementById("mres_total_clients");
    itemTotal.value = parseInt(item.value) + 1;
}

function voucher(id)
    {
        window.open("voucher.php?id=" + id, '_blank').focus();
    }


function insertHTML(elem, content)
{
    $("#" + elem).html(content);
    /*item = document.getElementById(elem);
    item.innerHTML = content;*/
}

function showAddReserv(clientID, clientName)
{
    item = document.getElementById("mres_client_name");
    item.value = clientName;

    item = document.getElementById("mres_client_id");
    item.value = clientID;
}
    
function delRes(id, clientID, exit)
  {
    
    confVar = confirm("Esta seguro de eliminar la reserva con ID: " + id);

    if (confVar == true)
    {
        $.ajax({
                url: "core/api/main.php?vouchers&delete&id=" + id,
                cache: false
            })
                .done(function( html ) {
                $.ajax({
                    url: "core/api/main.php?vouchers&client=" + clientID,
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

  function populateCountry(select)
    {
        Object.keys(C.countries).forEach(key => {

                var opt = document.createElement('option');
                opt.value = key;
                opt.innerHTML =C.countries[key];
                select.appendChild(opt);
        });
    }