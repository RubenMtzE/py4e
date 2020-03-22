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
<h1 id="programación-orientada-a-objetos">Programación Orientada a Objetos</h1>
<h2 id="manejando-programas-más-grandes">Manejando programas más grandes</h2>
<p></p>
<p>Al comienzo de este libro, vimos cuatro patrones básicos de programación que utilizamos para construir programas:</p>
<ul>
<li>Código secuencial</li>
<li>Código condicional (declaraciones <code>if</code>)</li>
<li>Código repetitivo (bucles)</li>
<li>Almacenar y reutilizar (funciones)</li>
</ul>
<p>En capítulos posteriores, exploramos las variables simples, así como estructuras de datos de colecciones, tales como listas, tuplas y diccionarios.</p>
<p>A medida que construimos programas, diseñamos estructuras de datos y escribimos código para manipularlas. Hay muchas formas de escribir programas y, a estas alturas, probablemente hayas escrito algunos programas “no muy elegantes” y otros que son “más elegantes”. Aunque tus programas aún sean pequeños, estás empezando a ver que al escribir código hay una parte de arte y de consideraciones estéticas.</p>
<p>A medida que los programas crecen hasta abarcar millones de líneas de código, se vuelve cada vez más importante que éste resulte fácil de entender. Si estás trabajando en un programa de un millón de líneas, es imposible mantener todo el programa en tu mente a la vez. Necesitamos maneras de dividir programas grandes en varias piezas más pequeñas para que tengamos que concentrarnos en una sección menor cuando tengamos que resolver un problema, arreglar un bug, o agregar una nueva funcionalidad.</p>
<p>En cierto modo, la programación orientada a objetos es una forma de ordenar tu código de tal manera que puedas enfocarte en 50 líneas de código y entenderlas, e ignorar las otras 999,950 mientras tanto.</p>
<h2 id="cómo-empezar">Cómo empezar</h2>
<p>Al igual que muchos aspectos de la programación, es necesario aprender los conceptos de la programación orientada a objetos para poder utilizarlos de manera efectiva. Deberías enfocarte en este capítulo como una forma de aprender algunos términos y conceptos y examinar algunos ejemplos sencillos para sentar las bases de tu futuro aprendizaje.</p>
<p>El resultado clave de este capítulo será una comprensión a nivel básico de cómo se construyen los objetos, cómo funcionan y, lo más importante, cómo usar las características de los objetos que nos dan Python y sus librerías.</p>
<h2 id="usando-objetos">Usando objetos</h2>
<p>Curiosamente, en el libro hemos estado utilizando objetos todo este tiempo. Python contiene muchos objetos incluidos. He aquí un programa sencillo, cuyas primeras líneas deberían resultarte sumamente simples y familiares.</p>
<p></p>
<pre class="python"><code>stuff = list()
stuff.append(&#39;python&#39;)
stuff.append(&#39;chuck&#39;)
stuff.sort()
print (stuff[0])
print (stuff.__getitem__(0))
print (list.__getitem__(stuff,0))

# Code: http://www.py4e.com/code3/party1.py</code></pre>
<p>En lugar de enfocarnos en el resultado que obtienen estas líneas, enfoquémonos en lo que está pasando desde el punto de vista de la programación orientada a objetos. No te preocupes si los siguientes párrafos no parecen tener sentido la primera vez que los lees, pues no hemos definido todos estos términos aún.</p>
<p>La primera línea <em>construye</em> un objeto de tipo <code>list</code>, la segunda y tercera líneas <em>llaman</em> al <em>método</em> <code>append</code>, la cuarta línea llama al método <code>sort()</code> y la quinta línea <em>recupera</em> el elemento en posición 0.</p>
<p>La sexta línea llama al método <code>__getitem__()</code> en la lista <code>stuff</code> con un parámetro de cero.</p>
<pre class="python"><code>print (stuff.__getitem__(0))</code></pre>
<p>La séptima línea es una manera incluso más verbosa de obtener el elemento en posición 0 de la lista.</p>
<pre class="python"><code>print (list.__getitem__(stuff,0))</code></pre>
<p>En este programa, llamamos al método <code>__getitem__</code> en la clase <code>lista</code> y <em>pasamos</em> la lista y el elemento que queremos recuperar de ésta como parámetros.</p>
<p>Las últimas tres líneas del programa son equivalentes, pero es más conveniente simplemente usar corchetes para buscar un elemento en una posición específica dentro de una lista.</p>
<p>Podemos ver las capacidades de un objeto mirando el resultado de la función <code>dir()</code>:</p>
<pre><code>&gt;&gt;&gt; stuff = list()
&gt;&gt;&gt; dir(stuff)
[&#39;__add__&#39;, &#39;__class__&#39;, &#39;__contains__&#39;, &#39;__delattr__&#39;,
&#39;__delitem__&#39;, &#39;__dir__&#39;, &#39;__doc__&#39;, &#39;__eq__&#39;,
&#39;__format__&#39;, &#39;__ge__&#39;, &#39;__getattribute__&#39;, &#39;__getitem__&#39;,
&#39;__gt__&#39;, &#39;__hash__&#39;, &#39;__iadd__&#39;, &#39;__imul__&#39;, &#39;__init__&#39;,
&#39;__iter__&#39;, &#39;__le__&#39;, &#39;__len__&#39;, &#39;__lt__&#39;, &#39;__mul__&#39;,
&#39;__ne__&#39;, &#39;__new__&#39;, &#39;__reduce__&#39;, &#39;__reduce_ex__&#39;,
&#39;__repr__&#39;, &#39;__reversed__&#39;, &#39;__rmul__&#39;, &#39;__setattr__&#39;,
&#39;__setitem__&#39;, &#39;__sizeof__&#39;, &#39;__str__&#39;, &#39;__subclasshook__&#39;,
&#39;append&#39;, &#39;clear&#39;, &#39;copy&#39;, &#39;count&#39;, &#39;extend&#39;, &#39;index&#39;,
&#39;insert&#39;, &#39;pop&#39;, &#39;remove&#39;, &#39;reverse&#39;, &#39;sort&#39;]
&gt;&gt;&gt;</code></pre>
<p>El resto de este capítulo estará dedicado a definir estos términos, así que asegúrate de volver a leer los párrafos anteriores una vez que termines de leerlo, para asegurarte de haberlo comprendido correctamente.</p>
<h2 id="comenzando-con-programas">Comenzando con programas</h2>
<p>En su forma más básica, un programa toma algún dato de entrada, lo procesa y luego produce un resultado. Nuestro programa de conversión de un elevador muestra una manera muy corta, pero completa, de llevar a cabo estos tres pasos.</p>
<pre class="python"><code>usf = input(&#39;Enter the US Floor Number: &#39;)
wf = int(usf) - 1
print(&#39;Non-US Floor Number is&#39;,wf)

# Code: http://www.py4e.com/code3/elev.py</code></pre>
<p>Si pensamos un poco más sobre este programa, existe un “mundo exterior” y el programa. Es con los datos de entrada y de salida que el programa interactúa con el mundo exterior. Dentro del programa utilizamos tanto el código como los datos para cumplir la tarea que el programa está diseñado para resolver.</p>
<figure>
<img src="../images/program.svg" alt="" /><figcaption>A Program</figcaption>
</figure>
<p>Una forma de pensar en la programación orientada a objetos es que separa nuestro programa en varias “zonas”. Cada zona contiene algo de código y datos (como un programa) y tiene interacciones bien definidas tanto con el mundo exterior como con las otras zonas del programa.</p>
<p>Si miramos la aplicación de extracción de enlaces en la que usamos la librería BeautifulSoup, podemos ver un programa que fue construido conectando distintos objetos para cumplir una tarea:</p>
<p>  </p>
<pre class="python"><code># Para ejecutar este programa descarga BeautifulSoup
# https://pypi.python.org/pypi/beautifulsoup4

# O descarga el archivo
# http://www.py4e.com/code3/bs4.zip
# y descomprimelo en el mismo directorio que este archivo

import urllib.request, urllib.parse, urllib.error
from bs4 import BeautifulSoup
import ssl

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Introduzca - &#39;)
html = urllib.request.urlopen(url, context=ctx).read()
sopa = BeautifulSoup(html, &#39;html.parser&#39;)

# Recuperar todas las etiquetas de anclaje
etiquetas = sopa(&#39;a&#39;)
for etiqueta in etiquetas:
    print(etiqueta.get(&#39;href&#39;, None))

# Code: http://www.py4e.com/code3/urllinks.py</code></pre>
<p>Convertimos la URL en una cadena y luego pasamos a ésta por <code>urllib</code> para recuperar los datos de la web. La librería <code>urllib</code> utiliza la librería <code>socket</code> para llevar a cabo la conexión que recupera los datos. Tomamos la cadena que retorna <code>urllib</code> y se la entregamos a BeautifulSoup para su análisis. BeautifulSoup utiliza el objeto <code>html.parser</code><a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> y retorna un objeto. Luego, llamamos al método <code>tags()</code> en el objeto retornado, lo que retorna un diccionario de etiquetas. Nos desplazamos por las etiquetas y llamamos el método <code>get()</code> por cada etiqueta para imprimir el atributo <code>href</code>.</p>
<p>Podemos hacer un diagrama de este programa y cómo los objetos funcionan en conjunto.</p>
<figure>
<img src="../images/program-oo.svg" alt="" /><figcaption>A Program as Network of Objects</figcaption>
</figure>
<p>Lo importante ahora no es entender perfectamente como funciona este programa, sino que ver cómo construimos una red de objetos que interactúen entre sí y orquestamos el movimiento de información entre esos objetos para crear un programa. También es importante notar que, cuando viste el programa hace varios capítulos, pudiste entender perfectamente cómo funcionaba sin siquiera percatarte de que estaba “orquestando el movimiento de datos entre objetos”. Eran solo líneas de código que cumplían una tarea.</p>
<h2 id="subdividiendo-un-problema">Subdividiendo un problema</h2>
<p>Una de las ventajas del enfoque orientado a objetos es que puede ocultar la complejidad de un programa. Por ejemplo, aunque necesitamos saber cómo usar el código de <code>urllib</code> y BeautifulSoup, no necesitamos saber cómo funcionan internamente esas librerías. Esto nos permite enfocarnos en la parte del problema que necesitamos resolver e ignorar las otras partes del programa.</p>
<figure>
<img src="../images/program-oo-code.svg" alt="" /><figcaption>Ignoring Detail When Using an Object</figcaption>
</figure>
<p>Esta capacidad de enfocarnos exclusivamente en la parte del programa que nos preocupa e ignorar el resto también le sirve a los desarrolladores de los objetos que utilizamos. Por ejemplo, los programadores que desarrollan BeautifulSoup no necesitan saber cómo recuperamos nuestra página HTML, qué partes de ésta queremos leer, o qué queremos hacer con los datos que obtengamos de la página web.</p>
<figure>
<img src="../images/program-oo-bs4.svg" alt="" /><figcaption>Ignoring Detail When Building an Object</figcaption>
</figure>
<h2 id="nuestro-primer-objeto-de-python">Nuestro primer objeto de Python</h2>
<p>En un nivel elemental, un objeto es simplemente un trozo de código más estructuras de datos, más pequeños que un programa completo. Definir una función nos permite almacenar un trozo de código, darle un nombre y luego invocarlo usando el nombre de la función.</p>
<p>Un objeto puede contener varias funciones (a las que llamaremos <em>métodos</em>), así como los datos utilizados por esas funciones. Llamamos <em>atributos</em> a los datos que son parte del objeto.</p>
<p></p>
<p>Usamos la palabra clave <code>class</code> para definir los datos y el código que compondrán cada objeto. La palabra clave class incluye el nombre de la clase y da inicio a un bloque de código indentado en el que incluiremos sus atributos (datos) y métodos (código).</p>
<pre class="python"><code>class PartyAnimal:
   x = 0

   def party(self) :
     self.x = self.x + 1
     print(&quot;So far&quot;,self.x)

an = PartyAnimal()
an.party()
an.party()
an.party()
PartyAnimal.party(an)

# Code: http://www.py4e.com/code3/party2.py</code></pre>
<p>Cada método parece una función: comienzan con la palabra clave <code>def</code> y consisten en un bloque de código indentado. Este objeto tiene un atributo (<code>x</code>) y un método (<code>party</code>). Los métodos tienen un primer parámetro especial al que, por convención, llamamos <code>self</code>.</p>
<p>Tal como la palabra clave <code>def</code> no causa que el código de una función se ejecute, la palabra clave <code>class</code> no crea un objeto. En vez, la palabra clave <code>class</code> define una plantilla que indica qué datos y código contendrá cada objeto de tipo <code>PartyAnimal</code>. La clase es como un molde para galletas y los objetos creados usándola son las galletas<a href="#fn2" class="footnote-ref" id="fnref2" role="doc-noteref"><sup>2</sup></a>. No se le echa el glaseado al molde de las galletas; se le echa glaseado a las galletas mismas, con lo que se puede poner un glaseado distinto en cada galleta.</p>
<figure>
<img src="../photos/cookie_cutter_flickr_Didriks.png" alt="" /><figcaption>A Class and Two Objects</figcaption>
</figure>
<p>Si seguimos con este programa de ejemplo, veremos la primera línea ejecutable de código:</p>
<pre class="python"><code>an = PartyAnimal()</code></pre>
<p>   </p>
<p>Es aquí que le ordenamos a Python construir (es decir, crear) un <em>objeto</em> o <em>instancia</em> de la clase <code>PartyAnimal</code>. Se ve como si fuera una llamada de función a la clase misma. Python construye el objeto con los datos y métodos adecuados, asignándolo luego a la variable <code>an</code>. En cierto modo, esto es muy similar a la siguiente línea, que hemos estado usando todo este tiempo:</p>
<pre class="python"><code>counts = dict()</code></pre>
<p>Aquí le ordenamos a Python construir un objeto usando la plantilla <code>dict</code> (que viene incluida en Python), devolver la instancia del diccionario, y asignarla a la variable <code>counts</code>.</p>
<p>Cuando se usa la clase <code>PartyAnimal</code> para construir un objeto, la variable <code>an</code> se usa para señalar ese objeto. Usamos <code>an</code> para acceder al código y datos de esa instancia específica de la clase <code>PartyAnimal</code>.</p>
<p>Cada objeto o instancia de PartyAnimal contiene una variable <code>x</code> y un método/ función llamado <code>party</code>. Llamamos al método <code>party</code> en esta línea:</p>
<pre class="python"><code>an.party()</code></pre>
<p>Al llamar al método <code>party</code>, el primer parámetro (al que por convención llamamos <code>self</code>) apunta a la instancia específica del objeto PartyAnimal desde el que se llama a <code>party</code>. Dentro del método <code>party</code>, vemos la siguiente línea:</p>
<pre class="python"><code>self.x = self.x + 1</code></pre>
<p>Esta sintaxis utiliza el operador de <em>punto</em>, con lo que significa ‘la x dentro de self’. Cada vez que se llama a <code>party()</code>, el valor interno de <code>x</code> se incrementa en 1 y se imprime su valor.</p>
<p>La siguiente línea muestra otra manera de llamar al método <code>party</code> dentro del objeto <code>an</code>:</p>
<pre class="python"><code>PartyAnimal.party(an)</code></pre>
<p>En esta variante, accedemos al código desde el interior de la clase y explícitamente pasamos el apuntador del objeto <code>an</code> como el primer parámetro (es decir, <code>self</code> dentro del método). Se puede pensar en <code>an.party()</code> como una abreviación de la línea precedente.</p>
<p>Al ejecutar el programa, produce el siguiente resultado:</p>
<pre><code>So far 1
So far 2
So far 3
So far 4</code></pre>
<p>El objeto es construido, y el método <code>party</code> es llamado cuatro veces, incrementando e imprimiendo el valor de <code>x</code> dentro del objeto <code>an</code>.</p>
<h2 id="clases-como-tipos">Clases como tipos</h2>
<p> </p>
<p>Como hemos visto, en Python todas las variables tienen un tipo. Podemos usar la función <code>dir</code> incluida en Python para examinar las características de una variable. También podemos usar <code>type</code> y <code>dir</code> con las clases que creemos.</p>
<pre class="python"><code>class PartyAnimal:
   x = 0

   def party(self) :
     self.x = self.x + 1
     print(&quot;So far&quot;,self.x)

an = PartyAnimal()
print (&quot;Type&quot;, type(an))
print (&quot;Dir &quot;, dir(an))
print (&quot;Type&quot;, type(an.x))
print (&quot;Type&quot;, type(an.party))

# Code: http://www.py4e.com/code3/party3.py</code></pre>
<p>Al ejecutar este programa, produce el siguiente resultado:</p>
<pre><code>Type &lt;class &#39;__main__.PartyAnimal&#39;&gt;
Dir  [&#39;__class__&#39;, &#39;__delattr__&#39;, ...
&#39;__sizeof__&#39;, &#39;__str__&#39;, &#39;__subclasshook__&#39;,
&#39;__weakref__&#39;, &#39;party&#39;, &#39;x&#39;]
Type &lt;class &#39;int&#39;&gt;
Type &lt;class &#39;method&#39;&gt;</code></pre>
<p>Puedes ver que, usando la palabra clave <code>class</code>, hemos creado un nuevo tipo. En el resultado de usar <code>dir</code>, puedes ver que tanto el atributo de tipo entero <code>x</code> como el método <code>party</code> están disponibles dentro del objeto.</p>
<h2 id="ciclo-de-vida-de-un-objeto">Ciclo de vida de un objeto</h2>
<p>  </p>
<p>En los ejemplos anteriores, definimos una clase (plantilla), la usamos para crear una instancia de ella (objeto) y luego usamos esa instancia. Al finalizar el programa, todas las variables son descartadas. Normalmente, no nos preocupamos mucho de la creación y destrucción de variables, pero a menudo, cuando nuestros objetos se vuelven más complejos, resulta necesario efectuar algunos pasos dentro del objeto para configurar la construcción de éste y, posiblemente, ordenar cuando el objeto es descartado.</p>
<p>Si queremos que nuestro objeto sea consciente de esos momentos de creación y destrucción, debemos agregarle métodos especialmente nombrados al efecto:</p>
<pre class="python"><code>class PartyAnimal:
   x = 0

   def __init__(self):
     print(&#39;I am constructed&#39;)

   def party(self) :
     self.x = self.x + 1
     print(&#39;So far&#39;,self.x)

   def __del__(self):
     print(&#39;I am destructed&#39;, self.x)

an = PartyAnimal()
an.party()
an.party()
an = 42
print(&#39;an contains&#39;,an)

# Code: http://www.py4e.com/code3/party4.py</code></pre>
<p>Al ejecutar este programa, produce el siguiente resultado:</p>
<pre><code>I am constructed
So far 1
So far 2
I am destructed 2
an contains 42</code></pre>
<p>Cuando Python construye el objeto, llama a nuestro método <code>__init__</code> para darnos la oportunidad de configurar algunos valores por defecto o iniciales para éste. Cuando Python encuentra la línea:</p>
<pre><code>an = 42</code></pre>
<p>efectivamente “tira a la basura” el objeto para reutilizar la variable <code>an</code>, almacenando el valor <code>42</code>. Justo en el momento en que nuestro objeto <code>an</code> está siendo “destruido” se llama a nuestro código destructor (<code>__del__</code>). No podemos evitar que nuestra variable sea destruida, pero podemos efectuar la configuración que resulte necesaria antes de que el objeto deje de existir.</p>
<p>Al desarrollar objetos, es bastante común agregarles un constructor que fije sus valores iniciales. Es relativamente raro necesitar un destructor para un objeto.</p>
<h2 id="múltiples-instancias">Múltiples instancias</h2>
<p>Hasta ahora hemos definido una clase, construido un solo objeto, usado ese objeto, y luego descartado el objeto. Sin embargo, el auténtico potencial de la programación orientada a objetos se manifiesta al construir múltiples instancias de nuestra clase.</p>
<p>Al construir múltiples instancias de nuestra clase, puede que queramos fijar distintos valores iniciales para cada objeto. Podemos pasar datos a los constructores para dar a cada objeto un distinto valor inicial:</p>
<pre class="python"><code>class PartyAnimal:
   x = 0
   name = &#39;&#39;
   def __init__(self, nam):
     self.name = nam
     print(self.name,&#39;constructed&#39;)

   def party(self) :
     self.x = self.x + 1
     print(self.name,&#39;party count&#39;,self.x)

s = PartyAnimal(&#39;Sally&#39;)
j = PartyAnimal(&#39;Jim&#39;)

s.party()
j.party()
s.party()

# Code: http://www.py4e.com/code3/party5.py</code></pre>
<p>El constructor tiene tanto un parámetro <code>self</code>, que apunta a la instancia del objeto, como parámetros adicionales, que se pasan al constructor al momento de construir el objeto:</p>
<pre><code>s = PartyAnimal(&#39;Sally&#39;)</code></pre>
<p>Dentro del constructor, la segunda línea copia el parámetro (<code>nam</code>), el que se pasa al atributo <code>nombre</code> dentro del objeto.</p>
<pre><code>self.name = nam</code></pre>
<p>El resultado del programa muestra que cada objeto (<code>s</code> y <code>j</code>) contienen sus propias copias independientes de <code>x</code> y <code>nam</code>:</p>
<pre><code>Sally constructed
Sally party count 1
Jim constructed
Jim party count 1
Sally party count 2</code></pre>
<h2 id="herencia">Herencia</h2>
<p>Otra poderosa característica de la programación orientada a objetos es la capacidad de crear una nueva clase extendiendo una clase ya existente. Al extender una clase, llamamos a la clase original la <em>clase padre</em> y a la nueva clase <em>clase hija</em>.</p>
<p>Por ejemplo, podemos mover a nuestra clase <code>PartyAnimal</code> a su propio archivo. Luego, podemos ‘importar’ la clase <code>PartyAnimal</code> en un nuevo archivo y extenderla, de la siguiente manera:</p>
<pre class="python"><code>from party import PartyAnimal

class CricketFan(PartyAnimal):
   points = 0
   def six(self):
      self.points = self.points + 6
      self.party()
      print(self.name,&quot;points&quot;,self.points)

s = PartyAnimal(&quot;Sally&quot;)
s.party()
j = CricketFan(&quot;Jim&quot;)
j.party()
j.six()
print(dir(j))

# Code: http://www.py4e.com/code3/party6.py</code></pre>
<p>Cuando definimos la clase <code>CricketFan</code>, indicamos que estamos extendiendo la clase <code>PartyAnimal</code>. Esto significa que todas las variables (<code>x</code>) y métodos (<code>party</code>) de la clase <code>PartyAnimal</code> son <em>heredados</em> por la clase <code>CricketFan</code>. Por ejemplo, dentro del método <code>six</code> en la clase <code>CricketFan</code>, llamamos al método <code>party</code> de la clase <code>PartyAnimal</code>.</p>
<p>Al ejecutar el programa, creamos <code>s</code> y <code>j</code> como instancias independientes de <code>PartyAnimal</code> y <code>CricketFan</code>. El objeto <code>j</code> tiene características adicionales que van más allá de aquellas que tiene el objeto <code>s</code>.</p>
<pre><code>Sally constructed
Sally party count 1
Jim constructed
Jim party count 1
Jim party count 2
Jim points 6
[&#39;__class__&#39;, &#39;__delattr__&#39;, ... &#39;__weakref__&#39;,
&#39;name&#39;, &#39;party&#39;, &#39;points&#39;, &#39;six&#39;, &#39;x&#39;]</code></pre>
<p>En el resultado de llamar a <code>dir</code> sobre el objeto <code>j</code> (instancia de la clase <code>CricketFan</code>), vemos que tiene los atributos y métodos de la clase padre, además de los atributos y métodos que fueron agregados cuando la extendimos para crear la clase <code>CricketFan</code>.</p>
<h2 id="resumen">Resumen</h2>
<p>Esta es una introducción muy superficial a la programación orientada a objetos, enfocada principalmente en la terminología y sintaxis necesarias para definir y usar objetos. Vamos a reseñar rápidamente el código que vimos al comienzo del capítulo. A estas alturas deberías entender completamente lo que está pasando.</p>
<pre class="python"><code>stuff = list()
stuff.append(&#39;python&#39;)
stuff.append(&#39;chuck&#39;)
stuff.sort()
print (stuff[0])
print (stuff.__getitem__(0))
print (list.__getitem__(stuff,0))

# Code: http://www.py4e.com/code3/party1.py</code></pre>
<p>La primera línea construye un <em>objeto</em> de clase <code>list</code>. Cuando Python crea el objeto de clase <code>list</code> llama al método <em>constructor</em> (llamado <code>__init__</code>) para configurar los atributos internos de datos que se utilizarán para almacenar los datos de la lista. Aún no hemos pasado ningún parámetro al <em>constructor</em>. When el constructor retorna, usamos la variable <code>stuff</code> para apuntar la instancia retornada de la clase <code>list</code>.</p>
<p>La segunda y tercera líneas llaman al método <code>append</code> con un parámetro para agregar un nuevo objeto al final de la lista actualizando los atributos al interior de <code>stuff</code>. Luego, en la cuarta línea, llamamos al método <code>sort</code> sin darle ningún parámetro para ordenar los datos dentro del objeto <code>stuff</code>.</p>
<p>Luego, imprimimos el primer objeto en la lista usando los corchetes, los que son una abreviatura para llamar el método <code>__getitem__</code> dentro de <code>stuff</code>. Esto es equivalente a llamado al método <code>__getitem__</code> dentro de la <em>clase</em> <code>list</code> y pasar el objeto <code>stuff</code> como primer parámetro y la posición que necesitamos como segundo parámetro.</p>
<p>Al final del programa, el objeto <code>stuff</code> es descartado, pero no antes de llamar al método <em>destructor</em> (llamado <code>__del__</code>) de manera tal que el objeto pueda atar cabos sueltos en caso de resultar necesario.</p>
<p>Estos son los aspectos básicos de la programación orientada a objetos. Hay muchos detalles adicionales sobre cómo usar un enfoque de programación orientada a objetos al desarrollar aplicaciones, así como librerías, las que van más allá del ámbito de este capítulo.<a href="#fn3" class="footnote-ref" id="fnref3" role="doc-noteref"><sup>3</sup></a></p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>atributo</dt>
<dd>Una variable que es parte de una clase.
</dd>
<dt>clase</dt>
<dd>Una plantilla que puede usarse para construir un objeto. Define los atributos y métodos que formarán a dicho objeto.
</dd>
<dt>clase hija</dt>
<dd>Una nueva clase creada cuando una clase padre es extendida. La clase hija hereda todos los atributos y métodos de la clase padre.
</dd>
<dt>constructor</dt>
<dd>Un método opcional con un nombre especial (<code>__init__</code>) que es llamado al momento en que se utiliza una clase para construir un objeto. Normalmente se utiliza para determinar los valores iniciales del objeto.
</dd>
<dt>destructor</dt>
<dd>Un método opcional con un nombre especial (<code>__del__</code>) que es llamado justo un momento antes de que un objeto sea destruido. Los destructores rara vez son utilizados.
</dd>
<dt>herencia</dt>
<dd>Cuando creamos una nueva clase (hija) extendiendo una clase existente (padre). La clase hija tiene todos los atributos y métodos de la clase padre, más los atributos y métodos adicionales definidos por la clase hija.
</dd>
</dl>
<p></p>
<dl>
<dt>método</dt>
<dd>Una función contenida dentro de una clase y de los objetos construidos desde esa clase. Algunos patrones de diseño orientados a objetos describen este concepto como ‘mensaje’ en lugar de ‘método’.
</dd>
<dt>objeto</dt>
<dd>Una instancia construida de una clase. Un objeto contiene todos los atributos y métodos definidos por la clase. En algunos casos de documentación orientada a objetos se utiliza el término ‘instancia’ de manera intercambiable con ‘objeto’.
</dd>
<dt>clase padre</dt>
<dd>La clase que está siendo extendida para crear una nueva clase hija. La clase padre aporta todos sus métodos y atributos a la nueva clase hija.
</dd>
</dl>
<p></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>https://docs.python.org/3/library/html.parser.html<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn2" role="doc-endnote"><p>Cookie image copyright CC-BY https://www.flickr.com/photos/dinnerseries/23570475099<a href="#fnref2" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn3" role="doc-endnote"><p>Si quieres saber donde se encuentra definida la clase <code>list</code>, echa un vistazo a (ojalá la URL no cambie) https://github.com/python/cpython/blob/master/Objects/listobject.c - la clase list está escrita en un lenguaje llamado “C”. Si ves el código fuente y sientes curiosidad, quizá te convenga buscar algunos cursos sobre Ciencias de la Computación.<a href="#fnref3" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
</ol>
</section>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
