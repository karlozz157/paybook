
================ Usuarios ================


GET: /api.php/users

Descripción: Obtiene todos los usuarios 
__________________________________________


GET: /api.php/users/{name}

Descripción: Obtiene un usuario en particular

Parámetros: 
    name: nombre del usuario a obtener
__________________________________________


POST: /api.php/users
Body:
{
    "name": "{name}"    
}

Descripción: Crea un usuario

Body: 
    name: nombre del usuario a crear

__________________________________________


DELETE: /api.php/users/{name}

Descripción: Elimina un usuario

Parámetros: 
    name: nombre del usuario a eliminar

================ Sesiones ================


POST: /api.php/session

Body:
{
    "name": "{name}"
}

Descripción: Creamos una sesión asociandola a un usuario:

Body:
    name: nombre del usuario 

================ Credenciales ================


Ojo: las credenciales se crean a través del widget


GET: /api.php/credentials/{name}

Descripción: Obtener todas las credenciales del usuario

Parámetros:
    name: nombre del usuario
__________________________________________

GET: /api.php/credentials/{name}/{id_credential} 

Descripción: Obtener una credencial del usuario

Parámetros: 
    name: nombre del usuario 
    id_credential: id de la credencial

================ Transacciones ================


GET: /api.php/transactions/{name}/{id_credential}

Descripción: Obtener las transacciones de un usuario

Parámetros: 
    name: nombre del usuario 
    id_credential: id de la credencial


===============================================

// Ejemplos en código

En este caso utilizamos previamente el widget de paybook para crear la credencial del usuario

si queremos obtener sus transacciones

<script type="text/javascript" src="prexto-paybook.js"></script>
<script>
    (async function() {
        // obtenemos el usuario ya registrado
        let user = await User.findOne('{user}');

        // obtenemos la credencial que se creó a traves del widget
        let santanderCredential = await Credential.findOne(user.user.name, '{id_credential}');

        // descargamos las transacciones
        let santanderTransactions = await Transaction.find(user.user.name, santanderCredential.credential.id_credential);

        // mostramos las credenciales
        console.log(santanderTransactions);
    }) ();
</script>
