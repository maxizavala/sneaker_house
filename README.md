# sneaker_house
Da Vinci -  Produccion Web => php + bootstrap + ajax 

### INDEX.PHP. 
    .Muestra carrousel. 
    .Muestra categorias que filtran productos (se modifican desde admin). Se conecta a la BD. 
    .Muestra productos: Muestra el listado de productos. Se conecta a la BD. 
    .Agrega/Eliminar productos a favoritos (Se conecta a la BD)

### PRODUCTO.PHP. 
    .Muestra el detalle del producto. Se conecta a la BD. 
    .Agrega productos al carrito (Se conecta a la BD). 
    .Agrega/Elimina productos a favoritos (Se conecta a la BD)

### EDIT_PRODUCTO.PHP. 
    .ABM de productos. Se conecta a la BD. 
    .Sube imagenes al servidor. 

### CONTACTO.PHP. 
    .Muestra detalle de contacto (los datos los toma desde la BD). 
    .Formulario de contacto. (envia los contactos generados por email al admnistrador). 

### REGISTRO.PHP. 
    .Crea nuevos usuarios (Se conecta a la BD). 

### ADMIN.PHP. 
    .Modifica datos del header, footer y email del formulario de contacto. 
    .ABM de Categorias. 

### CARRITO.PHP. 
    .Muestra productos en carrito (se conecta a la BD). 
    .Confirma/Cancela la compra (Se conecta a la BD). 

### HEADER.PHP. (script unico). 
    .Secciones del sitio. 
    .Subtitulo modificable (se conecta a la BD). 
    .login/logout (se conecta a la BD). 
    .Muestra favoritos (Se conecta a la BD). 

### FOOTER.PHP. (script unico). 
    .links a redes sociales que se modifican desde admin (Se conecta a BD). 

### USUARIOS
ADMIN. 
usuario: zeta. 
pass: dv01. 
    - ABM de productos. 
    - ABM categorias. 
    - Pueden modificar aspectos del sitio.
    - Pueden agregar productos a favoritos. 
    - Pueden comprar. 

COMUN. 
usuario: pepe. 
pass: dv01. 
    - Pueden agregar productos a favoritos. 
    - Pueden comprar.

