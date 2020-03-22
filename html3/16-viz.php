<?php if ( file_exists("../booktop.php") ) {
  require_once "../booktop.php";
  ob_start();
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
  <meta charset="utf-8" />
  <meta name="generator" content="pandoc" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>-</title>
  <style>
    code{white-space: pre-wrap;}
    span.smallcaps{font-variant: small-caps;}
    span.underline{text-decoration: underline;}
    div.column{display: inline-block; vertical-align: top; width: 50%;}
    div.hanging-indent{margin-left: 1.5em; text-indent: -1.5em;}
    ul.task-list{list-style: none;}
  </style>
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
<h1 id="visualización-de-datos">Visualización de datos</h1>
<p>Hasta el momento, hemos estado aprendiendo el lenguaje de Python y hemos aprendido cómo usar Python, la red y las bases de datos para manipular datos.</p>
<p>En este capítulo, echaremos un vistazo a tres aplicaciones completas que usan todos estos elementos para gestionar y visualizar datos. Puedes usar estas aplicaciones como código de ejemplo que sirva de punto de partida para resolver problemas del mundo real.</p>
<p>Cada aplicación es un archivo ZIP que puedes descargar, extraer en tu equipo y ejecutar.</p>
<h2 id="construcción-de-un-mapa-de-google-a-partir-de-datos-geocodificados">Construcción de un mapa de Google a partir de datos geocodificados</h2>
<p> </p>
<p>En este proyecto usaremos la API de geocodificación de Google para limpiar varias ubicaciones geográficas de nombres de universidades introducidas por los usuarios, y luego colocaremos los datos en un mapa de Google.</p>
<figure>
<img src="../images/google-map.png" alt="" /><figcaption>A Google Map</figcaption>
</figure>
<p>Para comenzar, descarga la aplicación desde:</p>
<p><a href="http://www.py4e.com/code3/geodata.zip">www.py4e.com/code3/geodata.zip</a></p>
<p>El primer problema a resolver es que la API libre de geocodificación de Google tiene como límite de uso un cierto número de peticiones diarias. Si tienes un montón de datos, necesitarás detener y reanudar el proceso de búsqueda varias veces. Por tanto, dividiremos el problema en dos fases.</p>
<p></p>
<p>En la primera fase, tomaremos como entrada los datos “de reconocimiento” del archivo <em>where.data</em> y los leeremos una línea a la vez, recuperando la información de geocodificación desde Google y almacenándola en una base de datos <em>geodata.sqlite</em>. Antes de usar la API de geocodificación para cada ubicación introducida por el usuario, verificaremos si ya tenemos los datos para esa entrada concreta. La base de datos funcionará así como una “caché” local de datos de geocodificación, para asegurarnos de que nunca solicitamos a Google los mismos datos dos veces.</p>
<p>Puedes reiniciar el proceso en cualquier momento eliminando el archivo <em>geodata.sqlite</em>.</p>
<p>Ejecuta el programa <em>geoload.py</em>. Este programa leerá las líneas de entrada desde <em>where.data</em> y para cada línea verificará si ya está en la base de datos. Si no disponemos de datos para esa ubicación, llamará a la API de geocodificación para recuperarlos y los almacenará en la base de datos.</p>
<p>Aquí tenemos un ejemplo de ejecución cuando ya disponemos de información almacenada en la base de datos:</p>
<pre><code>Found in database  Northeastern University
Found in database  University of Hong Kong, ...
Found in database  Technion
Found in database  Viswakarma Institute, Pune, India
Found in database  UMD
Found in database  Tufts University

Resolving Monash University
Retrieving http://maps.googleapis.com/maps/api/
    geocode/json?address=Monash+University
Retrieved 2063 characters {    &quot;results&quot; : [
{&#39;status&#39;: &#39;OK&#39;, &#39;results&#39;: ... }

Resolving Kokshetau Institute of Economics and Management
Retrieving http://maps.googleapis.com/maps/api/
    geocode/json?address=Kokshetau+Inst ...
Retrieved 1749 characters {    &quot;results&quot; : [
{&#39;status&#39;: &#39;OK&#39;, &#39;results&#39;: ... }
...</code></pre>
<p>Las primeras cinco ubicaciones ya están en la base de datos y por eso las omitimos. El programa explora hasta que encuentra ubicaciones nuevas y entonces comienza a recuperarlas.</p>
<p>El programa <em>geoload.py</em> puede ser detenido en cualquier momento, y dispone de un contador que puedes usar para limitar el número de llamadas a la API de geolocalización en cada ejecución. Dado que el archivo <em>where.data</em> solo tiene unos pocos cientos de elementos, no deberías llegar al límite diario de usos, pero si tienes más datos pueden ser necesarias varias ejecuciones del programa durante varios días para tener todos los datos de entrada geolocalizados en nuestra base de datos.</p>
<p>Una vez que tienes parte de los datos cargados en <em>geodata.sqlite</em>, se pueden visualizar usando el programa <em>geodump.py</em>. Este programa lee la base de datos y escribe el arhivo <em>where.js</em> con la ubicación, latitud y longitud en forma de código ejecutable de JavaScript.</p>
<p>Una ejecución del programa <em>geodump.py</em> sería la siguiente:</p>
<pre><code>Northeastern University, ... Boston, MA 02115, USA 42.3396998 -71.08975
Bradley University, 1501 ... Peoria, IL 61625, USA 40.6963857 -89.6160811
...
Technion, Viazman 87, Kesalsaba, 32000, Israel 32.7775 35.0216667
Monash University Clayton ... VIC 3800, Australia -37.9152113 145.134682
Kokshetau, Kazakhstan 53.2833333 69.3833333
...
12 records written to where.js
Open where.html to view the data in a browser</code></pre>
<p>El archivo <em>where.html</em> consiste en HTML y JavaScript para mostrar un mapa de Google. Lee los datos más actuales de <em>where.js</em> para obtener los datos que se mostrarán. He aquí el formato del archivo <em>where.js</em>:</p>
<pre class="js"><code>myData = [
[42.3396998,-71.08975, &#39;Northeastern Uni ... Boston, MA 02115&#39;],
[40.6963857,-89.6160811, &#39;Bradley University, ... Peoria, IL 61625, USA&#39;],
[32.7775,35.0216667, &#39;Technion, Viazman 87, Kesalsaba, 32000, Israel&#39;],
   ...
];</code></pre>
<p>Se trata de una variable JavaScript que contiene una lista de listas. La sintaxis de las listas de constantes en JavaScript es muy similar a las de Python, de modo que debería resultarte familiar.</p>
<p>Simplemente abre <em>where.html</em> en un navegador para ver las ubicaciones. Puedes mantener el ratón sobre cada marca del mapa para ver la ubicación que la API de geocodificación ha devuelto para la entrada que el usuario introdujo. Si no puedes ver ningún dato cuando abras el archivo <em>where.html</em>, puede que debas revisar JavaScript o la consola de desarrollador de tu navegador.</p>
<h2 id="visualización-de-redes-e-interconexiones">Visualización de redes e interconexiones</h2>
<p>  </p>
<p>En esta aplicación, realizaremos algunas de las funciones de un motor de búsqueda. Primero rastrearemos una pequeña parte de la web y ejecutaremos una versión simplificada del algoritmo de clasificación que usa Google para determinar qué páginas se encuentran más conectadas. Luego, visualizaremos la clasificación de las páginas y conectividad de nuestro pequeño rincón de la web. Usaremos la librería de visualización de JavaScript D3 <a href="http://d3js.org/" class="uri">http://d3js.org/</a> para generar la imagen de salida.</p>
<p>Puedes descargar y extraer esta aplicación desde:</p>
<p><a href="http://www.py4e.com/code3/pagerank.zip">www.py4e.com/code3/pagerank.zip</a></p>
<figure>
<img src="../images/pagerank.png" alt="" /><figcaption>A Page Ranking</figcaption>
</figure>
<p>El primer programa (<em>spider.py</em>) rastrea un sitio web y envía una serie de páginas a la base de datos (<em>spider.sqlite</em>), guardando los enlaces entre páginas. Puedes reiniciar el proceso en cualquier momento eliminando el fichero <em>spider.sqlite</em> y ejecutando de nuevo <em>spider.py</em>.</p>
<pre><code>Enter web url or enter: http://www.dr-chuck.com/
[&#39;http://www.dr-chuck.com&#39;]
How many pages:2
1 http://www.dr-chuck.com/ 12
2 http://www.dr-chuck.com/csev-blog/ 57
How many pages:</code></pre>
<p>En esta ejecución de ejemplo, le pedimos que rastree un sitio web y que recupere dos páginas. Si reinicias el programa y le pides que rastree más páginas, no volverá a revisar aquellas que ya estén en la base de datos. En cada reinicio elegirá una página al azar no rastreada aún y comenzará allí. De modo que cada ejecución sucesiva de <em>spider.py</em> irá añadiendo páginas nuevas.</p>
<pre><code>Enter web url or enter: http://www.dr-chuck.com/
[&#39;http://www.dr-chuck.com&#39;]
How many pages:3
3 http://www.dr-chuck.com/csev-blog 57
4 http://www.dr-chuck.com/dr-chuck/resume/speaking.htm 1
5 http://www.dr-chuck.com/dr-chuck/resume/index.htm 13
How many pages:</code></pre>
<p>Se pueden tener múltiples puntos de partida en la misma base de datos —dentro del programa, éstos son llamados “webs”. La araña elige entre todos los enlaces no visitados de las páginas existentes uno al azar como siguiente página a rastrear.</p>
<p>Si quieres ver el contenido del archivo <em>spider.sqlite</em>, puedes ejecutar <em>spdump.py</em>, que mostrará algo como esto:</p>
<pre><code>(5, None, 1.0, 3, &#39;http://www.dr-chuck.com/csev-blog&#39;)
(3, None, 1.0, 4, &#39;http://www.dr-chuck.com/dr-chuck/resume/speaking.htm&#39;)
(1, None, 1.0, 2, &#39;http://www.dr-chuck.com/csev-blog/&#39;)
(1, None, 1.0, 5, &#39;http://www.dr-chuck.com/dr-chuck/resume/index.htm&#39;)
4 rows.</code></pre>
<p>Esto muestra el número de enlaces hacia la página, la clasificación antigua de la página, la clasificación nueva, el id de la página, y la url de la página. El programa <em>spdump.py</em> sólo muestra aquellas páginas que tienen al menos un enlace hacia ella.</p>
<p>Una vez que tienes unas cuantas páginas en la base de datos, puedes ejecutar el clasificador sobre ellas, usando el programa <em>sprank.py</em>. Simplemente debes indicarle cuántas iteraciones del clasificador de páginas debe realizar.</p>
<pre><code>How many iterations:2
1 0.546848992536
2 0.226714939664
[(1, 0.559), (2, 0.659), (3, 0.985), (4, 2.135), (5, 0.659)]</code></pre>
<p>Puedes volcar en pantalla el contenido de la base de datos de nuevo para ver que la clasificación de páginas ha sido actualizada:</p>
<pre><code>(5, 1.0, 0.985, 3, &#39;http://www.dr-chuck.com/csev-blog&#39;)
(3, 1.0, 2.135, 4, &#39;http://www.dr-chuck.com/dr-chuck/resume/speaking.htm&#39;)
(1, 1.0, 0.659, 2, &#39;http://www.dr-chuck.com/csev-blog/&#39;)
(1, 1.0, 0.659, 5, &#39;http://www.dr-chuck.com/dr-chuck/resume/index.htm&#39;)
4 rows.</code></pre>
<p>Puedes ejecutar <em>sprank.py</em> tantas veces como quieras, y simplemente irá refinando la clasificación de páginas cada vez más. Puedes incluso ejecutar <em>sprank.py</em> varias veces, luego ir a la araña <em>spider.py</em> a recuperar unas cuantas páginas más y después ejecutar de nuevo <em>sprank.py</em> para actualizar los valores de clasificación. Un motor de búsqueda normalmente ejecuta ambos programas (el rastreador y el clasificador) de forma constante.</p>
<p>Si quieres reiniciar los cálculos de clasificación de páginas sin tener que rastrear de nuevo las páginas web, puedes usar <em>spreset.py</em> y después reiniciar <em>sprank.py</em>.</p>
<pre><code>How many iterations:50
1 0.546848992536
2 0.226714939664
3 0.0659516187242
4 0.0244199333
5 0.0102096489546
6 0.00610244329379
...
42 0.000109076928206
43 9.91987599002e-05
44 9.02151706798e-05
45 8.20451504471e-05
46 7.46150183837e-05
47 6.7857770908e-05
48 6.17124694224e-05
49 5.61236959327e-05
50 5.10410499467e-05
[(512, 0.0296), (1, 12.79), (2, 28.93), (3, 6.808), (4, 13.46)]</code></pre>
<p>En cada iteración del algoritmo de clasificación de páginas se muestra el cambio medio en la clasificación de cada página. La red al principio está bastante desequilibrada, de modo que los valores de clasificación para cada página cambiarán mucho entre iteraciones. Pero después de unas cuantas iteraciones, la clasificación de páginas converge. Deberías ejecutar <em>prank.py</em> durante el tiempo suficiente para que los valores de clasificación converjan.</p>
<p>Si quieres visualizar las páginas mejor clasificadas, ejecuta <em>spjson.py</em> para leer la base de datos y escribir el ranking de las páginas más enlazadas en formato JSON, que puede ser visualizado en un navegador web.</p>
<pre><code>Creating JSON output on spider.json...
How many nodes? 30
Open force.html in a browser to view the visualization</code></pre>
<p>You can view this data by opening the file <em>force.html</em> in your web browser. This shows an automatic layout of the nodes and links. You can click and drag any node and you can also double-click on a node to find the URL that is represented by the node.</p>
<p>Si vuelves a ejecutar las otras utilidades, ejecuta de nuevo <em>spjson.py</em> y pulsa actualizar en el navegador para obtener los datos actualizados desde <em>spider.json</em>.</p>
<h2 id="visualización-de-datos-de-correo">Visualización de datos de correo</h2>
<p>Si has llegado hasta este punto del libro, ya debes de estar bastante familiarizado con nuestros ficheros de datos <em>mbox-short.txt</em> y <em>mbox.txt</em>. Ahora es el momento de llevar nuestro análisis de datos de correo electrónico al siguiente nivel.</p>
<p>En el mundo real, a veces se tienen que descargar datos de correo desde los servidores. Eso podría llevar bastante tiempo y los datos podrían tener inconsistencias, estar llenos de errores, y necesitar un montón de limpieza y ajustes. En esta sección, trabajaremos con la aplicación más compleja que hemos visto hasta ahora, que descarga casi un gigabyte de datos y los visualiza.</p>
<figure>
<img src="../images/wordcloud.png" alt="" /><figcaption>A Word Cloud from the Sakai Developer List</figcaption>
</figure>
<p>Puedes descargar la aplicación desde:</p>
<p><a href="http://www.py4e.com/code3/gmane.zip">www.py4e.com/code3/gmane.zip</a></p>
<p>Utilizaremos los datos de un servicio de archivo de listas de correo electrónico libre, llamado <a href="http://www.gmane.org">www.gmane.org</a>. Este servicio es muy popular en proyectos de código abierto, debido a que proporciona un buen almacenaje con capacidad de búsqueda de su actividad de correo. También tienen una política muy liberal respecto al acceso a los datos a través de su API. No tienen límites de acceso, pero te piden que no sobrecargues su servicio y descargues sólo aquellos datos que necesites. Puedes leer los términos y condiciones de gmane en su página:</p>
<p><a href="http://gmane.org/export.php" class="uri">http://gmane.org/export.php</a></p>
<p><em>Es muy importante que hagas uso de los datos de gname.org con responsabilidad, añadiendo retrasos en tu acceso a sus servicios y extendiendo la realización de los procesos de larga duración a periodos de tiempo lo suficientemente largos. No abuses de este servicio libre y lo estropees para los demás.</em></p>
<p>Al usar este software para rastrear los datos de correo de Sakai, se generó casi un gigabyte de datos, requiriendo una cantidad considerable de ejecuciones durante varios días. El archivo <em>README.txt</em> del ZIP anterior contiene instrucciones sobre cómo descargar una copia pre-rastreada del archivo <em>content.sqlite</em> con la mayor parte del contenido de los correos de Sakai, de modo que no tengas que rastrear durante cinco días sólo para hacer funcionar los programas. Aunque descargues el contenido pre-rastreado, deberías ejecutar el proceso de rastreo para recuperar los mensajes más recientes.</p>
<p>El primer paso es rastrear el repositorio gmane. La URL base se puede modificar en <em>gmane.py</em>, y por defecto apunta a la lista de desarrolladores de Sakai. Puedes rastrear otro repositorio cambiando la url base. Asegúrate de borrar el fichero <em>content.sqlite</em> si realizas el cambio de url.</p>
<p>El archivo <em>gmane.py</em> opera como una araña caché responsable, que funciona despacio y recupera un mensaje de correo por segundo para evitar ser bloqueado por gmane. Almacena todos sus datos en una base de datos y puede ser interrumpido y reanudado tantas veces como sean necesarias. Puede llevar muchas horas descargar todos los datos. De modo que quizá debas reanudarlo varias veces.</p>
<p>He aquí una ejecución de <em>mane.py</em> recuperando los últimos cinco mensajes de la lista de desarrolladores de Sakai:</p>
<pre><code>How many messages:10
http://download.gmane.org/gmane.comp.cms.sakai.devel/51410/51411 9460
    nealcaidin@sakaifoundation.org 2013-04-05 re: [building ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51411/51412 3379
    samuelgutierrezjimenez@gmail.com 2013-04-06 re: [building ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51412/51413 9903
    da1@vt.edu 2013-04-05 [building sakai] melete 2.9 oracle ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51413/51414 349265
    m.shedid@elraed-it.com 2013-04-07 [building sakai] ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51414/51415 3481
    samuelgutierrezjimenez@gmail.com 2013-04-07 re: ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51415/51416 0

Does not start with From</code></pre>
<p>El programa revisa <em>content.sqlite</em> desde el principio hasta que encuentra un número de mensaje que aún no ha sido rastreado y comienza a partir de ahí. Continúa rastreando hasta que ha recuperado el número deseado de mensajes o hasta que llega a una página que no contiene un mensaje adecuadamente formateado.</p>
<p>A veces <a href="gmane.org">gmane.org</a> no encuentra un mensaje. Tal vez los administradores lo borraron, o quizás simplemente se perdió. Si tu araña se detiene, y parece que se atasca en un mensaje que no puede localizar, entra en SQLite Manager, añade una fila con el id perdido y los demás campos en blanco y reinicia <em>gmane.py</em>. Así se desbloqueará el proceso de rastreo y podrá continuar. Esos mensajes vacíos serán ignorados en la siguiente fase del proceso.</p>
<p>Algo bueno es que una vez que has rastreado todos los mensajes y los tienes en <em>content.sqlite</em>, puedes ejecutar <em>gmane.py</em> otra vez para obtener los mensajes nuevos según van siendo enviados a la lista.</p>
<p>Los datos en <em>content.sqlite</em> están guardados en bruto, con un modelado de datos ineficiente y sin comprimir. Esto se ha hecho así intencionadamente, para permitirte echar un vistazo en <em>content.sqlite</em> usando SQLite Manager y depurar problemas con el proceso de rastreo. Sería mala idea ejecutar consultas sobre esta base de datos, ya que puede resultar bastante lenta.</p>
<p>El segundo proceso consiste en ejecutar el programa <em>gmodel.py</em>. Este programa lee los datos en bruto de <em>content.sqlite</em> y produce una versión limpia y bien modelada de los datos, que envía al fichero <em>index.sqlite</em>. Este fichero es mucho más pequeño (puede ser 10 veces menor) que <em>content.sqlite</em>, porque también comprime la cabecera y el texto del cuerpo.</p>
<p>Cada vez que <em>gmodel.py</em> se ejecuta, borra y reconstruye <em>index.sqlite</em>. Esto permite ajustar sus parámetros y editar las tablas de asignación de <em>content.sqlite</em> para ajustar el proceso de limpieza de datos. Esto es un ejemplo de ejecución de <em>gmodel.py</em>. El programa imprime una línea en pantalla cada vez que son procesados 250 mensajes de correo para que puedas ver su evolución, ya que puede quedarse funcionando durante un buen rato mientras procesa alrededor de un Gigabyte de datos de correo.</p>
<pre><code>Loaded allsenders 1588 and mapping 28 dns mapping 1
1 2005-12-08T23:34:30-06:00 ggolden22@mac.com
251 2005-12-22T10:03:20-08:00 tpamsler@ucdavis.edu
501 2006-01-12T11:17:34-05:00 lance@indiana.edu
751 2006-01-24T11:13:28-08:00 vrajgopalan@ucmerced.edu
...</code></pre>
<p>The <em>gmodel.py</em> program handles a number of data cleaning tasks.</p>
<p>Los nombres de dominio son truncados a dos niveles para .com, .org, .edu y .net. Otros nombres de dominio son truncados a tres niveles. De modo que si.umich.edu se transforma en umich.edu, y caret.cam.ac.uk queda como cam.ac.uk. Las direcciones de correo electrónico también son transformadas a minúsculas, y algunas de las direcciones de <span class="citation" data-cites="gmane.org">@gmane.org</span>, como la siguiente</p>
<pre><code>arwhyte-63aXycvo3TyHXe+LvDLADg@public.gmane.org</code></pre>
<p>son convertidas en direcciones reales, cuando esa dirección de correo real existe en otra parte del cuerpo del mensaje.</p>
<p>En la base de datos <em>mapping.sqlite</em> existen dos tablas que te permiten asignar tanto nombres de dominios como direcciones de correo individuales que van cambiando a lo largo del tiempo de existencia de la lista de correo. Por ejemplo, Steve Githens ha usado las direcciones de correo siguientes, según iba cambiando de trabajo a lo largo de la existencia de la lista de desarrolladores de Sakai:</p>
<pre><code>s-githens@northwestern.edu
sgithens@cam.ac.uk
swgithen@mtu.edu</code></pre>
<p>Podemos añadir dos entradas en la tabla de asignación (Mapping) de <em>mapping.sqlite</em>, de modo que gmodel.py enlazará las tres direcciones en una:</p>
<pre><code>s-githens@northwestern.edu -&gt;  swgithen@mtu.edu
sgithens@cam.ac.uk -&gt; swgithen@mtu.edu</code></pre>
<p>Puedes crear entradas similares en la tabla DNSMapping si hay múltiples nombres DNS que quieres asignar a una única DNS. En los datos de Sakai se ha realizado la siguiente asignación:</p>
<pre><code>iupui.edu -&gt; indiana.edu</code></pre>
<p>de modo que todas las cuentas de los distintos campus de las Universidades de Indiana son monitoreadas juntas.</p>
<p>Puedes volver a ejecutar <em>gmodel.py</em> una y otra vez mientras vas mirando los datos, y añadir asignaciones para hacer que los datos queden más y más limpios. Cuando lo hayas hecho, tendrás una bonita versión indexada del correo en <em>index.sqlite</em>. Éste es el archivo que usaremos para analizar los datos. Con ese archivo, el análisis de datos se realizará muy rápidamente.</p>
<p>El primer y más sencillo análisis de datos consistirá en determinar “¿Quién ha enviado más correos?”, y “¿Qué organización ha enviado más correos?”. Esto se realizará usando <em>gbasic.py</em>:</p>
<pre><code>How many to dump? 5
Loaded messages= 51330 subjects= 25033 senders= 1584

Top 5 Email list participants
steve.swinsburg@gmail.com 2657
azeckoski@unicon.net 1742
ieb@tfd.co.uk 1591
csev@umich.edu 1304
david.horwitz@uct.ac.za 1184

Top 5 Email list organizations
gmail.com 7339
umich.edu 6243
uct.ac.za 2451
indiana.edu 2258
unicon.net 2055</code></pre>
<p>Fijate cómo <em>gbasic.py</em> funciona mucho más rápido que <em>gmane.py</em>, e incluso que <em>gmodel.py</em>. Todos trabajan con los mismos datos, pero <em>gbasic.py</em> está usando los datos comprimidos y normalizados de <em>index.sqlite</em>. Si tienes un montón de datos que gestionar, un proceso multipaso como el que se realiza en esta aplicación puede ser más largo de desarrollar, pero te ahorrará un montón de tiempo cuando realmente comiences a explorar y visualizar los datos.</p>
<p>Puedes generar una vista sencilla con la frecuencia de cada palabra en las líneas de título, usando el archivo <em>gword.py</em>:</p>
<pre><code>Range of counts: 33229 129
Output written to gword.js</code></pre>
<p>Esto genera el archivo <em>gword.js</em>, que puedes visualizar utilizando <em>gword.htm</em> para producir una nube de palabras similar a la del comienzo de esta sección.</p>
<p><em>gline.py</em> genera también una segunda vista. En este caso cuenta la participación en forma de correos de las organizaciones a lo largo del tiempo.</p>
<pre><code>Loaded messages= 51330 subjects= 25033 senders= 1584
Top 10 Oranizations
[&#39;gmail.com&#39;, &#39;umich.edu&#39;, &#39;uct.ac.za&#39;, &#39;indiana.edu&#39;,
&#39;unicon.net&#39;, &#39;tfd.co.uk&#39;, &#39;berkeley.edu&#39;, &#39;longsight.com&#39;,
&#39;stanford.edu&#39;, &#39;ox.ac.uk&#39;]
Output written to gline.js</code></pre>
<p>Su resultado es guardado en <em>gline.js</em>, que se puede visualizar usando <em>gline.htm</em>.</p>
<figure>
<img src="../images/mailorg.png" alt="" /><figcaption>Sakai Mail Activity by Organization</figcaption>
</figure>
<p>Esta aplicación es relativamente compleja y sofisticada, y dispone de características para realizar recuperación de datos reales, limpieza y visualización.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
