
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta content='width=device-width, initial-scale=1' name='viewport'>
<meta content='IE=edge' http-equiv='X-UA-Compatible'>
<link href='/apple-touch-icon.png' rel='apple-touch-icon' sizes='180x180'>
<link rel="icon" type="image/png" href="logo.png" />
<link href='/manifest.json' rel='manifest'>
<meta name="google-site-verification" content="a7xjGWAnkqJ3ycjctaNTlmm5dMhwz_vbb-9fNo2VFss" />
<meta content='#282c37' name='theme-color'>
<meta content='yes' name='apple-mobile-web-app-capable'>
<title>Mastodon Portal</title>
<link rel="stylesheet" media="all" href="style.css" />
    <script src="mastodon.js"></script>

<meta content='Mastodon' property='og:site_name'>
<meta content='website' property='og:type'>
<meta content='mastodon Portal' property='og:title'>
<meta content='Mastodon is a free, open-source social network server. A decentralized alternative to commercial platforms, it avoids the risks of a single company monopolizing your communication. Anyone can run Mastodon and participate in the social network seamlessly' property='og:description'>
<meta content='mastodon_logo.jpg' property='og:image'>
<meta content='400' property='og:image:width'>
<meta content='400' property='og:image:height'>
<meta content='summary' property='twitter:card'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
#foo {
    position: absolute;
    display: none;
    background: #14161C;
  height: 310px;
  width: 15em;
  border-radius: 7px;
}
        </style>

</head>
<?php
    function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
    
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $dochtml = new DOMDocument();
    $dochtml->loadHTMLFile("http://instances.mastodon.xyz/");
    $time = true;
    $time2 = 0;
    $instancelist = [];
    $usercount = 0;
    while($time == true){
        
        try{
            $tr = $dochtml->getElementsByTagName('tr')[$time2]->nodeValue;
            if(strpos($tr, 'Uptime') !== false){
                
            }else if($tr == null){
                break;
                $time = false;
            }else{
                $content = explode("\n", $tr);
                $content[1] = preg_replace('/\s/', '', $content[1]);
                $content[2] = preg_replace('/\s/', '', $content[2]);
                $content[3] = preg_replace('/\s/', '', $content[3]);
                $int = (int) preg_replace('/\D/', '', $content[2]);
                $usercount = $usercount + $int;
                if($content[0] == "UP" && $content[3] == "Yes"){
                    array_push($instancelist, $content[1]);
                }
            }
        }catch (Exception $e) {
            break;
            $time = false;
            echo "ERREUR : "+$e;
        }
        
        $time2++;
        
        
    }
    $k = array_rand($instancelist);
    $instancechoosed = $instancelist[$k];
    
    $abouthtml = file_get_contents("http://".$instancechoosed."/about/more");
    $connectedinstances = get_string_between($abouthtml, '<span>Connected to</span>', '</strong>');
    $connectedinstances = preg_replace('/\s/', '', $connectedinstances);
    $connectedinstances = preg_replace('<strong>', '', $connectedinstances);
    $connectedinstancesint = (int) preg_replace('/\D/', '', $connectedinstances);
    $connectedinstancesStatus = null;
    if($connectedinstancesint >= 60){
        switch ($lang){
    case "fr":
        $connectedinstancesStatus = "".$instancechoosed." est connectée à ".$connectedinstancesint." instances. Cette instance est considérée viable parce qu'elle est connectée à plus de 60 autres instances.";
        break;
    case "es":
        $connectedinstancesStatus = "".$instancechoosed." está conectada en ".$connectedinstancesint." instancias. Esta instancia se considera viable porque está conectada a más de 60 instancias.";
        break;        
    default:
        $connectedinstancesStatus = "".$instancechoosed." is connected at ".$connectedinstancesint." instances. This instance is considered viable because it is connected to more than 60 other instances.";
        break;
}
        
    }else{
        switch ($lang){
    case "fr":
        $connectedinstancesStatus = "".$instancechoosed." est connectée à ".$connectedinstancesint." instances. Une instance est considérée comme viable si elle est connectée à plus de 60 autres instances. Nous vous proposons donc de demander une autre instance.";
        break;
    case "es":
        $connectedinstancesStatus = "".$instancechoosed." está conectada en ".$connectedinstancesint." instancias.Una instancia se considera viable si está conectada a más de 60 otras instancias. Por lo tanto, proponemos que usted pida otra instancia.";
        break;        
    default:
        $connectedinstancesStatus = "".$instancechoosed." is connected at ".$connectedinstancesint." instances. An instance is considered viable if it is connected to more than 60 other instances. We therefore propose that you ask for another instance.";
        break;
}
    }
    
    ?>
