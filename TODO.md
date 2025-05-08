- Add clours corresponding to the new slugs --tm-governance-2025 etc..
- Add those the colours into App.scss




===
A New version f the interactive map will be released,
with:
- ✅ The search filter will be improved, adding the
possibility of one additional consultation by
country/thematic cluster, once the country is selected
20 hours 1300 EUR
===
- ✅ Adding a new filter to choose the results of the
period ENI-CBC, or Interreg Next, or both
- All new posters will be tagged for consultation in
the interactive posters map
- The cluster “Governance” will be included to the
drop-down list, with 2 subclusters: Public
administration and Citizen participation
===
The new version of the map will need to track the
visits to the posters, and the clicks on the links below
every poster, using Google Analytics.
===
Restructuring of the subclusters in the interactive map

The clusters:
- “People-to-people cooperation” will be enriched
with one more sub-cluster
“Tourism”
- “Culture” and “Education” will become separate
sub-clusters
- The sub-cluster “Energy efficiency” will be
renamed into “Energy”
- The cluster “Cross-border infrastructure” will be
revised as having only two sub-clusters:
“Border management, mobility and safety”
“Connectivity”
===
Extra zoom functionality
Add an extra zoom to the map depending on the
selected period.


GRAFFICA mejorra con gran imagen de fondo!!
DONE: San Marino OUT! - but it can be still in the cache!
DONE Non sono ordine alfabetico quando cliccki su un programma. !!! 
dONE: Accettiamo logo tesim. SI
Vedere
Spiegare come arrivare qui dall'exhibition.
DONE: Activar thumbnail in ACF

Mandar un mail respondiendo y cosa por cosa.
Explicar que arregle lode los ':'
DONE: Solucionar cuando el titulo es demasiado largo: ej Russia : Improving children and adults ...
          Explicar

) Mobile view , tablet view


Muchos cambios hechos, en la page-template, y en todo inc/ . Actualizar y ya. 

FALTA
) Mobile view 
13) some thumbnails of posters are broken.
14) Make it look very good in a big screen. Add link to the virtual tour if there is space below and center vertically in the screen. 
15) The ':' after every button, remove. 


4) DONE: Nella Virutal Tour - Metter link alla mappa. Apre in nuova finestra
     4 Ottrobre - Va i a schermo pieno. - Virutal e Livello 3. Un botton in ogni room.
          - "Go to projects map."

WAITING for: I testi scritti mi devono venir dati (sui panelli, sopratutto il testo iniziale. ). 

HECHO: 

1) DONE: Homepage- solo virtual tour.
2) DONE: 4 bottoni sotto - Bug.
3) DONE: Portogalo e Malta - bug (the map breaks), San Marino tolto.
     Daniela mi deve dire il testo quando non ci sono progetti.

5) DONE Russian Fed , son 7 , non 8 programmes
DONE Moldova, sono 2 non 1.
Altri da spottare da loro... 
6) DONE: Progetti in ordnie alfqbetico
7) DONE: Usare l'acronimo + titolo communicazione - se non c'e' acronimo: name of - titolo di communicazione
mouse sopra: titolo di communicazione.
8) DONE: Dropdown - titoli di cluster : piu grosso. 
9) DONE: Regioni bordo Romania con Moldova devono essere dark blue:  coinvolti in programme.
10) DONE: Norway : colore diverso a tutto, parte selezionabile, ancora piu' diversa.
11) DONE: Levare la Virtual Tour. La mappa viene mostrata da sola.
     link per esplorare il virtual tour. 
12) DONE: Alien invasive plants. Va tolto.

Ho create il sito con il virtual tour e il terzo livello, fuori del sito.
     https://tesim-enicbc.eu/eni-cbc-projects-virtual-tour-and-interactive-map/
     - se mi vogliono dire una url piu semplice da condividere, avanti. 


DONE: I titoli dei posters, quali sono quelli giusti?
DONE: Le correzioni chieste da Carlos sono state fatte, tranne il dropdown
     - colori dei paesi




Ac
Tal vez ordenar los resultados de projects por thematic and subthematic
DONE: Crear project-single en tesim site, igual q el de interreg.eu
     Una vez hecho , actualizar los links de iframe
DONE: Select de projects, mostrar por grupos de thematic ordenados. 



TODO LIST

- Esperar por respuestas: tenemos una lista project > countries.: NO, la cree yo
Si no, podemos asumir que las sedes del proyecto, mencionadas en el PDF y en el mapa de keep.eu son los paises asociados.
- Cuando tengamos esa lista ,  exportarla, y aplicarla a projects-and-programmes.json, para la seecion projects (q cada project tenga un campo "countries", con los codigos del pais/es involucrados.)
- Al seleccionar un pais, hay q mostrar entonces los projects del pais.

- consegui crear una version de wp en local y una metodo para hacer deploy de react directamente en esa instalacion con `sh deploy-tesimwebsite.hs`
OBSOLETO de ANTES:  
     HABIA CREADO YA `/Sites/httrack-3.49.2/tesim-enicbc.eu`
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
- Cambiar colores del map: DONE
- Arreglar el estilo de todo: DONE
- Hacerlo responsive, q se recalcule el mapa en resize. - in progress
- Anhadir barra de estado abajo explicando las acciones a tomar
- DONE: Practicar la inclusion en la web de Tesim
