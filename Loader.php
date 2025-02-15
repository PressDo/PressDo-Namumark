<?php
namespace PressDo\app\Helpers\Mark;

class Loader
{
    static function loadMarkUp(string $content, array $options): array|string{
        require_once 'Namumark.php';
        require_once 'HTMLRenderer.php';
        
        $wEngine = new Namumark();
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
            'include' => array_unique($wEngine->links['include']),
            'category' => $wEngine->links['category'],
        ];
    
        // toHtml을 호출하면 HTML 페이지가 생성됩니다.
        if ($options['thread'])
            return $wHtml;
        else
            return ['html' => $wHtml, 'categories' => $wEngine->links['category'], 'links' => $wLink];
    }
}