<body class='about-body' onload="begin()">
<div class='wrapper'>
<h1>
<img src="logo.png" alt="Logo" />
Mastodon Portal
</h1>
    <?php
    switch ($lang){
    case "fr":
        echo "<p>Mastodon est un réseau social <em>gratuit et open source</em>. Une alternative <em>décentralisée</em> aux plates-formes commerciales, elle évite les risques d'une seule société qui monopolise vos communications. Choisissez un serveur dont vous avez confiance. Selon votre choix , vous pouvez interagir avec tous les autres ou non. N'importe qui peut exécuter sa propre instance de Mastodon et participer au <em>réseau social</em> de façon transparente.<br>Sur mastodon un serveur s'appelle une instance<br>Mastodon Portal vérifie que l'instance qui vous est proposée est accessible et qu'il est possible d'y créer un compte.<br>Lorsque vous cliquerez sur <em>Commencer</em> vous serez redirigé directement sur l'instance choisie.<br>Mastodon Portal vous propose l'instance ".$instancechoosed.".<br>Si pour vous, le fonctionnement de ce réseau social est encore un mystère, Nous vous invitons à lire l'article de <a style=\"text-decoration: none;\" href=\"http://numerama.com\" >Numerama </a> en cliquant <a style=\"text-decoration: none;\" href=\"http://www.numerama.com/tech/246684-debuter-sur-mastodon-9-questions-pour-tout-comprendre-au-reseau-social-decentralise.html\">ici</a></p>.";
        break;
    case "it":
        echo "<p>Mastodon è un social networking <em>libero e open source</em>. Un <em>decentrata</em> alternativa alle piattaforme commerciali, evita il rischio di una singola azienda che monopolizza le vostre comunicazioni. Scegli un server di fiducia. A seconda della scelta, è possibile interagire con tutti gli altri oppure no. Chiunque può eseguire la propria istanza di Mastodon e partecipare nella <em>rete sociale</em> senza soluzione di continuità.<br>Mastodon su un server si chiama un'istanza<br>Mastodon Portal controlla che un'istanza che viene offerto è disponibile ed è possibile creare un account.<br>Quando si fa clic <em>Cominciare</em>, sarai portato direttamente all'istanza selezionata.<br>Mastodon portal propone l'istanza ".$instancechoosed." .</p>";
        break;
    case "es":
        echo "<p>Mastodon es una red social <em>gratuita y de código abierto</em>. Una alternativa <em>descentralizada</em> a las plataformas comerciales, se evita el riesgo de una única empresa que monopoliza sus comunicaciones. Elegir un servidor de confianza. Dependiendo de su elección, se puede interactuar con todos los demás o no. Cualquiera puede ejecutar su propia instancia de Mastodon y participar en la <em>red social</em> sin problemas.<br>En Mastodon el servidor se llama una instancia<br>Mastodon Portal comprueba que una instancia que se ofrece está disponible y es posible crear una cuenta.<br> Al hacer clic en <em>Inicio</em>, usted será llevado directamente a la instancia seleccionada.<br>Mastodon Portal propone la instancia ".$instancechoosed." .</p>";
        break;        
    default:
        echo "<p>Mastodon is a <em>free, open-source</em> social network. A <em>decentralized</em> alternative to commercial platforms, it avoids the risks of a single company monopolizing your communication. Pick a server that you trust &mdash; whichever you choose, you can interact with everyone else. Anyone can run their own Mastodon instance and participate in the <em>social network</em> seamlessly.<br>On mastodon a server is called an instance<br>Mastodon Portal verifies that the instance that is proposed to you is accessible and that it is possible to create an account there.<br>When you click <em>Get Started</em> you will be redirected directly to the selected instance.<br>Mastodon Portal proposes the instance ".$instancechoosed." .</p>";
        break;
}
    echo "<br>";
    switch ($lang){
    case "fr":
        echo "<p><em>Description de l'instance</em></p>";
        break;
    case "es":
        echo "<p><em>Descripción de la instancia</em></p>";
        break;        
    default:
        echo "<p><em>Description of the instance</em></p>";
        break;
}
    echo "<p><strong>".$connectedinstancesStatus."</strong></p>";
    
    ?>
