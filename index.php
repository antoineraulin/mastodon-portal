
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta content='width=device-width, initial-scale=1' name='viewport'>
<meta content='IE=edge' http-equiv='X-UA-Compatible'>
<link href='/apple-touch-icon.png' rel='apple-touch-icon' sizes='180x180'>
<link href='/manifest.json' rel='manifest'>
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
    ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $dochtml = new DOMDocument();
    $dochtml->loadHTMLFile("http://instances.mastodon.xyz/");
    $time = true;
    $time2 = 0;
    $instancelist = [];
    while($time == true){
        
        try{
            $tr = $dochtml->getElementsByTagName('tr')[$time2]->nodeValue;
            if(strpos($tr, 'Uptime') !== false){
                
            }else if($tr == null){
                break;
                $time = false;
            }else{
                echo $tr;
                $content = explode(" ", $tr);
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
    echo $instancelist;
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
        echo "<p>Mastodon est un réseau social <em>gratuit et open source</em>. Une alternative <em>décentralisée</em> aux plates-formes commerciales, elle évite les risques d'une seule société qui monopolise vos communications. Choisissez un serveur dont vous avez confiance. Selon votre choix , vous pouvez interagir avec tous les autres ou non. N'importe qui peut exécuter sa propre instance de Mastodon et participer au <em>réseau social</em> de façon transparente.<br>Lorsque vous cliquerez sur <em>Commencer</em> vous serez redirigé directement sur l'instance choisie.</p>";
        break;
    case "it":
        echo "<p>Mastodon è un social networking <em>libero e open source</em>. Un <em>decentrata</em> alternativa alle piattaforme commerciali, evita il rischio di una singola azienda che monopolizza le vostre comunicazioni. Scegli un server di fiducia. A seconda della scelta, è possibile interagire con tutti gli altri oppure no. Chiunque può eseguire la propria istanza di Mastodon e partecipare nella <em>rete sociale</em> senza soluzione di continuità. <br> Quando si fa clic <em>Cominciare</em>, sarai portato direttamente all'istanza selezionata.</p>";
        break;
    case "es":
        echo "<p>Mastodon es una red social <em>gratuita y de código abierto</em>. Una alternativa <em>descentralizada</em> a las plataformas comerciales, se evita el riesgo de una única empresa que monopoliza sus comunicaciones. Elegir un servidor de confianza. Dependiendo de su elección, se puede interactuar con todos los demás o no. Cualquiera puede ejecutar su propia instancia de Mastodon y participar en la <em>red social</em> sin problemas. <br> Al hacer clic en <em>Inicio</em>, usted será llevado directamente a la instancia seleccionada.</p>";
        break;        
    default:
        echo "<p>Mastodon is a <em>free, open-source</em> social network. A <em>decentralized</em> alternative to commercial platforms, it avoids the risks of a single company monopolizing your communication. Pick a server that you trust &mdash; whichever you choose, you can interact with everyone else. Anyone can run their own Mastodon instance and participate in the <em>social network</em> seamlessly.When you click <em>Get Started</em> you will be redirected directly to the selected instance.</p>";
        break;
}
    
    ?>
<div class='screenshot-with-signup'>
<div class='mascot'><img src="fluffy%20elephant%20friend.png" alt="Fluffy elephant friend" /></div>
<div novalidate="novalidate" class="simple_form new_user">
    <div class="input string required user_account_username">
        <input aria-label="Instance" class="string required" placeholder="Instance" type="text" value="" name="instance" id="user_account_attributes_instance" />
    </div>
<div class='actions'>
<button name="button" onclick="getStarted()" class="btn" id="getstarted">
<?php 
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
?>
</button>
</div>
<div class='info'>
<a class="webapp-btn" href="/auth/sign_in">Log in</a>
·
<a href="/about/more" id="aboutmore">About this instance</a>
</div>
</div></div>
<h3>What sets Mastodon apart</h3>
<div class='features-list'>
<div class='features-list__column'>
<ul class='fa-ul'>
<li>
<i class="fa fa-li fa-check-square"></i>
Timelines are chronological
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
Public timelines
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
500 characters per post
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
GIFV sets and short videos
</li>
</ul>
</div>
<div class='features-list__column'>
<ul class='fa-ul'>
<li>
<i class="fa fa-li fa-check-square"></i>
Granular, per-post privacy settings
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
Rich block and muting tools
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
Ethical design: no ads, no tracking
</li>
<li>
<i class="fa fa-li fa-check-square"></i>
Open API for apps and services
</li>
</ul>
</div>
</div>
<div class='actions'>
<div class='info'>
<a href="/terms">Terms</a>
·
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
