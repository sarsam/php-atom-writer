<?php

namespace SarSam\AtomWriter;

/**
 * Interface FeedInterface
 * @package Suin\RSSWriter
 */
interface FeedInterface
{

    /**
     * Set channel title
     *
     * @param string $title
     *
     * @return $this
     */
    public function title($title);

    /**
     * Set channel subtitle
     *
     * @param string subtitle
     *
     * @return $this
     */
    public function subtitle($url);

    /**
     * Set channel link
     *
     * @param string link
     *
     * @return $this
     */
    public function link($link);

    /**
     * Set channel link
     *
     * @param string link
     *
     * @return $this
     */
    public function linkSelf($link);

    /**
     * Set channel id
     *
     * @param string id
     *
     * @return $this
     */
    public function id($id);

    /**
     * Set channel updated
     *
     * @param int updated Unix timestamp
     *
     * @return $this
     */
    public function updated($updated);

    /**
     * Add $entry
     *
     * @param EntryInterface $entry
     *
     * @return $this
     */
    public function addEntry(EntryInterface $entry);

    /**
     * Render XML
     * @return string
     */
    public function render();

    /**
     * Render XML
     * @return string
     */
    public function __toString();
}
