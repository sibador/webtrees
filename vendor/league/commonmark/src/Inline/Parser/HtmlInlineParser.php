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

namespace League\CommonMark\Inline\Parser;

use League\CommonMark\Inline\Element\HtmlInline;
use League\CommonMark\InlineParserContext;
use League\CommonMark\Util\RegexHelper;

<<<<<<< HEAD
class HtmlInlineParser implements InlineParserInterface
=======
final class HtmlInlineParser implements InlineParserInterface
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
{
    /**
     * @return string[]
     */
    public function getCharacters(): array
    {
        return ['<'];
    }

    /**
     * @param InlineParserContext $inlineContext
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();
        if ($m = $cursor->match('/^' . RegexHelper::PARTIAL_HTMLTAG . '/i')) {
            $inlineContext->getContainer()->appendChild(new HtmlInline($m));

            return true;
        }

        return false;
    }
}
