
<!DOCTYPE html>
<html lang='en'>
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

</head>
<?php
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
        echo "<p>Mastodon est un réseau social <em>gratuit et open source</em>. Une alternative <em>décentralisée</em> aux plates-formes commerciales, elle évite les risques d'une seule société qui monopolise vos communications. Choisissez un serveur dont vous avez confiance. Selon votre choix , vous pouvez interagir avec tous les autres ou non. N'importe qui peut exécuter sa propre instance de Mastodon et participer au <em>réseau social</em> de façon transparente.<br>Mastodon Portal vérifie que l'instance qui vous est proposée est accessible et qu'il est possible d'y créer un compte.<br>Lorsque vous cliquerez sur <em>Commencer</em> vous serez redirigé directement sur l'instance choisie.</p>";
        break;
    case "it":
        echo "<p>Mastodon è un social networking <em>libero e open source</em>. Un <em>decentrata</em> alternativa alle piattaforme commerciali, evita il rischio di una singola azienda che monopolizza le vostre comunicazioni. Scegli un server di fiducia. A seconda della scelta, è possibile interagire con tutti gli altri oppure no. Chiunque può eseguire la propria istanza di Mastodon e partecipare nella <em>rete sociale</em> senza soluzione di continuità.<br>Mastodon Portal controlla che un'istanza che viene offerto è disponibile ed è possibile creare un account.<br>Quando si fa clic <em>Cominciare</em>, sarai portato direttamente all'istanza selezionata.</p>";
        break;
    case "es":
        echo "<p>Mastodon es una red social <em>gratuita y de código abierto</em>. Una alternativa <em>descentralizada</em> a las plataformas comerciales, se evita el riesgo de una única empresa que monopoliza sus comunicaciones. Elegir un servidor de confianza. Dependiendo de su elección, se puede interactuar con todos los demás o no. Cualquiera puede ejecutar su propia instancia de Mastodon y participar en la <em>red social</em> sin problemas.<br>Mastodon Portal comprueba que una instancia que se ofrece está disponible y es posible crear una cuenta.<br> Al hacer clic en <em>Inicio</em>, usted será llevado directamente a la instancia seleccionada.</p>";
        break;        
    default:
        echo "<p>Mastodon is a <em>free, open-source</em> social network. A <em>decentralized</em> alternative to commercial platforms, it avoids the risks of a single company monopolizing your communication. Pick a server that you trust &mdash; whichever you choose, you can interact with everyone else. Anyone can run their own Mastodon instance and participate in the <em>social network</em> seamlessly.<br>Mastodon Portal verifies that the instance that is proposed to you is accessible and that it is possible to create an account there.<br>When you click <em>Get Started</em> you will be redirected directly to the selected instance.</p>";
        break;
}
    
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
    echo '</button></form>';
    ?>

</div>
<div class='info'>
<?php
    echo '<a class="webapp-btn" href="https://'.$instancechoosed.'/auth/sign_in">Log in</a>·<a href="https://'.$instancechoosed.'/about/more" id="aboutmore">About this instance</a>';
    ?>
</div>
</div></div>
<?php
    switch ($lang){
    case "fr":
        echo "<h2>Mastodon compte actuellement ".$usercount." utilisateurs</h2>";
        break;
    case "it":
        echo "<h2>Mastodon ha attualmente ".$usercount." utenti</h2>";
        break;
    case "es":
        echo "<h2>Mastodon tiene actualmente ".$usercount." usuarios</h2>";
        break;        
    default:
        echo "<h2>Mastodon currently has ".$usercount." users</h2>";
        break;
}
    
    switch ($lang){
    case "fr":
        echo "<h3>Ce qui distingue Mastodon</h3>";
        break;
    case "it":
        echo "<h3>Ciò che distingue Mastodon a parte</h3>";
        break;
    case "es":
        echo "<h3>Lo que distingue a Mastodon</h3>";
        break;        
    default:
        echo "<h3>What sets Mastodon apart</h3>";
        break;
}
    
