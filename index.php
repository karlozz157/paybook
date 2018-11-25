<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <div id="email-container" class="col-md-6">
                <form id="email-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </form>
            </div>
            <div id="sync-widget-container" class="col-md-6" style="display: none;">
                <div id="sync_container" style="height: 800px;width: 600px;"></div> 
            </div>
        </div>
        <script type="text/javascript" src="prexto-paybook.js"></script>
        <script type="text/javascript">
            !function(w,d,s,id,r){
                var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";
                if(!d.getElementById(id)){
                    w[r]={};
                    w[r]=w[r]||function(){w[r].q=w[r].q||[].push(arguments)};
                    js=d.createElement(s);
                    js.id=id;
                    js.type = 'text/javascript';
                    js.src=p+"://www.paybook.com/sync/widget.js";
                    fjs.parentNode.insertBefore(js,fjs);
                }
            }(window,document,"script","sync-widget", "syncWidget");

            // configuracíón de widget
            const configPaybookWidget = (session, callback) => {
                syncWidget.options = {
                    token: session.token, 
                    baseDiv: "sync_container", 
                    theme: "light"
                };

                syncWidget.setCallback(callback);

                if (typeof syncWidget.setToken === "function") {
                    syncWidget.setToken(session.token);
                } 
            };

            // función para validar email
            const validateEmail = (email) => {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            };

            // Ocultamos el div del formulario y mostramos el div que widgte
            const showPaybookWidget = () => {
                $emailContainer      = document.getElementById('email-container');
                $syncWidgetContainer = document.getElementById('sync-widget-container');

                $emailContainer.style.display      = 'none';
                $syncWidgetContainer.style.display = 'block';
            };

            // Esperamos a que la página este completamente cargada
            document.addEventListener('DOMContentLoaded', function() {
                // obtenemos el formulario 
                $form = document.getElementById('email-form');

                // Asignamos un evento al formulario
                $form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Obtenemos el elemento email
                    $emailInput = document.getElementById('email');

                    // Asignamos a una variable el valor del elemento email
                    let email = $emailInput.value.trim();

                    // Válidamos el email
                    if (!validateEmail(email)) {
                        return alert('El email no es válido!');
                    }

                    try { 
                        // creamos el usuario
                        let user = await User.create(email);

                        // creamos la sessión
                        let session = await Session.create(user.user.name);

                        // llamamos la configuración de paybook,
                        // asignamos un callback para manejar la accion después que el usuario introdujo las credenciales
                        configPaybookWidget(session.session, (response) => {
                            const status = response.response,
                                  wasSuccesful = status >= 200 && status <= 204;

                            // si fue exitosa la conexión
                            if (wasSuccesful) {
                                // guardar la credencial en base de datos

                                const user = session.session.user.name,
                                      idCredential = response.credentials.id_credential;

                                // vemos las transacciones
                                Transaction.find(user, idCredential)
                                    .then((response) => {
                                        console.log(response);
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    });
                            } else {
                                // Manejar el error de acuerdo a nuestra lógica 
                                console.log('Hubo un error :(');
                            }
                        });

                        // Mostramos el widget de paybook
                        showPaybookWidget();
                    } catch (err) {
                        // mostramos el error por la consola
                        console.log(err);
                    }
                });
            });
        </script>
    </body>
</html>
