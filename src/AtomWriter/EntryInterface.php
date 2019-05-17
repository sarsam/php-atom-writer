<?php

namespace SarSam\AtomWriter;

/**
 * Interface EntryInterface
 * @package SarSam\AtomWriter]
 */
interface EntryInterface
{
    /**
     * Set item title
     *
     * @param string $title
     *
     * @return $this
     */
    public function title($title);

    /**
     * Set item link
     *
     * @param string $link
     *
     * @return $this
     */
    public function link($link);

    /**
     * Set item linkAlternate
     *
     * @param string $linkAlternate
     *
     * @return $this
     */
    public function linkAlternate($linkAlternate);

    /**
     * Set item linkEdit
     *
     * @param string $linkEdit
     *
     * @return $this
     */
    public function linkEdit($linkEdit);

    /**
     * Set item id
     *
     * @param string $id
     *
     * @return $this
     */
    public function id($id);

    /**
     * Set updated
     *
     * @param int $updated Unix timestamp
     *
     * @return $this
     */
    public function updated($updated);

    /**
     * Set summary
     *
     * @param int $summary Unix timestamp
     *
     * @return $this
     */
    public function summary($summary);

    /**
     * Set content
     *
     * @param int $content Unix timestamp
     *
     * @return $this
     */
    public function content($content);

    /**
     * Set the author
     *
     * @param array $author
     *
     * @return $this
     */
    public function author($author);

    /**
     * Append item to the feed
     *
     * @param \SarSam\AtomWriter\FeedInterface $channel
     *
     * @return $this
     */
    public function appendTo(FeedInterface $channel);

    /**
     * Return XML object
     * @return \SarSam\AtomWriter\SimpleXMLElement
     */
    public function asXML();
}
