<?php

namespace Returnnull;

class ArticleProjector
{
    public function __construct(
        private MessageProjector $messageProjector
    ) {}

    public function getHtml($article, $comments, $menupoints, $tags, $errors = [""]): string
    {
        return $this->fillContent($article, $comments, $menupoints, $tags, $errors);
    }

    public function fillContent($article, $comments, $menupoints, $tags, $errors = null): string
    {
        
        if (!$article) {
            $this->messageProjector->addMessage('error', 'Not Found', 'Article not found');
        }

        $html   = file_get_contents(HTML . 'articleTemplate.html');
        $header = file_get_contents(HTML . '_header.html');
        $head   = file_get_contents(HTML . '_head.html');

        $blogpost     = file_get_contents(HTML . '_blogpostTemplate.html');
        $newMenuPoint = file_get_contents(HTML . '_menuTemplate.html');
        $newComment = file_get_contents(HTML . '_commentTemplate.html');
        $newTag     = file_get_contents(HTML . '_tagTemplate.html');

        $menuHTML = '';
        foreach ($menupoints as $menupoint)
        {
            $menuHTML .= $newMenuPoint;
            $menuHTML = str_replace('%ARTICLEID%',   $menupoint['id'], $menuHTML);
            $menuHTML = str_replace('%SERVERURL%',   $_SERVER['HTTP_HOST'], $menuHTML);
            $menuHTML = str_replace('%ARTICLESLUG%', $menupoint['slug'], $menuHTML);
            $menuHTML = str_replace('%NUMBER%',      $menupoint['id'], $menuHTML);
            $menuHTML = str_replace('%LINKTITLE%',   $menupoint['titleshort'], $menuHTML);
        }

        $commentsHTML = '';
        foreach ($comments as $newcomment)
        {
            $commentsHTML .= $newComment;
            $commentsHTML = str_replace('%COMMENTID%', $newcomment['id'], $commentsHTML);
            $commentsHTML = str_replace('%COMMENTAUTHOR%',$newcomment['username'], $commentsHTML);
            $commentsHTML = str_replace('%COMMENTDATE%', $newcomment['date'], $commentsHTML);
            $commentsHTML = str_replace('%COMMENTTEXT%', $newcomment['text'], $commentsHTML);
        }
        
        $tagsHTML = '';
        foreach ($tags as $tag)
        {
            $tagsHTML .= $newTag;
            $tagsHTML = str_replace('%TAG%', $tag,$tagsHTML);
        }

        $html = str_replace('%BLOGPOST%', $blogpost, $html);
        $html = str_replace('%MENU%',     $menuHTML, $html);
        $html = str_replace('%MENUTITLE%', "Articles", $html);

        if ($errors[0] =="") {
            $html = str_replace('%FEHLERDISPLAY%', "none", $html);
        } else {
            $html = str_replace('%FEHLERDISPLAY%', "block", $html);
        }

        $isArticleVisible = (bool)$article;
        $html = str_replace('%ARTICLE_VISIBLITY%', ($isArticleVisible ? '' : 'hidden'), $html);
        $html = str_replace('%FEHLER%', $errors[0], $html);
        $html = str_replace('%COMMENTS%', $commentsHTML, $html);
        $html = str_replace('%ALLTAGS%',  trim($tagsHTML, "&nbsp;"), $html);
        if ($article) {
            $html = str_replace('%ARTICLETITLE%', $article['title'], $html);
            $html = str_replace('%NAME%',   $article['firstname'], $html);
            $html = str_replace('%LENGTH%', $article['length'], $html);
            $html = str_replace('%DATE%',   $article['date'], $html);
            $html = str_replace('%TEXT%',   $article['text'], $html);
        }

        $html = str_replace('%HEADER%', $header, $html);
        $html = str_replace('%HEAD%',   $head, $html);

        $html = str_replace('%MESSAGES%', $this->messageProjector->getHtml(), $html);

        return $html;
    }
}
