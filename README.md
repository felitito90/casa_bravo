# Casa Bravo
Aplicación Casa-Bravo

Instalación
-----------

Para instalar se requiere clonar el proyecto.

Al terminar de clonar el proyecto se debe de instalar el composer asset plugin que permite administrar dependencias de paquetes bower y npm a través de Composer. Sólo necesitas ejecutar este comando una vez; esto se hace con el comando `composer global require "fxp/composer-asset-plugin:^1.4.1"`

Después se deben descargar las dependencias desde la consola con el comando `composer install`

Configuración
-------------

### Base de datos

- Crear una base de datos local

### Valores locales

- Crear una copia del archivo `config/example-web-local.php` y llamar `config/web-local.php` para editar los valores de configuración locales
```
cp example-web-local.php web-local.php
```
- Con los valores de configuración de la base de datos correr los migrates con el comando:
```
./yii migrate
```
- Verificar y editar otros archivos del directorio `config/` para personalizar los valores requeridos

### SuperUser

- Crear el usuario administrador desde la consola y confirmarlo, este es el usuario que tiene acceso al módulo de *Usuarios* y al *RBAC*.
```
./yii user/create correo@correo.com SuperAdmin *AdM1n$
./yii user/confirm correo@correo.com
```

**NOTA:** Debido a las configuraciones del RBAC se dicta que obligatoriamente el usuario administrador del sistema deberá de ser llamado 'SuperAdmin', de lo contrario el usuario que se creó no podrá ingresar a todos los módulos del sistema.

Diseño de vistas
----------------

### FlashAlert

Ya está configurada en el layout el widget FlashAlert del tema para renderear los alerts con sólo definir la variable de sesión apropiada.

```php
Yii::$app->session->setFlash('error', 'Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.');
Yii::$app->session->setFlash('success', 'Success alert preview. This alert is dismissable.');
Yii::$app->session->setFlash('warning', 'Warning alert preview. This alert is dismissable.');
Yii::$app->session->setFlash('info', 'Info alert preview. This alert is dismissable.');
```

RBAC
----
Primero y antes que nada hay que leer y entender [Autenticación](https://www.yiiframework.com/doc/guide/2.0/es/security-authentication) y [Autorización](https://www.yiiframework.com/doc/guide/2.0/es/security-authorization) especialmente [Control de Acceso Basado en Roles (RBAC)](https://www.yiiframework.com/doc/guide/2.0/es/security-authorization#rbac) de la guía de Yii2.

#### Construir los datos de Autorización
**TODO:** 
Construir los datos de autorización implica las siguientes tareas:

- Definir roles y permisos;
- Establecer relaciones entre roles y permisos;
- Definir reglas;
- Asociar reglas con roles y permisos;
- Asignar roles a usuarios.

Esta guía en [Yii 2.0 Cookbook](https://yii2-cookbook.readthedocs.io/security-rbac/) explica cómo implementar y este [video](https://www.youtube.com/watch?v=vLb8YATO-HU) puede ser de buena referencia.

Referencias
-----------

- Se utiliza la extensión [2amigos/yii2-usuario](https://github.com/2amigos/yii2-usuario)
- Guía de [2amigos/yii2-usuario](http://yii2-usuario.readthedocs.io/en/latest/)
- Yii2 Lesson - 18 RBAC [part 1](https://www.youtube.com/watch?v=eFOIUeU-Y74) & [part 2](https://www.youtube.com/watch?v=G9-tBshv3Uo)
- [Yii2 Framework - RBAC Tutorial with Example | Part 1](https://www.youtube.com/watch?v=7-jo8LKCnUk)
- [Yii2 Framework RBAC Tutorial with Example | Part2 | Rule](https://www.youtube.com/watch?v=rzoQoB9N3v8)


## DYNAMIC FORM - ARREGLOS

**TODO:** Arreglar dynamic form utilizando vue-js

Éstos cambios se realizan en la carpeta de _'assets'_ correspondiente
En dado caso de tener un error en el Dynamic, basarse en éste artículo para poder arreglarlo
https://github.com/wbraganca/yii2-dynamicform/issues/104

Error "toclone.clone is not a function":

```
    $toclone = $(widgetOptions.template);
```

Corrije el error de ActiveFormData
```JS
if (typeof yiiActiveFormData !== "undefined" && typeof yiiActiveFormData.settings !== "undefined" ) {
    $template.find('.' + yiiActiveFormData.settings.errorCssClass).removeClass(yiiActiveFormData.settings.errorCssClass);
    if(typeof yiiActiveFormData.settings.errorCssClass !== "undefined" && yiiActiveFormData.settings.errorCssClass.length > 0) {
    $template.find('.' + yiiActiveFormData.settings.successCssClass).removeClass(yiiActiveFormData.settings.successCssClass);
        $template.find('.' + yiiActiveFormData.settings.errorCssClass).removeClass(yiiActiveFormData.settings.errorCssClass);
    }

    if(typeof yiiActiveFormData.settings.successCssClass !== "undefined" && yiiActiveFormData.settings.successCssClass.length > 0) {
        $template.find('.' + yiiActiveFormData.settings.successCssClass).removeClass(yiiActiveFormData.settings.successCssClass);
    }
}
```

## Arreglando código (PSR2-3)

Podemos utilizar el plug-in phpcs:

```bash
phpcs -p --extensions=php,js --colors --ignore=*/vendor/*,*assets/*,*/runtime/*,*/tests/* ./
```

Y para arreglar el código:
```bash
phpcbf -p --extensions=php,js --colors --ignore=*/vendor/*,*assets/*,*/runtime/*,*/tests/* ./
```