var login_modal = new bootstrap.Modal(document.getElementById('login-modal'));
login_modal.show();

$("#login-form").submit(function(e) {
    e.preventDefault();

    var form_login = $(this);

    var log_user = form_login[0].username_login.value;
    var log_pass = form_login[0].password_login.value;

    console.log("Login as \"" + log_user +"\" Pass: \"" + log_pass +"\"")

    $.ajax({
        method: "POST",
        url: "./api/?users&verify",
        // Passing all the variables
        data: { 
            username: log_user,
            password: log_pass
        }
    }).done(function( msg ) {

        console.log(msg);
        if ( msg.length > 3)
        {
            msg_res = JSON.parse(msg);

            console.dir(log_user);

            $.ajax({
                method: "POST",
                url: "./api/?users&login",
                // Passing all the variables
                data: { 
                    user: log_user,
                    role: msg_res.role
                }}).done(function( msg_login ) {
                    console.log(msg_login);
                });


               document.location = "./";

            //show_alert("success", "Se ha logueado correctamente");
        } else {
            show_alert("danger", "Usuario o Contrasena incorrecto");
        }
    });

});
