<?php

namespace SarSam\AtomWriter;

/**
 * Class Entry
 * @package SarSam\AtomWriter
 */
class Entry implements EntryInterface
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $link;

    /** @var string */
    protected $linkAlternate;

    /** @var string */
    protected $linkEdit;

    /** @var string */
    protected $id;

    /** @var int */
    protected $updated;

    /** @var string */
    protected $summary;

    /** @var string */
    protected $content;

    /** @var string */
    protected $author = [];

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function link($link)
    {
        $this->link = $link;

        return $this;
    }

    public function linkAlternate($linkAlternate)
    {
        $this->linkAlternate = $linkAlternate;

        return $this;
    }

    public function linkEdit($linkEdit)
    {
        $this->linkEdit = $linkEdit;

        return $this;
    }

    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    public function updated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function summary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function author($author = [])
    {
        $this->author = $author;

        return $this;
    }

    public function appendTo(FeedInterface $channel)
    {
        $channel->addEntry($this);

        return $this;
    }

    public function asXML()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><entry></entry>',
            LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

        if ($this->title !== null) {
            $xml->addChild('title', $this->title);
        }

        if ($this->link !== null) {
            $xml->addChild('link')->addAttribute('href', $this->link);
        }

        if ($this->linkAlternate !== null) {
            $alternate = $xml->addChild('link');
            $alternate->addAttribute('rel', 'alternate');
            $alternate->addAttribute('href', $this->linkAlternate);
            $alternate->addAttribute('type', 'text/html');
        }

        if ($this->linkEdit !== null) {
            $edit = $xml->addChild('link');
            $edit->addAttribute('rel', 'edit');
            $edit->addAttribute('href', $this->linkEdit);
        }

        if ($this->id !== null) {
            $xml->addChild('id', $this->id);
        }

        if ($this->updated !== null) {
            $xml->addChild('updated', date(DATE_ATOM, $this->updated));
        }

        if ($this->summary !== null) {
            $xml->addChild('summary', $this->summary);
        }

        if ($this->content !== null) {
            $content =  $xml->addChild('content');
            $content->addAttribute('type','xhtml');
            $content->addChild('div', $this->content)->addAttribute('xmlns', 'http://www.w3.org/1999/xhtml');

        }

        if (is_array($this->author) && !empty($this->author)) {
            $author = $xml->addChild('author');
            foreach ($this->author as $key => $value) {
                $this->author[$key] ? $author->addChild($key, $value) : null;

            }
        }

        return $xml;
    }
}
