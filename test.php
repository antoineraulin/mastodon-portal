<html>
    <head>
    <meta charset='utf-8'>
<meta content='width=device-width, initial-scale=1' name='viewport'>
<meta content='IE=edge' http-equiv='X-UA-Compatible'>
<meta content='#282c37' name='theme-color'>
<link rel="stylesheet" media="all" href="style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
#foo {
    position: absolute;
    display: none;
    background: #14161C;
  height: 260px;
  width: 15em;
  border-radius: 7px;
}
        </style>

    </head>
    
    <body>
        <?php
if($_POST['instance'] != null){
    libxml_disable_entity_loader(false);
    $url = "https://".$_POST['instance']."/auth/sign_in";
    $dochtml = new DOMDocument();
    $dochtml->loadHTMLFile($url);
    $xp = new DOMXpath($dochtml);
    $nodes = $xp->query('//input[@name="authenticity_token"]');
    $node = $nodes->item(0);
    $authenticity_token = $node->getAttribute('value');
    echo '<div id="login" class="screenshot-with-signup" style="width: 350px;height: 150px;position: absolute;top:0;bottom: 0;left: 0;right: 0;margin: auto;">
        <div novalidate="novalidate" class="simple_form new_user" style="width: 90%">
            <input name="utf8" type="hidden" value="✓">
            <input type="hidden" name="authenticity_token" id="authenticity_token" value="'.$authenticity_token.'">
            <div class="input email required user_email"><input aria-label="E-mail address" class="string email required" autofocus="autofocus" placeholder="E-mail address" type="email" value="" name="user[email]" id="user_email"></div>
            <div class="input password required user_password"><input aria-label="Password" class="password required" placeholder="Password" type="password" name="user[password]" id="user_password" autocomplete="off"></div>
            <div class="actions">
                <button name="button" type="submit" class="btn">Se connecter</button>
            </div>
            </div></div>';
    
}else{
    echo '<div id="select" class="screenshot-with-signup" style="width: 350px;height: 150px;position: absolute;top:0;bottom: 0;left: 0;right: 0;margin: auto;">
        <form action="" method="POST" novalidate="novalidate" class="simple_form new_user" style="width: 90%">
            <div class="input string required user_account_username">
                <input aria-label="Instance" class="string required" placeholder="Instance" type="text" name="instance" id="user_account_attributes_instance" />
            </div>
            <div class="actions">
                <button name="button" type="submit" class="btn">Commencer</button>
            </div>
            </form></div>';
}
?>
    
    </body>
</html>