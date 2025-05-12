<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head> 
    <meta charset="utf-8" />
    <title>{$page_title|default:"Notatki"}</title>
    <link rel="stylesheet" href="{$conf->app_url}/css/style.css">
</head>
<body>
    
    {if $msgs->isMessage()}
        <h4>Wystąpiły błędy: </h4>
        <ol class="err" style="margin: 20px; margin-left: 0px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #ff6666; width:100%; opacity: 0.8;">
        {foreach $msgs->getMessages() as $msg}
            {strip}
                    <li>{$msg -> text}</li>
            {/strip}
        {/foreach}
         </ol>
    {/if}


    
     {block name=content}
     {/block}

</body>
</html>        