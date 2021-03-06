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

namespace League\CommonMark\Block\Element;

use League\CommonMark\Cursor;
use League\CommonMark\Reference\ReferenceMap;
use League\CommonMark\Reference\ReferenceMapInterface;

/**
 * @method children() AbstractBlock[]
 */
class Document extends AbstractBlock
{
    /***
     * @var ReferenceMapInterface
     */
    protected $referenceMap;

    public function __construct(?ReferenceMapInterface $referenceMap = null)
    {
        $this->setStartLine(1);

        $this->referenceMap = $referenceMap ?? new ReferenceMap();
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
     * Returns true if this block can contain the given block as a child node
     *
     * @param AbstractBlock $block
     *
     * @return bool
     */
    public function canContain(AbstractBlock $block): bool
    {
        return true;
    }

    /**
     * Whether this is a code block
     *
     * @return bool
     */
    public function isCode(): bool
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        return true;
    }
}
