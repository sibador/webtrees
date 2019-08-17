<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Delimiter;

use League\CommonMark\Inline\Element\AbstractStringContainer;

final class Delimiter implements DelimiterInterface
{
    /** @var string */
    private $char;

    /** @var int */
    private $length;

    /** @var int */
    private $originalLength;

    /** @var AbstractStringContainer */
    private $inlineNode;

    /** @var DelimiterInterface|null */
    private $previous;

    /** @var DelimiterInterface|null */
    private $next;

    /** @var bool */
    private $canOpen;

    /** @var bool */
    private $canClose;

    /** @var bool */
    private $active;

    /** @var int|null */
    private $index;

    /**
     * @param string                  $char
     * @param int                     $numDelims
     * @param AbstractStringContainer $node
     * @param bool                    $canOpen
     * @param bool                    $canClose
     * @param int|null                $index
     */
<<<<<<< HEAD
    public function __construct(string $char, int $numDelims, Node $node, bool $canOpen, bool $canClose, ?int $index = null)
=======
    public function __construct(string $char, int $numDelims, AbstractStringContainer $node, bool $canOpen, bool $canClose, ?int $index = null)
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $this->char = $char;
        $this->length = $numDelims;
        $this->originalLength = $numDelims;
        $this->inlineNode = $node;
        $this->canOpen = $canOpen;
        $this->canClose = $canClose;
        $this->active = true;
        $this->index = $index;
    }

    /**
     * {@inheritdoc}
     */
    public function canClose(): bool
    {
        return $this->canClose;
    }

    /**
     * {@inheritdoc}
     */
    public function setCanClose(bool $canClose)
    {
        $this->canClose = $canClose;
    }

    /**
     * {@inheritdoc}
     */
    public function canOpen(): bool
    {
        return $this->canOpen;
    }

    /**
<<<<<<< HEAD
     * @param bool $canOpen
     *
     * @return $this
     */
    public function setCanOpen(bool $canOpen)
    {
        $this->canOpen = $canOpen;

        return $this;
    }

    /**
     * @return bool
=======
     * {@inheritdoc}
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * {@inheritdoc}
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * {@inheritdoc}
     */
    public function getChar(): string
    {
        return $this->char;
    }

    /**
<<<<<<< HEAD
     * @param string $char
     *
     * @return $this
     */
    public function setChar(string $char)
    {
        $this->char = $char;

        return $this;
    }

    /**
     * @return int|null
=======
     * {@inheritdoc}
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setIndex(?int $index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return Delimiter|null
     */
    public function getNext(): ?self
=======
    public function getNext(): ?DelimiterInterface
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        return $this->next;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setNext(?self $next)
=======
    public function setNext(?DelimiterInterface $next)
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $this->next = $next;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getNumDelims(): int
=======
    public function getLength(): int
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        return $this->length;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setNumDelims(int $numDelims)
=======
    public function setLength(int $length)
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $this->length = $length;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getOrigDelims(): int
=======
    public function getOriginalLength(): int
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        return $this->originalLength;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getInlineNode(): Node
=======
    public function getInlineNode(): AbstractStringContainer
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        return $this->inlineNode;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getPrevious(): ?self
=======
    public function getPrevious(): ?DelimiterInterface
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        return $this->previous;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setPrevious(?self $previous)
=======
    public function setPrevious(?DelimiterInterface $previous): DelimiterInterface
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $this->previous = $previous;

        return $this;
    }
}
