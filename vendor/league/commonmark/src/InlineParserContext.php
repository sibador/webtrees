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

namespace League\CommonMark;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\AbstractStringContainerBlock;
use League\CommonMark\Delimiter\DelimiterStack;
use League\CommonMark\Reference\ReferenceMapInterface;

class InlineParserContext
{
    private $container;
    private $referenceMap;
    private $cursor;
    private $delimiterStack;

<<<<<<< HEAD
    public function __construct(AbstractStringContainerBlock $container, ReferenceMap $referenceMap)
=======
    public function __construct(AbstractStringContainerBlock $container, ReferenceMapInterface $referenceMap)
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $this->referenceMap = $referenceMap;
        $this->container = $container;
        $this->cursor = new Cursor(\trim($container->getStringContent()));
        $this->delimiterStack = new DelimiterStack();
    }

    /**
     * @return AbstractBlock
     */
    public function getContainer(): AbstractBlock
    {
        return $this->container;
    }

    /**
     * @return ReferenceMapInterface
     */
<<<<<<< HEAD
    public function getReferenceMap(): ReferenceMap
=======
    public function getReferenceMap(): ReferenceMapInterface
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        return $this->referenceMap;
    }

    /**
     * @return Cursor
     */
    public function getCursor(): Cursor
    {
        return $this->cursor;
    }

    /**
     * @return DelimiterStack
     */
    public function getDelimiterStack(): DelimiterStack
    {
        return $this->delimiterStack;
    }
}
