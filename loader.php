<?php
if(!function_exists('loadMarkUp')){
function loadMarkUp($content, array $options){
    require_once 'NamuMark.php';
    $wEngine = new NamuMark();
    $wEngine->noredirect = $options['noredirect'];
    $wEngine->prefix = "";
    $wEngine->title = $options['title'];
    $wEngine->inThread = $options['thread'];
    $wEngine->db = $options['db'];
    $wEngine->ns = $options['namespace'];

    $content = str_replace("\r\n", "\n", $content);
    // toHtml을 호출하면 HTML 페이지가 생성됩니다.
    if($options['thread'])
        return $wEngine->toHtml($content);
    else
        return ['html' => $wEngine->toHtml($content), 'categories' => $wEngine->category];
}
}
