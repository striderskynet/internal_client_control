const voucher_default_row = $("#data-default");
var voucher_main_table = $("#main-table-body");

// Populate the main Table on Load
$.get("./api/?vouchers&list", function (data) {
  populate_data(
    JSON.parse(data),
    1,
    voucher_main_table,
    voucher_default_row,
    "voucher"
  );
});

// Execute when "ADD Voucher" button is clicked
$("#button_voucher_add").click(function () {
  console.log("Mostrando modal de Reserva Nueva");

               

  // Show "ADD Voucher" modal
  add_voucher_modal.show();
});

// Execute every time there is a search in the search bar
$("#main_search").prop("disabled", true);
$("#main_search").prop(
  "title",
  "Deshabilitada la busqueda hasta nueva version"
);

// Execute when "DEL Voucher" button is pressed
function button_voucher_del(button) {
  //$("#button_user_del").click(function(){
  clientModalShow = false;

  // Getting voucherID from DataSet
  var voucher_id = button.dataset.userId.replace("v", "");
  let url_del_voucher = "./api/?vouchers&delete&id=" + voucher_id;

  // Executing the API for VOUCHER DELETION
  $.get(url_del_voucher, function (data) {
    show_alert("danger", `Se ha eliminado el Voucher con ID: ${voucher_id},`, 5);

    // Populate the main Table
    $.get("./api/?vouchers&list", function (data) {
      populate_data(
        JSON.parse(data),
        1,
        voucher_main_table,
        voucher_default_row,
        "voucher"
      );
    });
  });

  // Wait TIME for reloading
  setTimeout(function () {
    clientModalShow = true;
  }, 200);
}

function button_voucher_print(element) {
  voucher_id = element.dataset.voucherId;
  show_alert("primary", `Imprimiendo voucher ID ${voucher_id}`, 5);

  window.open("./api/voucher.php?id=" + voucher_id, "_blank").focus();
}
