<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>{$page_title|default:"Notatki"}</title>
    <link rel="stylesheet" href="{$conf->app_url}/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <video autoplay muted loop playsinline id="background-video">
        <source src="{$conf->app_url}/video/background.mp4" type="video/mp4">
    </video>
    <div class="video-overlay"></div>

    

        <main id="main-content-wrapper">
            {block name=content}{/block}
        </main>


    <footer class="main-footer">
        <p>&copy; {$smarty.now|date_format:"%Y"} notesapp. Wszelkie prawa zastrzeżone.</p>
    </footer>

</body>
</html>