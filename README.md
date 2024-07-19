# Calendario para Estudiantes con Registro de Usuarios

Este proyecto es una aplicación web de calendario personal donde los usuarios pueden registrarse, iniciar sesión y gestionar sus eventos. 
La aplicación permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en los eventos del calendario y cuenta con una funcionalidad 
de alarma que aún está en desarrollo.

## Características

- Registro de usuarios con una pregunta de seguridad para recuperación de contraseña.
- Cada usuario tiene su propia tabla única para almacenar la información de su calendario.
- Funcionalidad CRUD para los eventos del calendario.
- Opción de alarma (en desarrollo).

## Requisitos

- Servidor web con soporte para PHP y MySQL.
- Base de datos MySQL.

## Instalación

1. Clona este repositorio en tu servidor web:

    ```bash
    https://github.com/Riodinie/Calendario_Academico_Darenix.git
    ```

2. Crea una base de datos en MySQL y ejecuta el siguiente código SQL para crear la tabla de usuarios:

    ```sql
    CREATE TABLE users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(10),
        email VARCHAR(50),
        password VARCHAR(9),
        pregunta VARCHAR(20)
    );
    ```

3. Configura tu servidor web para que apunte a la carpeta del proyecto.

4. Asegúrate de tener configurado tu archivo de conexión a la base de datos con las credenciales correctas.

## Uso

1. **Registrar una Cuenta:**
   - Los usuarios pueden registrarse proporcionando su nombre, correo electrónico, contraseña y una pregunta de seguridad (color favorito) para recuperación de contraseña.
   - Al registrarse, se crea una tabla única para cada usuario en la base de datos que almacenará la información de su calendario.

2. **Iniciar Sesión:**
   - Los usuarios pueden iniciar sesión con su correo electrónico y contraseña.

3. **Gestión de Eventos:**
   - Los usuarios pueden agregar, ver, actualizar y eliminar eventos en su calendario personal.

4. **Recuperación de Contraseña:**
   - Si un usuario olvida su contraseña, puede recuperarla respondiendo a la pregunta de seguridad proporcionada durante el registro.

5. **Alarma:**
   - La funcionalidad de alarma permite a los usuarios configurar alarmas para sus eventos, aunque actualmente puede tener algunos fallos.

## Contribuir

¡Las contribuciones son bienvenidas!

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3. Realiza tus cambios y haz commit (`git commit -am 'Agregar nueva característica'`).
4. Haz push a la rama (`git push origin feature/nueva-caracteristica`).
5. Abre un Pull Request.

