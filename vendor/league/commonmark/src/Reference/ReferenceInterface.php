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

namespace League\CommonMark\Reference;

/**
 * Link reference
 */
interface ReferenceInterface
{
    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string
     */
    public function getDestination(): string;

    /**
     * @return string
     */
<<<<<<< HEAD:vendor/league/commonmark/src/Inline/Element/AbstractInlineContainer.php
    public function isContainer(): bool
    {
        return true;
    }
=======
    public function getTitle(): string;
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab:vendor/league/commonmark/src/Reference/ReferenceInterface.php
}
