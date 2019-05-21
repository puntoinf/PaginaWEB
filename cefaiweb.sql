-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2018 a las 07:41:43
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cefaiweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(125) DEFAULT NULL,
  `descripcion` text,
  `ruta` varchar(256) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `revisado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(125) NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `url`) VALUES
(1, 'Técnicatura Universitaria en Desarrollo Web', 'http://faiweb.uncoma.edu.ar/index.php/51-academica/carreras-fai/3-tecnicatura'),
(2, 'Técnicatura Universitaria en Administración de Sistemas y Software Libre', 'http://faiweb.uncoma.edu.ar/index.php/51-academica/carreras-fai/1-tec-software-libre'),
(3, 'Profesorado en Informática', 'http://faiweb.uncoma.edu.ar/index.php/51-academica/carreras-fai/15-profesorado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_foro`
--

CREATE TABLE `categoria_foro` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_foro`
--

INSERT INTO `categoria_foro` (`id`, `descripcion`) VALUES
(1, 'Consulta'),
(2, 'Parcial'),
(3, 'Final'),
(4, 'Cursado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativa`
--

CREATE TABLE `correlativa` (
  `id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `cursada_id` int(11) NOT NULL,
  `aprobada_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `correlativa`
--

INSERT INTO `correlativa` (`id`, `materia_id`, `cursada_id`, `aprobada_id`) VALUES
(1, 11, 6, 7),
(2, 12, 5, 6),
(3, 17, 16, 16),
(4, 17, 15, 15),
(5, 18, 11, 9),
(6, 18, 13, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_semana`
--

CREATE TABLE `dia_semana` (
  `id` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dia_semana`
--

INSERT INTO `dia_semana` (`id`, `nombre`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `id_tipo`, `descripcion`) VALUES
(1, 1, 'Abierto'),
(2, 1, 'Cerrado'),
(3, 1, 'Resuelto'),
(4, 3, 'Abierto'),
(5, 3, 'Cerrado'),
(6, 4, 'Autorizado'),
(7, 4, 'Pendiente'),
(8, 4, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `desde` datetime DEFAULT NULL,
  `hasta` datetime DEFAULT NULL,
  `es_feriado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `id_usuario`, `nombre`, `descripcion`, `lugar`, `desde`, `hasta`, `es_feriado`) VALUES
(1, 5, 'Charla de Marketing', 'El fin de esta charla es darle herramientas a los estudiantes sobre como saber vender su Software.', 'Salon Azul', '2018-06-14 19:30:00', '2018-06-14 20:30:00', 0),
(2, 5, 'Charla de Arduino', 'El fin de esta charla es informar a los estudiantes sobre que es y como se utiliza un Arduino.', 'Salon Azul', '2018-06-30 17:00:00', '2018-06-30 19:30:00', 0),
(3, 5, 'Celebracion Dia de la Independencia', 'Es una celebracion por el 9 de julio con el fin de recaudar fondos para el centro de estudiantes. Estaran a la venta tortas fritas y se regalara chocolatada.', 'Estacionamiento de la Facultad de Humanidades', '2018-07-09 16:30:00', '2018-07-09 19:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(125) DEFAULT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `id_usuario`, `id_estado`, `id_categoria`, `titulo`, `texto`, `fecha`) VALUES
(1, 1, 1, 1, 'Final Algebra', 'Hola buen dia, Queria consultar en que aula se tomara el final de \"Elementos de algebra\" del dia 12/12/17', '2017-12-12 13:12:11'),
(2, 7, 2, 2, 'parcial RPyA', 'Queria preguntar si alguien tiene algun simulagro de parcial de años anteriores', '2017-06-21 05:12:06'),
(3, 6, 3, 4, 'Cursado ingles', '¿Que dias se cursa ingles tecnico?', '2017-03-08 11:12:47'),
(4, 4, 1, 1, 'Boleto Estudiantil', '¿Donde se puede hacer el tramite para el boleto estudiantil?.Gracias por su ayuda', '2018-02-21 11:18:16'),
(5, 6, 3, 4, 'Cursado Poo', '¿Que dias se cursa programacion orientada a objetos?', '2017-02-08 12:13:47'),
(6, 4, 1, 1, 'Reintegro', '¿Donde se puede hacer el tramite para el reintegro de dinero?.Saludos', '2018-05-21 12:11:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_cursado`
--

CREATE TABLE `horario_cursado` (
  `id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `aula` varchar(80) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horario_cursado`
--

INSERT INTO `horario_cursado` (`id`, `hora_inicio`, `hora_fin`, `aula`, `id_materia`, `id_dia`) VALUES
(3, '15:00:00', '18:00:00', '106', 10, 2),
(4, '13:00:00', '15:30:00', '105', 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL,
  `descripcion` varchar(125) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `anio_cursada` int(11) NOT NULL,
  `periodo` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id`, `nombre`, `id_carrera`, `anio_cursada`, `periodo`) VALUES
(5, 'Pedagogía', 3, 1, 'Primer Cuatrimestre'),
(6, 'Resolución de Problemas y Algoritmos', 3, 1, 'Primer Cuatrimestre'),
(7, 'Elementos de Álgebra', 3, 1, 'Primer Cuatrimestre'),
(8, ' Introducción a la Computación', 3, 1, 'Primer Cuatrimestre'),
(9, 'Modelos y Sistemas de Información', 3, 1, 'Primer Cuatrimestre'),
(10, ' Elementos de Teoría de la Computación', 3, 1, 'Segundo Cuatrimestre'),
(11, 'Desarrollo de Algoritmos', 3, 1, 'Segundo Cuatrimestre'),
(12, 'Modelado de Datos', 3, 1, 'Segundo Cuatrimestre'),
(13, 'Psicología I', 3, 1, 'Segundo Cuatrimestre'),
(15, 'Mátematica General', 1, 1, 'Segundo Cuatrimestre'),
(16, 'Inglés', 1, 1, 'Segundo Cuatrimestre'),
(17, 'Base de Datos', 1, 1, 'Primer Cuatrimestre'),
(18, 'una materia', 3, 2, 'Primer Cuatrimestre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `id_chat` varchar(11) DEFAULT NULL,
  `id_usuario_remitente` int(11) NOT NULL,
  `id_usuario_destino` int(11) NOT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL,
  `visto` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `id_chat`, `id_usuario_remitente`, `id_usuario_destino`, `texto`, `fecha`, `visto`) VALUES
(28, '1_7', 1, 7, 'Hola', '2018-06-09 19:40:30', 1),
(29, '1_7', 7, 1, 'Hola, que tal?', '2018-06-09 19:53:17', 7),
(30, '1_7', 1, 7, 'Bien y vos?', '2018-06-09 22:15:13', 1),
(31, '1_7', 7, 1, 'Que necesitas flaco, estoy ocupado', '2018-06-09 22:17:01', 7),
(32, '2_7', 7, 2, 'Capo, me ayudas con la tarea de coso', '2018-06-09 22:18:17', 7),
(33, '3_7', 7, 3, 'Buenas noches señor Perez', '2018-06-09 22:22:10', 7),
(34, '1_7', 1, 7, 'ehh somo amigo o no somo amigo?', '2018-06-09 22:22:59', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_leido`
--

CREATE TABLE `mensaje_leido` (
  `id` int(11) NOT NULL,
  `id_chat` varchar(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensajes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje_leido`
--

INSERT INTO `mensaje_leido` (`id`, `id_chat`, `id_usuario`, `mensajes`) VALUES
(1, '1_7', 7, 1),
(2, '1_7', 1, 0),
(3, '2_7', 2, 1),
(4, '3_7', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL,
  `copete` varchar(150) DEFAULT NULL,
  `imagen` varchar(256) DEFAULT NULL,
  `alt` varchar(256) DEFAULT NULL,
  `importante` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `id_usuario`, `id_estado`, `titulo`, `texto`, `fecha`, `copete`, `imagen`, `alt`, `importante`) VALUES
(3, 1, 6, 'Los mejores cursos universitarios online gratis de junio', 'La gran mayoría están en español y son dictados por instituciones universitarias de España y Latinoamérica, aunque encontrarás otros en inglés (algunos con subtítulos en español). Todas las ofertas son gratuitas, en algunos casos deberás pagar solo si quieres un certificado por haber completado el programa.\r\n\r\nCiencias\r\nIntroducción a Data Science: Programación Estadística con R (Universidad Nacional Autónoma de México): Este curso busca introducirte en el lenguaje de programación estadística R, un lenguaje computacional diseñado para el análisis estadístico de datos.\r\nIntroducción a Java (Universidad Nacional Autónoma de México): Este es un curso introductorio a la programación en Java. Como Java es un lenguaje orientado a objetos de propósito general, revisarás los conceptos básicos del lenguaje como clases e interfaces. Además verás los ingredientes básicos de una clase como constantes y variables, funciones (métodos), y cómo organizar estos ingredientes dentro de una clase.\r\nIntroducción a la programación en Python I: Aprendiendo a programar con Python (Pontificia Universidad Católica de Chile): Este curso te introduce en el mundo de la programación en el lenguaje Python. De una forma práctica, aprenderás de forma gradual desde el tratamiento básico de variables hasta la programación de algoritmos para construir tus propios juegos. Además, te familiarizarás con los conceptos fundamentales para el desarrollo de algoritmos y su programación.\r\nLa Web Semántica: Herramientas para la publicación y extracción efectiva de información en la Web (Pontificia Universidad Católica de Chile): aprenderás los conceptos fundamentales de la Web Semántica y sus principales ecnologías, y aprenderás a desarrollar tus propias aplicaciones utilizando las tecnologías de la Web Semántica.\r\n\r\nDetección de objetos (Universitat Autònoma de Barcelona): En este curso te introducirás en los principios básicos de cualquier sistema automático de detección y reconocimiento de objetos en imágenes.\r\n\r\nDiseño centrado en humanos: una introducción (University of California San Diego): en este curso en inglés con subtítulos en español, aprenderás cómo diseñar tecnologías que traigan alegría a la gente, el objetivo es inculcar estrategias enfocadas en diseño para crear interfaces alternativas y diseñar más centrado en las personas.\r\n\r\n¿Cómo (nos) cambia la Tecnología? (Universidad de Chile): Este curso es para personas curiosas por la tecnología, aquellos que tienen interés en ir más allá de dispositivos y artefactos y se hacen preguntas sobre como las sociedades, naciones, comunidades y personas transforman y son transformadas por sistemas y artefactos.\r\n\r\nClasificación de imágenes: ¿cómo reconocer el contenido de una imagen? (Universitat Autònoma de Barcelona): En este curso aprenderás diferentes métodos de representación y clasificación de imágenes. Podrás conocer el esquema básico de clasificación de imágenes conocido como Bag of Visual Words. A partir de este esquema básico aprenderás cómo utilizar varios descriptores locales de la imagen así como los métodos de clasificación más habituales.\r\n\r\nFísica: Dimensión y Movimiento (Universidad de Monterrey): Este curso forma parte de una secuencia y, no sólo te preparará para la física universitaria, sino que al mismo tiempo te sensibilizará para poder comprender y asimilar fenómenos y resolver problemas de la vida cotidiana.\r\n\r\nUna introducción a la programación interactiva con Python (Rice University): Este curso está en inglés pero tiene subtítulos en español. Tiene dos partes y está diseñado para ayudar a estudiantes con oco o ningún conocimiento en computación a aprender lo básico para construir aplicaciones interactivas simples.\r\nLa guía de un desarrollador para el Internet de las cosas (IBM): otro curso en inglés con subtítulos en español. Es un curso introductorio para desarrollar soluciones para el Internet de las cosas.\r\nIntroducción a la programación orientada a objetos en Java (Universidad de los Andes): Este curso está orientado principalmente a personas interesadas en conocer y profundizar sobre el lenguaje de la programación en Java para la creación y manipulación de objetos.\r\nSistemas Digitales: De las puertas lógicas al procesador (Universitat Autònoma de Barcelona): aprenderás os fundamentos del diseño de los circuitos digitales actuales, siguiendo una orientación eminentemente práctica.\r\nProyecto final - Construyendo una aplicación profesional con Android (Universidad Nacional Autónoma de México): En este curso, no sólo deberás desarrollar tu aplicación móvil sino que, ésta, contribuirá a la mejora de tu ciudad, de tu país o del mundo.\r\nEmprendimiento y métodos ágiles de desarrollo en videojuegos: en este curso obtendrás entendimiento de los conceptos básicos de emprendimiento y serás capaz de aplicar SCRUM, un marco ágil de producción que es utilizado ampliamente a nivel profesional, a cualquier proyecto de desarrollo de videojuegos que quieras emprender o, incluso, a cualquier otro tipo de proyectos.\r\nArduino y algunas aplicaciones: A través de las actividades y material didáctico de este curso aprenderás a aplicar la tarjeta Arduino y podrás adquirir y reforzar nociones básicas de programación, utilizando una herramienta de fácil acceso, que te permitirá además elaborar posteriores proyectos de tu interés.\r\nOrtodoncia: tratamientos dentales sencillos para casos complejos (Pontificia Universidad Javeriana): Aprende alternativas terapéuticas diferentes y eficientes para el tratamiento de casos complejos en ortodoncia, debido a las limitaciones biológicas, biomecánicas, funcionales y estéticas.', '2018-06-10 22:29:41', 'La gran mayoría están en español y son dictados por instituciones universitarias de España y Latinoamérica.', 'archivos/noticias/3.jpg', 'Los mejores cursos universitarios online gratis de junio', 1),
(4, 1, 6, 'La última metedura de pata de Facebook hizo públicas las publicaciones de 14 millones de usuarios', 'Últimamente parece que cada semana hay un escándalo de Facebook relacionado con la privacidad. Esta semana, de hecho, llevamos varios: primero conocimos que compartió datos de usuarios con importantes compañías de tecnología y hoy descubrimos que ha vuelto a meter la pata.\r\n\r\nEsta vez, la red social reconoció que un error hizo que las publicaciones de 14 millones de usuarios se volvieran públicas por defecto. Esta configuración estuvo activa durante cuatro días, del 18 al 24 de mayo.\r\n\r\nTardaron varios días en solucionarlo\r\nErin Egan, responsable de la privacidad en Facebook, aseguró que \"recientemente encontraron un error que automáticamente sugería hacer públicas las publicaciones\" para algunos usuarios.\r\n\r\nPor si fuera poco, las publicaciones no volvieron a regresar a su ajuste de privacidad predeterminado hasta el día 27 de mayo. Los usuarios afectados han recibido un mensaje informando que \"por favor revisen sus publicaciones\" y un enlace a una lista con lo que publicaron durante esos días.\r\nUn portavoz de Facebook afirmó que esta notificación es el comienzo de una nueva manera más proactiva y transparente de gestionar este tipo de problemas, informando al usuario de lo que ha ocurrido y cómo puede remediarlo.\r\n\r\nPor defecto, cuando vas a crear una nueva publicación, Facebook tiene activada la configuración de privacidad que elegiste en tu anterior publicación. Esto falló para 14 millones de usuarios, que tenían marcada por defecto la opción \"pública\".', '2018-06-10 22:45:45', 'Últimamente parece que cada semana hay un escándalo de Facebook relacionado con la privacidad. Esta semana, de hecho, llevamos varios: primero conocim', 'archivos/noticias/4.jpg', 'La última metedura de pata de Facebook hizo públicas las publicaciones de 14 millones de usuarios', 1),
(5, 1, 6, 'Steam aceptará \"todos\" los juegos, siempre que no sean \"ilegales o para trollear\"', 'Valve ha anunciado que no eliminará más juegos de Steam, a no ser que sean \"ilegales\" o busquen \"trollear\" a los consumidores o a la propia plataforma.\r\n\r\nEste cambio llega después de varias semanas en las que ha habido bastante polémica, ya que eliminaron un juego sobre tiroteos en institutos y hubo mucha confusión acerca de las políticas de la plataforma sobre los juegos que muestran sexo explícito.\r\n\r\nDecides tú, no nosotros\r\nEn la entrada con la que anuncian este cambio, Eric Johnson (líder de desarrollo de negocios de Valve) asegura que la compañía \"no debe ser la encargada de decidir esto\":\r\n\r\n\"Si tu eres un jugador, no debemos decidir por ti qué contenido puedes o no puedes comprar. Si tu eres un desarrollador, nosotros no debemos elegir qué contenido te está permitido crear\".\r\n\r\nContinúa afirmando que el papel de la compañía debe ser \"proveer sistemas y herramientas para dar apoyo a la hora de que tú seas el que hace la elección, ayudándote a que lo realices de una manera que te haga sentir cómodo\".\r\n\"Entonces, ¿qué significa esto? Significa que la tienda de Steam va a contener cosas que odias y que piensas que no deberían existir. A no ser que no tengas opinión, te garantizo que ocurrirá. Pero al mismo tiempo verás cosas en la tienda que tu crees que deberían estar ahí, y seguro que otras personas las odiarán y creerán que no deberían existir\".', '2018-06-10 22:49:17', 'Valve ha anunciado que no eliminará más juegos de Steam, a no ser que sean \"ilegales\" o busquen \"trollear\" a los consumidores o a la propia plataforma', 'archivos/noticias/5.jpg', 'Steam aceptará \"todos\" los juegos, siempre que no sean \"ilegales o para trollear\"', 1),
(6, 1, 6, 'Ya es oficial: Microsoft compra GitHub por 7.500 millones de dólares', 'En las últimas horas los datos apuntaban a una opción que finalmente se ha confirmado: Microsoft adquiere GitHub, y lo hace por 7.500 millones de dólares, una de las operaciones económicas más costosas de su historia.\r\n\r\nEl mensaje oficial de confirmación de Microsoft habla de cómo este acuerdo \"refuerza nuestro compromiso con la libertad, apertura e innovación para los desarrolladores\". GitHub mantendrá su marca y operará de forma independiente.\r\n\r\nUna adquisición económicamente muy importante\r\nAlgunos datos previos apuntaban a cómo la valoración de GitHub era de unos 2.000 millones de dólares en tiempos recientes, pero finalmente el coste de la adquisición ha sido casi cuatro veces superior al de aquella estimación a la que apuntaban por ejemplo en la exclusiva de ayer de Bloomberg.\r\nLa operación es la tercera adquisición más importante en cuanto al montante económica de la misma. Microsoft pagó 26.200 millones de dólares por LinkedIn en diciembre de 2016 y 8.500 millones de dólares por SKype en mayo de 2011.\r\n\r\nOtras adquisiciones como las de Nokia (7.200 millones de dólares) en septiembre de 2013 y aQuantive (6.333 millones de dólares) en agosto de 2007) se sitúan en ese ránking de operaciones de adquisición de Microsoft a lo largo de su historia.', '2018-06-10 22:58:06', 'En las últimas horas los datos apuntaban a una opción que finalmente se ha confirmado: Microsoft adquiere GitHub, y lo hace por 7.500 millones de dóla', 'archivos/noticias/6.jpg', 'Ya es oficial: Microsoft compra GitHub por 7.500 millones de dólares', 1),
(7, 1, 6, 'YouTube está mostrando anuncios anti-LGBT en los canales de creadores LGBT', 'Primero fue el modo restringido de YouTube filtrando contenido LGBT completamente inofensivo por lo que la empresa terminó pidiendo perdón, y al mismo tiempo un sinfín de creadores LGBT comenzaron a quejarse también porque la empresa ha quitado la monetización de sus vídeos por razones que nadie entiende.\r\n\r\nTodo tiene que ver con los esfuerzos de la empresa para hacer de YouTube una plataforma \"segura para los anunciantes\" pero que no para de verse cada vez más discriminatoria, especialmente ahora que anuncios de una organización anti-LGBT considerada como un grupo de odio extremista, han estado apareciendo en los vídeos de la plataforma.\r\n\r\nMúltiples usuarios en redes sociales y varios creadores han expresado su malestar por la situación. Se trata de un vídeo publicitario anti LGBTQ+ de un firma legal llamada \"Alliance Defending Freedom\" que ha luchado contra el matrimonio igualitario, el derecho a la adopción por parte de parejas del mismo sexo, y que se han inmiscuido en el debate sobre el uso de los baños por personas transgénero en EEUU.\r\n\r\n \r\n\r\nShannon Taylor\r\n@HeyThereImShan\r\n Hey @TeamYouTube do you mind explaining why I’m receiving LITERAL ANTI-LGBT organization advertisements now? (Yep, with a donation link)\r\n\r\nI thought the whole point was to keep the site “non-political” & the videos “advertised friendly”.\r\n\r\nWhat even is this garbage?\r\n\r\n16:00 - 29 may. 2018\r\n2.016\r\n893 personas están hablando de esto\r\nInformación y privacidad de Twitter Ads\r\nEn el tuit de arriba, la youtuber Shannon Taylor muestra el anuncio y expresa su molestia diciendo \"¿Cómo es esto posible cuando YouTube bloquea canales LGBT como el mío?\". Le pide a YouTube que le explique por qué está recibiendo publicidad de organizaciones literalmente anti-LGBT con todo y enlace a donación: \"Creí que el objetivo era mantener el sitio \'apolítico\' y los vídeos \'adecuados para anunciantes\' ¿qué es esta porquería?\"\r\n\r\nAlgunos fans han visto la publicidad en canales no relacionados como BuzzFeed News, o el canal de Samantha Bee, mientras que usuarios LGBT se preguntan cosas sobre cómo es que YouTube les muestra esta publicidad mientras ven el canal de PweDiePie y además son gay.\r\nMás perturbador aún es el anuncio que reporta el usuario Jace Aarons antes del vídeo del canal de YouTube del creador creador transgénero Chase Ross. Justo antes de un vídeo en el que el youtuber compara su situación emocional antes y después de su operación, YouTube inserta propaganda religiosa en la que alguien explica cómo ser gay es un pecado.', '2018-06-10 23:12:43', 'Primero fue el modo restringido de YouTube filtrando contenido LGBT completamente inofensivo por lo que la empresa terminó pidiendo perdón, y al...', 'archivos/noticias/7.jpg', 'YouTube está mostrando anuncios anti-LGBT en los canales de creadores LGBT', 1),
(8, 1, 6, 'La UNCo tendrá segunda vuelta en la carrera por el rectorado', 'La Universidad Nacional del Comahue irá a segunda vuelta en sus elecciones por el rectorado tras conocerse anoche los resultados finales de la primera ronda.\r\n\r\nEn esta oportunidad, el actual rector Gustavo Crisafulli con la lista \"Convergencia Universitaria\" enfrentará el ballotage contra Adriana Giuliani que encabeza \"Construir UNC\".\r\n\r\nEn un primer análisis sobre el escrutinio, Crisafulli obtuvo la mayoría de los votos entre el claustro de docentes, graduados/as y no docentes, mientras que los/as estudiantes apoyaron a la candidata por la lista \"Encuentro para cambiar la UNC\", Inés Trpin, quien ocupó el tercer lugar en los resultados finales.\r\n\r\nSegún la información publicada por la institución educativa, la segunda vuelta se realizará el próximo 2, 4 y 5 de junio, y sólo se votará para rectorado salvo en la Facultad de Ciencias de la Educación donde también elegirán para el decanato.\r\n\r\nEn tanto, el 6 de junio se publicará el escrutinio provisorio, mientras que el jueves se conocerán los resultados finales. El 12 de junio asumirá el nuevo rector o rectora.\r\n\r\n\"Fue una elección muy buena. Ganamos en las facultades grandes y en los asentamientos chicos. Ganamos con buen margen en el claustro docente y no docente y mantuvimos el Consejo Superior\", indicó Crisafulli, en diálogo con LU5.\r\n\r\nEn total, participaron de la elección 186 listas que involucró a más de 1.100 electores y hubo más de 30 mil personas habilitadas para votar, distribuidas de la siguiente forma: 9.485 por el claustro estudiantil, 2.506 por el claustro docente, 17.480 por el claustro de graduados y 718 por el claustro no docente.\r\n\r\nLas cinco fórmulas que compitieron para el rectorado son: Gustavo Crisafulli y Adriana Caballero (Convergencia Universitaria); Inés Trpin y Lorena Higuera (ECU-Encuentro Para Cambiar la UNCo); Sergio Bramardi y Omar Jurgeit (Pluralismo e Institucionalidad); Adriana Giuliani y Víctor Baez (Construir UNCo) y Claudio Vaucheret y Eduardo Aisen (Movimiento Académico Interclaustro).', '2018-06-10 23:19:10', 'Gustavo Crisafulli y Adriana Giuliani se disputarán el mayor cargo de la institución educativa. Se realizarán los primeros días de junio.', 'archivos/noticias/8.jpg', 'La UNCo tendrá segunda vuelta en la carrera por el rectorado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasantia`
--

CREATE TABLE `pasantia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tarea` varchar(255) NOT NULL,
  `requisito` text,
  `ubicacion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_limite` date DEFAULT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasantia`
--

INSERT INTO `pasantia` (`id`, `titulo`, `tarea`, `requisito`, `ubicacion`, `fecha_inicio`, `fecha_fin`, `fecha_limite`, `id_estado`) VALUES
(1, 'Desarrollador Web', 'Dar soporte a la pagina web de la unco', 'Se necesita un tecnico en desarrollo web que tenga experiencia', 'Unco - Neuquén', '2018-07-01', '2019-04-01', '2018-06-30', 4), 
(2, 'Subsecretaría de Tecnologías de la Información - UNCo', 'Dar soporte a la aplicación Gukena (Centro de Cómputos)', 'Ser alumno avanzado de la carrera por la cual aplica.\r\nTener conocimientos de php, html, javascript, CSS-TOBA (no excluyente)', 'Rectorado UNCo - Bs As 1400.', '2018-04-01', '2018-06-30', '2018-03-15', 5), 
(3, 'Facultad de Informática – Departamento de Ingeniería de Sistemas', 'Formar parte de un equipo de desarrollo de software, con el objetivo de diseñar e implementar un sistema web de gestión.', 'Tener cursadas las materias “Diseño de Bases de Datos” y “Arquitecturas de Software” (excluyente)\r\nConocimientos de Desarrollo Web en JavaScript/TypeScript y tecnologías relacionadas (Node.js, Angular 2/4/5 , MongoDB) (no excluyente)\r\nExperiencia de trabajo en equipo con metodologías ágiles (SCRUM o similar) (no excluyente)\r\nHerramienta para control de versiones GIT (no excluyente)', 'Departamento de Ingeniería de Sistemas, Facultad de Informática – UNComa - Neuquén', '2018-07-01', '2019-02-28', '2018-06-15', 4), 
(4, 'Editorial Rio Negro S.A', 'Desarrollado de aplicaciones web (Front End). Utilizando PHP y JScript Desarrollo de aplicaciones Web (Back end) Desarrollo de aplicaciones mobile Andorid (en un futuo IOS) Gestión de versiones en Github Integración continua utilizando Jenkins. El objetiv', 'Tener aprobado el 50 % de la carrera.', 'Editorial Río Negro SA (Mtro. Joaquín González 290 – Neuquén)', '2018-07-01', '2019-06-30', '2018-06-25', 4); 

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta`
--

CREATE TABLE `propuesta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(125) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `respuesta` text,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_foro`
--

CREATE TABLE `respuesta_foro` (
  `id` int(11) NOT NULL,
  `id_foro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL,
  `permiso_rol` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`, `permiso_rol`) VALUES
(1, 'Administrador de Base de Datos', '{\"f\":\"r-w\",\"n\":\"r-w\",\"p\":\"r-w\",\"i\":\"r-w\",\"u\":\"r-w\",\"c\":\"r-w\",\"m\":\"r-w\",\"e\":\"r-w\"}'),
(2, 'Administrador de Bienestar', '{\"i\":\"r-w\"}'),
(3, 'Administrador Academico', '{\"f\":\"r-w\",\"p\":\"r-w\",\"c\":\"r-w\",\"m\":\"r-w\"}'),
(4, 'Administrador de Prensa y Discusion', '{\"n\":\"r-w\",\"p\":\"r-w\",\"c\":\"r-w\",\"e\":\"r-w\"}'),
(5, 'Usuario', '{}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion_foro`
--

CREATE TABLE `suscripcion_foro` (
  `id` int(11) NOT NULL,
  `id_foro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion_noticia`
--

CREATE TABLE `suscripcion_noticia` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'Foro'),
(2, 'Noticia'),
(3, 'Pasantia'),
(4, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `legajo` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `alt` varchar(256) DEFAULT NULL,
  `authKey` varchar(250) DEFAULT NULL,
  `idrol` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `legajo`, `email`, `password`, `imagen`, `alt`, `authKey`, `idrol`, `id_estado`) VALUES
(1, 'santiago', 'bravo', 'fai2323', 'santiagoBravo@gmail.com', '26148d621ef74844918af182d63976b6', 'archivos/usuario/1.png', NULL, '1111kuhd3', 1, 6),
(2, 'Ricardo', 'Arriagada', 'fai111', 'ricardoarriagada@gmail.com', 'db26ee047a4c86fbd2fba73503feccb6', 'archivos/usuario/2.jpg', NULL, '1111kuhd3', 2, 6),
(3, 'Ámbar', 'Perez', 'fai2211', 'ambarperez@gmail.com', '62c428533830d84fd8bc77bf402512fc', 'archivos/usuario/2.jpg', NULL, '1111kuhd3', 2, 6),
(4, 'Agustin', 'Ponce', 'fai3212', 'agustinponce@gmail.com', '62c428533830d84fd8bc77bf402512fc', 'archivos/usuario/3.png', NULL, '1111kuhd3', 3, 6),
(5, 'Sol', 'Lopez', 'fai1232', 'sollopez@gmail.com', '54a2bf8c09ace67d3513aaa1aa7aa0f3', 'archivos/usuario/2.jpg', NULL, '1111kuhd3', 4, 6),
(6, 'Azul', 'Gómez', 'fai2933', 'azulgomez@gmail.com', '4e42f7dd43ecbfe104de58610557c5ba', 'archivos/usuario/1.png', NULL, '1111kuhd3', 5, 6),
(7, 'Ricardo', 'Fuentealba', 'fai8323', 'mateonavarro@gmail.com', 'f970e2767d0cfe75876ea857f92e319b', 'archivos/usuario/7.png', NULL, '1111kuhd3', 5, 6),
(12, 'Universidad', 'del Comahue', 'FAI-816', 'mauro.sosa@est.fi.uncoma.edu.ar', 'da2095b287cd7add01d63933d7ec428d', 'archivos/usuario/12.png', NULL, '2PMYYBGR9J', 5, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_foro`
--
ALTER TABLE `categoria_foro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indices de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `cursada_id` (`cursada_id`),
  ADD KEY `aprobada_id` (`aprobada_id`);

--
-- Indices de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_dia` (`id_dia`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_remitente` (`id_usuario_remitente`),
  ADD KEY `id_usuario_destino` (`id_usuario_destino`);

--
-- Indices de la tabla `mensaje_leido`
--
ALTER TABLE `mensaje_leido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `pasantia`
--
ALTER TABLE `pasantia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comentario` (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `respuesta_foro`
--
ALTER TABLE `respuesta_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_foro` (`id_foro`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripcion_foro`
--
ALTER TABLE `suscripcion_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_foro` (`id_foro`);

--
-- Indices de la tabla `suscripcion_noticia`
--
ALTER TABLE `suscripcion_noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_foro`
--
ALTER TABLE `categoria_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `mensaje_leido`
--
ALTER TABLE `mensaje_leido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pasantia`
--
ALTER TABLE `pasantia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_foro`
--
ALTER TABLE `respuesta_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `suscripcion_foro`
--
ALTER TABLE `suscripcion_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suscripcion_noticia`
--
ALTER TABLE `suscripcion_noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD CONSTRAINT `correlativa_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `correlativa_ibfk_2` FOREIGN KEY (`cursada_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `correlativa_ibfk_3` FOREIGN KEY (`aprobada_id`) REFERENCES `materia` (`id`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_foro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  ADD CONSTRAINT `horario_cursado_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `horario_cursado_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `dia_semana` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_usuario_remitente`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`id_usuario_destino`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noticia_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pasantia`
--
ALTER TABLE `pasantia`
  ADD CONSTRAINT `pasantia_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD CONSTRAINT `propuesta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta_foro`
--
ALTER TABLE `respuesta_foro`
  ADD CONSTRAINT `respuesta_foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuesta_foro_ibfk_2` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suscripcion_foro`
--
ALTER TABLE `suscripcion_foro`
  ADD CONSTRAINT `suscripcion_foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suscripcion_foro_ibfk_2` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suscripcion_noticia`
--
ALTER TABLE `suscripcion_noticia`
  ADD CONSTRAINT `suscripcion_noticia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
