TODO LIST

- Esperar por respuestas: tenemos una lista project > countries.
Si no, podemos asumir que las sedes del proyecto, mencionadas en el PDF y en el mapa de keep.eu son los paises asociados.
- Cuando tengamos esa lista ,  exportarla, y aplicarla a projects-and-programmes.json, para la seecion projects (q cada project tenga un campo "countries", con los codigos del pais/es involucrados.)
- Al seleccionar un pais, hay q mostrar entonces los projects del pais.

- desarrollar un metodo para publicar en Tesim. Crear nuevo env test para simular.
     HE CREADO YA `/Sites/httrack-3.49.2/tesim-enicbc.eu`
     El problema actual es q no carga los json pq estan en una ruta diferente.
     usar algo asi como   "build:staging": "REACT_APP_ENV=staging npm run build",
     con un .env.staging creando el ROOT URL
- BUG; cuando se deselecta una region, los dropdowns no se limpian
- desistir de bootstrap: conflicto con actual web de tesim.
- Creat botones para limpiar los drodowns.
- meter poster img acf interreg snippets, usando la lista de urls q tengo en un txt,
     y asignar en interreg. Las imgs ya estan en Tesim WP.
- HAcer el mapa zoomeable (ver mapplic)
- Tal vez crear el mapa de countries tb.
- Cambiar colores del map
- Arreglar el estilo de todo.
- Hacerlo responsive, q se recalcule el mapa en resize.
- Anhadir barra de estado abajo explicando las acciones a tomar
- Practicar la inclusion en la web de Tesim
