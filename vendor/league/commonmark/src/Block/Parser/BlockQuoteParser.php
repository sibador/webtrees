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

namespace League\CommonMark\Block\Parser;

use League\CommonMark\Block\Element\BlockQuote;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

<<<<<<< HEAD
class BlockQuoteParser implements BlockParserInterface
=======
final class BlockQuoteParser implements BlockParserInterface
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
{
    /**
     * @param ContextInterface $context
     * @param Cursor           $cursor
     *
     * @return bool
     */
    public function parse(ContextInterface $context, Cursor $cursor): bool
    {
        if ($cursor->isIndented()) {
            return false;
        }

        if ($cursor->getNextNonSpaceCharacter() !== '>') {
            return false;
        }

        $cursor->advanceToNextNonSpaceOrTab();
        $cursor->advance();
        $cursor->advanceBySpaceOrTab();

        $context->addBlock(new BlockQuote());

        return true;
    }
}
