<?php
// Inclure la bibliothèque simple_html_dom

require_once __DIR__ . '/../vendor/sunra/php-simple-html-dom-parser/Src/Sunra/PhpSimple/simplehtmldom_1_5/simple_html_dom.php';



// Fonction pour récupérer le contenu d'un fil Twitter à partir de l'URL
function scrapTwitterFeed($url) {
    // Charger la page Twitter
    $html = file_get_html($url);

    // Récupérer les éléments de tweet
    $tweets = $html->find('div.tweet');

    // Parcourir les tweets et extraire le contenu
    $tweetContent = [];
    foreach($tweets as $tweet) {
        $content = $tweet->find('div.js-tweet-text-container', 0)->plaintext;
        $tweetContent[] = $content;
    }

    return $tweetContent;
}

// URL du fil Twitter
$twitterFeedUrl = 'https://twitter.com/DelatreSandrin1';

// Appeler la fonction pour récupérer le contenu du fil Twitter
$tweets = scrapTwitterFeed($twitterFeedUrl);

// Afficher les tweets
foreach ($tweets as $tweet) {
    echo $tweet . "<br>";
}
?>
