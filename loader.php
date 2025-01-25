<?php
namespace PressDo;
if(!function_exists('loadMarkUp')){
function loadMarkUp($content, array $options){
    require_once 'NamuMark.php';
    $wEngine = new NamuMark();
    $wEngine->noredirect = $options['noredirect'];
    $wEngine->prefix = "";
    $wEngine->title = $options['title'];
    $wEngine->inThread = $options['thread'];
    $wEngine->db = $options['db'];
    
    $content = str_replace("\r\n", "\n", $content);
    $wHtml = $wEngine->toHtml($content);

    $wLink = [
        'link' => array_unique($wEngine->links['link']),
        'redirect' => array_unique($wEngine->links['redirect']),
        'file' => array_unique($wEngine->links['file']),
        'include' => array_unique($wEngine->links['include'])
    ];

    // toHtml을 호출하면 HTML 페이지가 생성됩니다.
    if($options['thread'])
        return $wHtml;
    else
        return ['html' => $wHtml, 'categories' => $wEngine->category, 'links' => $wLink];
}
}
