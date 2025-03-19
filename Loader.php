<?php
namespace PressDo\App\Services\Mark\Namumark;

class Loader
{
    public static function loadMarkUp(string $content, array $options): array|string
    {
        $wEngine = new Parser();
        $wEngine->title = $options['title'];
        $wEngine->inThread = $options['thread'];
        $wEngine->db = true;
        
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
            return ['html' => $wHtml, 'editor_comment' => $wEngine->renderComments(), 'categories' => $wEngine->links['category'], 'links' => $wLink];
    }
}