?>
<div class='features-list'>
<div class='features-list__column'>
<ul class='fa-ul'>
<li>

<i class="fa fa-li fa-check-square"></i>
<?php
    
    switch ($lang){
    case "fr":
        echo "<h3>Les timelines sont chronologiques</h3>";
        break;
    case "it":
        echo "<h3>Timelines sono cronologico</h3>";
        break;
    case "es":
        echo "<h3>Los timelines son cronológicos</h3>";
        break;        
    default:
        echo "<h3>Timelines are chronological</h3>";
        break;
}
    
?>
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
    <?php
    
    switch ($lang){
    case "fr":
        echo "<h3>La timeline public</h3>";
        break;
    case "it":
        echo "<h3>Timelines pubblici</h3>";
        break;
    case "es":
        echo "<h3>timelines públicas</h3>";
        break;        
    default:
        echo "<h3>Public timelines</h3>";
        break;
}
    
?>
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
    <?php
    
    switch ($lang){
    case "fr":
        echo "<h3>500 caractères par message</h3>";
        break;
    case "it":
        echo "<h3>500 caratteri per post</h3>";
        break;
    case "es":
        echo "<h3>500 caracteres por publicación</h3>";
        break;        
    default:
        echo "<h3>500 characters per post</h3>";
        break;
}
    
?>
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
    <?php
    
    switch ($lang){
    case "fr":
        echo "<h3>GIF animé et vidéos courtes</h3>";
        break;
    case "it":
        echo "<h3>GIF animati e brevi video</h3>";
        break;
    case "es":
        echo "<h3>GIF animados y vídeos de corta duración</h3>";
        break;        
    default:
        echo "<h3>GIFV sets and short videos</h3>";
        break;
}
    
?>
</li>
</ul>
</div>
<div class='features-list__column'>
<ul class='fa-ul'>
<li>
<i class="fa fa-li fa-check-square"></i>
    <?php
    
    switch ($lang){
    case "fr":
        echo "<h3>Paramètres de confidentialité par message</h3>";
        break;
    case "it":
        echo "<h3>Paramètres riservatezza par messaggio</h3>";
        break;
    case "es":
        echo "<h3>Parámetros de confidencialidad por mensaje</h3>";
        break;        
    default:
        echo "<h3>Granular, per-post privacy settings</h3>";
        break;
}
    
?>
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
    <?php
    
    switch ($lang){
    case "fr":
        echo "<h3>Messages riches et possibilité de mettre sous silence</h3>";
        break;
    case "it":
        echo "<h3>Paramètres riservatezza par messaggio</h3>";
        break;
    case "es":
        echo "<h3>mensajes ricos y oportunidad de silencio</h3>";
        break;        
    default:
        echo "<h3>Rich block and muting tools</h3>";
        break;
}
    
?>
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
    <?php
    
    switch ($lang){
    case "fr":
        echo "<h3>Conception éthique: aucune publicité, aucun suivi</h3>";
        break;
    case "it":
        echo "<h3>design etico: nessun annuncio, nessun inseguimento</h3>";
        break;
    case "es":
        echo "<h3>Diseño ético: sin anuncios, sin seguimiento</h3>";
        break;        
    default:
        echo "<h3>Ethical design: no ads, no tracking</h3>";
        break;
}
    
?>
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
<?php
    
    switch ($lang){
    case "fr":
        echo "<h3>API ouverte pour les applications et les services</h3>";
        break;
    case "it":
        echo "<h3>Open API per le applicazioni e servizi</h3>";
        break;
    case "es":
        echo "<h3>API abierta para aplicaciones y servicios</h3>";
        break;        
    default:
        echo "<h3>Open API for apps and services</h3>";
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
<a href="https://github.com/tootsuite/mastodon/blob/master/docs/Using-Mastodon/List-of-Mastodon-instances.md">Other instances</a>
</div>
</div>
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
