var userLang = navigator.language || navigator.userLanguage;
var instances = ["https://social.targaryen.house", "https://hostux.social","https://awoo.space", "https://icosahedron.website", "https://memetastic.space","https://animalliberation.social", "https://mastodon.xyz", "https://social.lou.lt", "https://masto.themimitoof.fr"];
var thechoosedurl = null;
function begin(){
    if(userLang == "fr"){
        document.getElementById("description").innerHTML = "Mastodon est un réseau social <em>gratuit et open source</em>. Une alternative <em>décentralisée</em> aux plates-formes commerciales, elle évite les risques d'une seule société qui monopolise vos communications. Choisissez un serveur dont vous avez confiance. Selon votre choix , vous pouvez interagir avec tous les autres ou non. N'importe qui peut exécuter sa propre instance de Mastodon et participer au <em>réseau social</em> de façon transparente.<br>Lorsque vous cliquerez sur <em>Commencer</em> vous serez redirigé directement sur l'instance choisie.";
        document.getElementById("getstarted").innerHTML = "Commencer";
    }
    
    var randomNumber = Math.floor(Math.random()*instances.length);
    console.log(instances[randomNumber]);
    ping(instances[randomNumber]).then(function(delta) {
        
        console.log('Ping time was ' + String(delta) + ' ms');
        document.getElementById("user_account_attributes_instance").value = instances[randomNumber].replace("https://", "");
        thechoosedurl = instances[randomNumber]+ "/about";
        
}).catch(function(err) {
    console.error('Could not ping remote URL', err);
        var randomNumber = Math.floor(Math.random()*instances.length);
        console.log(instances[randomNumber]);
        ping(instances[randomNumber]).then(function(delta) {
        
        console.log('Ping time was ' + String(delta) + ' ms');
        document.getElementById("user_account_attributes_instance").value = instances[randomNumber].replace("https://", "");
            thechoosedurl = instances[randomNumber]+ "/about";
        
}).catch(function(err) {
    console.error('Could not ping remote URL', err);
        var randomNumber = Math.floor(Math.random()*instances.length);
        console.log(instances[randomNumber]);
});
});
    
}

function getStarted(){
    if(thechoosedurl != null){
        window.location.href = thechoosedurl;
    }
}