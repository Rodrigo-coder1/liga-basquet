\# Práctica: Gestión de Liga de Básquetbol



\## 1. Descripción del proyecto



El proyecto consiste en una aplicación web para administrar una liga de básquetbol. Su objetivo es facilitar el registro de equipos y jugadores, la programación de partidos, el almacenamiento de resultados y la consulta de estadísticas de la competición.



La aplicación está desarrollada con Laravel y PHP, utiliza MySQL como sistema de base de datos y emplea las vistas Blade y CSS para presentar la información. La interfaz cuenta con un diseño inspirado en el anime deportivo, con colores temáticos, animaciones y una distribución adaptable.



\## 2. Funcionalidades implementadas



\### Gestión de equipos



Permite registrar equipos con su nombre, ciudad y entrenador. También permite consultar el listado, editar información y eliminar registros.



\### Gestión de jugadores



Permite registrar jugadores, asociarlos a un equipo, consultar sus datos, modificarlos y eliminarlos. Se validan los campos para mantener la integridad de la información.



\### Gestión de partidos y resultados



Permite programar encuentros seleccionando un equipo local y uno visitante, definir la fecha y hora, y registrar los marcadores. Los partidos sin resultado completo aparecen como pendientes y los que tienen ambos marcadores registrados se identifican como finalizados.



\### Estadísticas y tabla de posiciones



La aplicación calcula los partidos jugados, las victorias, las derrotas, los empates y los puntos a favor y en contra. La tabla de posiciones se ordena por victorias y utiliza la diferencia de puntos y los puntos a favor como criterios adicionales.



\### Autenticación



El sistema permite registrar usuarios, iniciar sesión y cerrar sesión. Las rutas de gestión de la liga están protegidas mediante el sistema de autenticación de Laravel. Las contraseñas se guardan utilizando el mecanismo de hash de Laravel.



\## 3. Tecnologías utilizadas



\- PHP 8.2 y Laravel 12.

\- MySQL para almacenar los datos.

\- Blade para construir las vistas.

\- CSS para el diseño y las animaciones.

\- Git para el control de versiones.

\- GitHub para alojar el repositorio y gestionar los Pull Requests.

\- XAMPP como entorno local de desarrollo.



\## 4. Metodología de trabajo



El desarrollo se organizó mediante ramas de Git para separar las funcionalidades. Se utilizaron ramas específicas para equipos, jugadores, partidos, estadísticas y autenticación. Los cambios se guardaron mediante commits descriptivos y se publicaron en GitHub mediante Pull Requests hacia la rama `desarrollo`.



Este procedimiento permite mantener un historial de trabajo, revisar los cambios e integrar cada módulo de forma organizada.



\## 5. Conclusión



La aplicación reúne las funciones principales para administrar una liga de básquetbol: equipos, jugadores, partidos, resultados, estadísticas y autenticación. El uso de Laravel, MySQL y Git facilita el mantenimiento del sistema y permite continuar ampliándolo en el futuro.



