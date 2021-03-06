<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark;

use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
<<<<<<< HEAD
use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\Inline\Processor\InlineProcessorInterface;
=======
use League\CommonMark\Delimiter\Processor\DelimiterProcessorCollection;
use League\CommonMark\Event\AbstractEvent;
use League\CommonMark\Inline\Parser\InlineParserInterface;
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

interface EnvironmentInterface
{
    const HTML_INPUT_STRIP = 'strip';
    const HTML_INPUT_ALLOW = 'allow';
    const HTML_INPUT_ESCAPE = 'escape';

    /**
     * @param string|null $key
     * @param mixed       $default
     *
     * @return mixed
     */
    public function getConfig($key = null, $default = null);

    /**
     * @return iterable<BlockParserInterface>
     */
    public function getBlockParsers(): iterable;

    /**
     * @param string $character
     *
     * @return iterable<InlineParserInterface>
     */
    public function getInlineParsersForCharacter(string $character): iterable;

    /**
<<<<<<< HEAD
     * @return iterable<InlineProcessorInterface>
     */
    public function getInlineProcessors(): iterable;

    /**
     * @return iterable<DocumentProcessorInterface>
     */
    public function getDocumentProcessors(): iterable;
=======
     * @return DelimiterProcessorCollection
     */
    public function getDelimiterProcessors(): DelimiterProcessorCollection;
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab

    /**
     * @param string $blockClass
     *
     * @return iterable<BlockRendererInterface>
     */
    public function getBlockRenderersForClass(string $blockClass): iterable;

    /**
     * @param string $inlineClass
     *
     * @return iterable<InlineRendererInterface>
     */
    public function getInlineRenderersForClass(string $inlineClass): iterable;

    /**
     * Regex which matches any character which doesn't indicate an inline element
     *
     * This allows us to parse multiple non-special characters at once
     *
     * @return string
     */
    public function getInlineParserCharacterRegex(): string;
<<<<<<< HEAD
=======

    /**
     * Dispatches the given event to listeners
     *
     * @param AbstractEvent $event
     *
     * @return void
     */
    public function dispatch(AbstractEvent $event): void;
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
}