<div class='screenshot-with-signup'>
<div class='mascot'><img src="fluffy%20elephant%20friend.png" alt="Fluffy elephant friend" /></div>
<div novalidate="novalidate" class="simple_form new_user">
    <div class="input string required user_account_username">
        <?php
        echo '<input aria-label="Instance" class="string required" placeholder="Instance" type="text" value="'.$instancechoosed.'" name="instance" id="user_account_attributes_instance" />';
        
        ?>
    </div>
<div class='actions'>
<?php
    echo '<form action="https://'.$instancechoosed.'"><button class="btn">';
    switch ($lang){
    case "fr":
        echo "Commencer";
        break;
    case "it":
        echo "Cominciare";
        break;
    case "es":
        echo "Inicio";
        break;        
    default:
        echo "Get Started";
        break;
}
    echo '</button></form><form action="/"><button class="btn">';
    switch ($lang){
    case "fr":
        echo "Une autre SVP";
        break;
    case "it":
        echo "Un altro si prega";
        break;
    case "es":
        echo "Una autra, por favor";
        break;        
    default:
        echo "Another please";
        break;
}
    echo '</button></form><form action="https://'.$instancechoosed.'/about/more"><button class="btn">';
    switch ($lang){
    case "fr":
        echo "en savoir plus";
        break;
    case "it":
        echo "più";
        break;
    case "es":
        echo "saber más";
        break;        
    default:
        echo "Read more";
        break;
}
    ?>

</div>
</div></div>
<?php
    switch ($lang){
    case "fr":
        echo "<p>Mastodon compte actuellement ".$usercount." utilisateurs.</p>";
        break;
    case "it":
        echo "<p>Mastodon ha attualmente ".$usercount." utenti.</p>";
        break;
    case "es":
        echo "<p>Mastodon tiene actualmente ".$usercount." usuarios.</p>";
        break;        
    default:
        echo "<p>Mastodon currently has ".$usercount." users.</p>";
        break;
}
    
    switch ($lang){
    case "fr":
        echo "<p><em>Ce qui distingue Mastodon</em></p>";
        break;
    case "it":
        echo "<p><em>Ciò che distingue Mastodon a parte</em></p>";
        break;
    case "es":
        echo "<p><em>Lo que distingue a Mastodon</em></p>";
        break;        
    default:
        echo "<p><em>What sets Mastodon apart</em></p>";
        break;
}
    
?>
<div class='features-list'>
<div class='features-list__column'>
<ul class='fa-ul'>
<li>

<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
<?php
    
    switch ($lang){
    case "fr":
        echo "<p>Les timelines sont chronologiques</p>";
        break;
    case "it":
        echo "<p>Timelines sono cronologico</p>";
        break;
    case "es":
        echo "<p>Los timelines son cronológicos</p>";
        break;        
    default:
        echo "<p>Timelines are chronological</p>";
        break;
}
    
