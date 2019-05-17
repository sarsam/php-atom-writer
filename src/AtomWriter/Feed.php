<?php

namespace SarSam\AtomWriter;

use DOMDocument;

/**
 * Class Feed
 * @package Suin\RSSWriter
 */
class Feed implements FeedInterface
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $subtitle;

    /** @var string */
    protected $link;

    /** @var string */
    protected $linkSelf;

    /** @var string */
    protected $id;

    /** @var int */
    protected $updated;

    /** @var EntryInterface[] */
    protected $items = [];

    /**
     * Set channel title
     *
     * @param string $title
     *
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set channel subtitle
     *
     * @param string $subtitle
     *
     * @return $this
     */
    public function subtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Set channel link
     *
     * @param string $link
     *
     * @return $this
     */
    public function link($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Set channel linkSelf
     *
     * @param string $linkSelf
     *
     * @return $this
     */
    public function linkSelf($linkSelf)
    {
        $this->linkSelf = $linkSelf;

        return $this;
    }

    /**
     * Set channel id
     *
     * @param string $id
     *
     * @return $this
     */
    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set channel updated
     *
     * @param int $updated Unix timestamp
     *
     * @return $this
     */
    public function updated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Add channel
     *
     * @param EntryInterface $entry
     *
     * @return $this
     */
    public function addEntry(EntryInterface $entry)
    {
        $this->items[] = $entry;

        return $this;
    }

    /**
     * Render XML
     * @return string
     */
    public function render()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><feed xmlns="http://www.w3.org/2005/Atom"/>',
            LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

        if ($this->title !== null) {
            $xml->addChild('title', $this->title);
        }
        if ($this->subtitle !== null) {
            $xml->addChild('subtitle', $this->subtitle);
        }
        if ($this->link !== null) {
            $xml->addChild('link')->addAttribute('href', $this->link);
        }

        if ($this->linkSelf !== null) {
            $linkSelf = $xml->addChild('link');
            $linkSelf->addAttribute('rel', 'self');
            $linkSelf->addAttribute('type', 'application/atom+xml');
            $linkSelf->addAttribute('href', $this->linkSelf);
        }
        if ($this->id !== null) {
            $xml->addChild('id', $this->id);
        }
        if ($this->updated !== null) {
            $xml->addChild('updated', date(DATE_ATOM, $this->updated));
        }

        foreach ($this->items as $channel) {
            $toDom = dom_import_simplexml($xml);
            $fromDom = dom_import_simplexml($channel->asXML());
            $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->appendChild($dom->importNode(dom_import_simplexml($xml), true));
        $dom->formatOutput = true;

        return $dom->saveXML();
    }

    /**
     * Render XML
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
