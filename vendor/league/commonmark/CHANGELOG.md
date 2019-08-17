# Change Log
All notable changes to this project will be documented in this file.
Updates should follow the [Keep a CHANGELOG](https://keepachangelog.com/) principles.

## [Unreleased][unreleased]

<<<<<<< HEAD
## [0.19.3] - 2019-06-18

### Fixed

 - Fixed bug where elements with content of `"0"` wouldn't be rendered (#376)

## [0.19.2] - 2019-05-19

### Fixed

 - Fixed bug where default values for nested configuration paths were inadvertently cast to strings

## [0.19.1] - 2019-04-10

### Added

 - Added the missing `addExtension()` method to the new `ConfigurableEnvironmentInterface`

### Fixed

 - Fixed extensions not being able to register other extensions

## [0.19.0] - 2019-04-10

### Added

 - The priority of parsers, processors, and renderers can now be set when `add()`ing them; you no longer need to rely on the order in which they are added
 - Added support for trying multiple parsers per block/inline
 - Extracted two new base interfaces from `Environment`:
   - `EnvironmentInterface`
   - `ConfigurableEnvironmentInterface`
 - Extracted a new `AbstractStringContainerBlock` base class and corresponding `StringContainerInterface` from `AbstractBlock`
 - Added `Cursor::getEncoding()` method
 - Added `.phpstorm.meta.php` file for better IDE code completion
 - Made some minor optimizations here and there

### Changed

 - Pretty much everything now has parameter and return types (#346)
 - Attributes passed to `HtmlElement` will now be escaped by default
 - `Environment` is now a `final` class
 - `Environment::getBlockRendererForClass()` was replaced with `Environment::getBlockRenderersForClass()` (note the added `s`)
 - `Environment::getInlineRendererForClass()` was replaced with `Environment::getInlineRenderersForClass()` (note the added `s`)
 - The `Environment::get____()` methods now return an iterator instead of an array
 - `Context::addBlock()` no longer returns the same block instance you passed into the method, as this served no useful purpose
 - `RegexHelper::isEscapable()` no longer accepts `null` values
 - `Node::replaceChildren()` now accepts any type of `iterable`, not just `array`s
 - Some block elements now extend `AbstractStringContainerBlock` instead of `AbstractBlock`
   - `InlineContainerInterface` now extends the new `StringContainerInterface`
   - The `handleRemainingContents()` method (formerly on `AbstractBlock`, now on `AbstractStringContainerBlock`) is now an `abstract method
   - The `InlineParserContext` constructor now requires an `AbstractStringContainerBlock` instead of an `AbstractBlock`

### Removed

 - Removed support for PHP 5.6 and 7.0 (#346)
 - Removed support for `add()`ing parsers with just the target block/inline class name - you need to include the full namespace now
 - Removed the following unused methods from `Environment`:
   - `getInlineParser($name)`
   - `getInlineParsers()`
   - `createInlineParserEngine()`
 - Removed the unused `getName()` methods:
   - `AbstractBlockParser::getName()`
   - `AbstractInlineParser::getName()`
   - `BlockParserInterface::getName()`
   - `InlinerParserInterface::getName()`
 - Removed the now-useless classes:
   - `AbstractBlockParser`
   - `AbstractInlinerParser`
   - `InlineContainer`
 - Removed the `AbstractBlock::acceptsLines()` method
 - Removed the now-useless constructor from `AbstractBlock`
 - Removed previously-deprecated functionality:
   - `InlineContainer` class
   - `RegexHelper::$instance`
   - `RegexHelper::getInstance()`
   - `RegexHelper::getPartialRegex()`
   - `RegexHelper::getHtmlTagRegex()`
   - `RegexHelper::getLinkTitleRegex()`
   - `RegexHelper::getLinkDestinationBracesRegex()`
   - `RegexHelper::getThematicBreakRegex()`
 - Removed the second `$preserveEntities` parameter from `Xml:escape()`

## [0.18.5] - 2019-03-28
=======
## [1.0.0] - 2019-06-29
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab

No changes were made since 1.0.0-rc1.

## [1.0.0-rc1] - 2019-06-19

### Added

 - Extracted a `ReferenceMapInterface` from the `ReferenceMap` class
 - Added optional `ReferenceMapInterface` parameter to the `Document` constructor

### Changed

 - Replaced all references to `ReferenceMap` with `ReferenceMapInterface`
 - `ReferenceMap::addReference()` no longer returns `$this`

### Fixed

 - Fixed bug where elements with content of `"0"` wouldn't be rendered (#376)

## [1.0.0-beta4] - 2019-06-05

### Added

 - Added event dispatcher functionality (#359, #372)

### Removed

 - Removed `DocumentProcessorInterface` functionality in favor of event dispatching (#373)

## [1.0.0-beta3] - 2019-05-27

### Changed

 - Made the `Delimiter` class final and extracted a new `DelimiterInterface`
   - Modified most external usages to use this new interface
 - Renamed three `Delimiter` methods:
   - `getOrigDelims()` renamed to `getOriginalLength()`
   - `getNumDelims()` renamed to `getLength()`
   - `setNumDelims()` renamed to `setLength()`
 - Made additional classes final:
   - `DelimiterStack`
   - `ReferenceMap`
   - `ReferenceParser`
 - Moved `ReferenceParser` into the `Reference` sub-namespace

### Removed

 - Removed unused `Delimiter` methods:
   - `setCanOpen()`
   - `setCanClose()`
   - `setChar()`
   - `setIndex()`
   - `setInlineNode()`
 - Removed fluent interface from `Delimiter` (setter methods now have no return values)

## [1.0.0-beta2] - 2019-05-27

### Changed

 - `DelimiterProcessorInterface::process()` will accept any type of `AbstractStringContainer` now, not just `Text` nodes
 - The `Delimiter` constructor, `getInlineNode()`, and `setInlineNode()` no longer accept generic `Node` elements - only `AbstractStringContainer`s


### Removed

 - Removed all deprecated functionality:
   - The `safe` option (use `html_input` and `allow_unsafe_links` options instead)
   - All deprecated `RegexHelper` constants
   - `DocParser::getEnvironment()` (you should obtain it some other way)
   - `AbstractInlineContainer` (use `AbstractInline` instead and make `isContainer()` return `true`)

## [1.0.0-beta1] - 2019-05-26

### Added

 - Added proper support for delimiters, including custom delimiters
   - `addDelimiterProcessor()` added to `ConfigurableEnvironmentInterface` and `Environment`
 - Basic delimiters no longer need custom parsers - they'll be parsed automatically
 - Added new methods:
   - `AdjacentTextMerger::mergeTextNodesBetweenExclusive()`
   - `CommonMarkConveter::getEnvironment()`
   - `Configuration::set()`
 - Extracted some new interfaces from base classes:
   - `DocParserInterface` created from `DocParser`
   - `ConfigurationInterface` created from `Configuration`
   - `ReferenceInterface` created from `Reference`

### Changed

 - Renamed several methods of the `Configuration` class:
   - `getConfig()` renamed to `get()`
   - `mergeConfig()` renamed to `merge()`
   - `setConfig()` renamed to `replace()`
 - Changed `ConfigurationAwareInterface::setConfiguration()` to accept the new `ConfigurationInterface` instead of the concrete class
 - Renamed the `AdjoiningTextCollapser` class to `AdjacentTextMerger`
   - Replaced its `collapseTextNodes()` method with the new `mergeChildNodes()` method
 - Made several classes `final`:
   - `Configuration`
   - `DocParser`
   - `HtmlRenderer`
   - `InlineParserEngine`
   - `NodeWalker`
   - `Reference`
   - All of the block/inline parsers and renderers
 - Reduced visibility of several internal methods to `private`:
    - `DelimiterStack::findEarliest()`
    - All `protected` methods in `InlineParserEngine`
 - Marked some classes and methods as `@internal`
 - `ElementRendererInterface` now requires a public `renderInline()` method; added this to `HtmlRenderer`
 - Changed `InlineParserEngine::parse()` to require an `AbstractStringContainerBlock` instead of the generic `Node` class
 - Un-deprecated the `CommonmarkConverter::VERSION` constant
 - The `Converter` constructor now requires an instance of `DocParserInterface` instead of the concrete `DocParser`
 - Changed `Emphasis`, `Strong`, and `AbstractWebResource` to directly extend `AbstractInline` instead of the (now-deprecated) intermediary `AbstractInlineContainer` class

### Fixed

 - Fixed null errors when inserting sibling `Node`s without parents
 - Fixed `NodeWalkerEvent` not requiring a `Node` via its constructor
 - Fixed `Reference::normalizeReference()` improperly converting to uppercase instead of performing proper Unicode case-folding
 - Fixed strong emphasis delimiters not being preserved when `enable_strong` is set to `false` (it now works identically to `enable_em`)

### Deprecated

<<<<<<< HEAD
## 0.1.0
### Added
 - Initial commit (compatible with jgm/stmd:spec.txt @ 0275f34)

[unreleased]: https://github.com/thephpleague/commonmark/compare/0.19.3...HEAD
[0.19.3]: https://github.com/thephpleague/commonmark/compare/0.19.2...0.19.3
[0.19.2]: https://github.com/thephpleague/commonmark/compare/0.19.1...0.19.2
[0.19.1]: https://github.com/thephpleague/commonmark/compare/0.19.0...0.19.1
[0.19.0]: https://github.com/thephpleague/commonmark/compare/0.18.5...0.19.0
[0.18.5]: https://github.com/thephpleague/commonmark/compare/0.18.4...0.18.5
[0.18.4]: https://github.com/thephpleague/commonmark/compare/0.18.3...0.18.4
[0.18.3]: https://github.com/thephpleague/commonmark/compare/0.18.2...0.18.3
[0.18.2]: https://github.com/thephpleague/commonmark/compare/0.18.1...0.18.2
[0.18.1]: https://github.com/thephpleague/commonmark/compare/0.18.0...0.18.1
[0.18.0]: https://github.com/thephpleague/commonmark/compare/0.17.5...0.18.0
[0.17.5]: https://github.com/thephpleague/commonmark/compare/0.17.4...0.17.5
[0.17.4]: https://github.com/thephpleague/commonmark/compare/0.17.3...0.17.4
[0.17.3]: https://github.com/thephpleague/commonmark/compare/0.17.2...0.17.3
[0.17.2]: https://github.com/thephpleague/commonmark/compare/0.17.1...0.17.2
[0.17.1]: https://github.com/thephpleague/commonmark/compare/0.17.0...0.17.1
[0.17.0]: https://github.com/thephpleague/commonmark/compare/0.16.0...0.17.0
[0.16.0]: https://github.com/thephpleague/commonmark/compare/0.15.7...0.16.0
[0.15.7]: https://github.com/thephpleague/commonmark/compare/0.15.6...0.15.7
[0.15.6]: https://github.com/thephpleague/commonmark/compare/0.15.5...0.15.6
[0.15.5]: https://github.com/thephpleague/commonmark/compare/0.15.4...0.15.5
[0.15.4]: https://github.com/thephpleague/commonmark/compare/0.15.3...0.15.4
[0.15.3]: https://github.com/thephpleague/commonmark/compare/0.15.2...0.15.3
[0.15.2]: https://github.com/thephpleague/commonmark/compare/0.15.1...0.15.2
[0.15.1]: https://github.com/thephpleague/commonmark/compare/0.15.0...0.15.1
[0.15.0]: https://github.com/thephpleague/commonmark/compare/0.14.0...0.15.0
[0.14.0]: https://github.com/thephpleague/commonmark/compare/0.13.4...0.14.0
[0.13.4]: https://github.com/thephpleague/commonmark/compare/0.13.3...0.13.4
[0.13.3]: https://github.com/thephpleague/commonmark/compare/0.13.2...0.13.3
[0.13.2]: https://github.com/thephpleague/commonmark/compare/0.13.1...0.13.2
[0.13.1]: https://github.com/thephpleague/commonmark/compare/0.13.0...0.13.1
[0.13.0]: https://github.com/thephpleague/commonmark/compare/0.12.0...0.13.0
[0.12.0]: https://github.com/thephpleague/commonmark/compare/0.11.3...0.12.0
[0.11.3]: https://github.com/thephpleague/commonmark/compare/0.11.2...0.11.3
[0.11.2]: https://github.com/thephpleague/commonmark/compare/0.11.1...0.11.2
[0.11.1]: https://github.com/thephpleague/commonmark/compare/0.11.0...0.11.1
[0.11.0]: https://github.com/thephpleague/commonmark/compare/0.10.0...0.11.0
[0.10.0]: https://github.com/thephpleague/commonmark/compare/0.9.0...0.10.0
[0.9.0]: https://github.com/thephpleague/commonmark/compare/0.8.0...0.9.0
[0.8.0]: https://github.com/thephpleague/commonmark/compare/0.7.2...0.8.0
[0.7.2]: https://github.com/thephpleague/commonmark/compare/0.7.1...0.7.2
[0.7.1]: https://github.com/thephpleague/commonmark/compare/0.7.0...0.7.1
[0.7.0]: https://github.com/thephpleague/commonmark/compare/0.6.1...0.7.0
[0.6.1]: https://github.com/thephpleague/commonmark/compare/0.6.0...0.6.1
[0.6.0]: https://github.com/thephpleague/commonmark/compare/0.5.1...0.6.0
[0.5.1]: https://github.com/thephpleague/commonmark/compare/0.5.0...0.5.1
[0.5.0]: https://github.com/thephpleague/commonmark/compare/0.4.0...0.5.0
[0.4.0]: https://github.com/thephpleague/commonmark/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/thephpleague/commonmark/compare/0.2.1...0.3.0
[0.2.1]: https://github.com/thephpleague/commonmark/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/thephpleague/commonmark/compare/0.1.2...0.2.0
[0.1.2]: https://github.com/thephpleague/commonmark/compare/0.1.1...0.1.2
[0.1.1]: https://github.com/thephpleague/commonmark/compare/0.1.0...0.1.1
=======
 - Deprecated `DocParser::getEnvironment()` (you should obtain it some other way)
 - Deprecated `AbstractInlineContainer` (use `AbstractInline` instead and make `isContainer()` return `true`)

### Removed

 - Removed inline processor functionality now that we have proper delimiter support:
   - Removed `addInlineProcessor()` from `ConfigurableEnvironmentInterface` and `Environment`
   - Removed `getInlineProcessors()` from `EnvironmentInterface` and `Environment`
   - Removed `EmphasisProcessor`
   - Removed `InlineProcessorInterface`
 - Removed `EmphasisParser` now that we have proper delimiter support
 - Removed support for non-UTF-8-compatible encodings
    - Removed `getEncoding()` from `ContextInterface`
    - Removed `getEncoding()`, `setEncoding()`, and `$encoding` from `Context`
    - Removed `getEncoding()` and the second `$encoding` constructor param from `Cursor`
 - Removed now-unused methods
   - Removed `DelimiterStack::getTop()` (no replacement)
   - Removed `DelimiterStack::iterateByCharacters()` (use the new `processDelimiters()` method instead)
   - Removed the protected `DelimiterStack::findMatchingOpener()` method

[unreleased]: https://github.com/thephpleague/commonmark/compare/1.0.0...HEAD
[1.0.0]: https://github.com/thephpleague/commonmark/compare/1.0.0-rc1...1.0.0
[1.0.0-rc1]: https://github.com/thephpleague/commonmark/compare/1.0.0-beta4...1.0.0-rc1
[1.0.0-beta4]: https://github.com/thephpleague/commonmark/compare/1.0.0-beta3...1.0.0-beta4
[1.0.0-beta3]: https://github.com/thephpleague/commonmark/compare/1.0.0-beta2...1.0.0-beta3
[1.0.0-beta2]: https://github.com/thephpleague/commonmark/compare/1.0.0-beta1...1.0.0-beta2
[1.0.0-beta1]: https://github.com/thephpleague/commonmark/compare/0.19.2...1.0.0-beta1
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
