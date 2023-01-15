<?php
if(!function_exists('loadMarkUp')){
function loadMarkUp($content, array $options){
    require_once 'NamuMark.php';

    //$wPage = new PlainWikiPage($content);
    $wEngine = new NamuMark($wPage);
    $wEngine->noredirect = $options['noredirect'];
    $wEngine->title = $options['title'];
    $wEngine->inThread = $options['thread'];
    //$wEngine->db = $options['db'];
    //$wEngine->ns = $options['namespace'];

    // toHtml을 호출하면 HTML 페이지가 생성됩니다.
    if($options['thread'])
        return $wEngine->toHtml($content);
    else
        return ['html' => $wEngine->toHtml($content), 'categories' => $wEngine->category];
}
}