?>
</li>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
    <?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">La timeline public</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">Timelines pubblici</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\">timelines públicas</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">Public timelines</p>";
        break;
}
    
?>
</li>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
    <?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">500 caractères par message</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">500 caratteri per post</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\"500 caracteres por publicación</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">500 characters per post</p>";
        break;
}
    
?>
</li>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
    <?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">GIF animé et vidéos courtes</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">GIF animati e brevi video</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\">GIF animados y vídeos de corta duración</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">GIFV sets and short videos</p>";
        break;
}
    
?>
</li>
</ul>
</div>
<div class='features-list__column'>
<ul class='fa-ul'>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
    <?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">Paramètres de confidentialité par message</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">Paramètres riservatezza par messaggio</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\">Parámetros de confidencialidad por mensaje</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">Granular, per-post privacy settings</p>";
        break;
}
    
?>
</li>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
    <?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">Messages riches et possibilité de mettre sous silence</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">Paramètres riservatezza par messaggio</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\">mensajes ricos y oportunidad de silencio</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">Rich block and muting tools</p>";
        break;
}
    
?>
</li>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
    <?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">Conception éthique: aucune publicité, aucun suivi</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">design etico: nessun annuncio, nessun inseguimento</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\">Diseño ético: sin anuncios, sin seguimiento</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">Ethical design: no ads, no tracking</p>";
        break;
}
    
?>
</li>
<li>
<img src="check.svg" style="height: 1em;width: auto;display:inline-block;">
<?php
    
    switch ($lang){
    case "fr":
        echo "<p style=\"display:inline-block;\">API ouverte pour les applications et les services</p>";
        break;
    case "it":
        echo "<p style=\"display:inline-block;\">Open API per le applicazioni e servizi</p>";
        break;
    case "es":
        echo "<p style=\"display:inline-block;\">API abierta para aplicaciones y servicios</p>";
        break;        
    default:
        echo "<p style=\"display:inline-block;\">Open API for apps and services</p>";
        break;
}
    
?>
</li>
</ul>
</div>
</div>
<div class='actions'>
<div class='info'>
<?php
  echo '<a href="https://'.$instancechoosed.'/terms">Terms</a>'; 
    echo '·';
?>
<a href="https://github.com/tootsuite/mastodon/blob/master/docs/Using-Mastodon/Apps.md">Apps</a>
·
<a href="https://github.com/tootsuite/mastodon">Source code</a>
·
<a href="https://instances.mastodon.xyz">Other instances</a>
·
<a href="https://github.com/antoineraulin">My Github</a>
·
<a href="https://mastodon.social/@antoineraulin" data-tooltip="#foo">@antoineraulin</a>
·
<a href="https://antoineraulin.github.io" >My others projects</a>
</div>
</div>
</div>
<div id="foo">
<center>
<img src="https://files.mastodon.social/accounts/avatars/000/038/053/original/c20a9da88cbf5459.png?1491298071" alt="C20a9da88cbf5459">

<b style="color: white;font-family: Arial;">Antoine Raulin</b>
<b style="color: white;font-family: Arial;">@antoineraulin</b>

<p>Développeur Web et Android. Accros aux nouvelles technos. <a href="https://mastodon.social/tags/materialdesign" class="mention hashtag">#<span>MaterialDesign</span></a>

<a href="https://antoineraulin.github.io" rel="nofollow noopener" target="_blank"><span class="invisible">https://</span><span class="">antoineraulin.github.io</span><span class="invisible"></span></a></p>
</center>
</div>
</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63562064-14', 'auto');
  ga('send', 'pageview');

</script>
<script>
        $("a").hover(function(e) {
    $($(this).data("tooltip")).css({
        left: e.pageX + 1,
        top: e.pageY - 330
    }).stop().show(100);
}, function() {
    $($(this).data("tooltip")).hide();
});

        </script>
