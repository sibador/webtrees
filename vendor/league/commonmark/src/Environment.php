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

use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorCollection;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Event\AbstractEvent;
use League\CommonMark\Extension\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\Configuration;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\PrioritizedList;

final class Environment implements EnvironmentInterface, ConfigurableEnvironmentInterface
{
    /**
     * @var ExtensionInterface[]
     */
    private $extensions = [];

    /**
     * @var ExtensionInterface[]
     */
    private $uninitializedExtensions = [];

    /**
     * @var bool
     */
    private $extensionsInitialized = false;

    /**
     * @var PrioritizedList<BlockParserInterface>
     */
    private $blockParsers;

    /**
     * @var PrioritizedList<InlineParserInterface>
     */
    private $inlineParsers;

    /**
     * @var array<string, PrioritizedList<InlineParserInterface>>
     */
    private $inlineParsersByCharacter = [];

    /**
<<<<<<< HEAD
     * @var PrioritizedList<DocumentProcessorInterface>
     */
    private $documentProcessors;

    /**
     * @var PrioritizedList<InlineProcessorInterface>
     */
    private $inlineProcessors;

    /**
     * @var array<string, PrioritizedList<BlockRendererInterface>>
     */
    private $blockRenderersByClass = [];

    /**
     * @var array<string, PrioritizedList<InlineRendererInterface>>
     */
    private $inlineRenderersByClass = [];
=======
     * @var DelimiterProcessorCollection
     */
    private $delimiterProcessors;

    /**
     * @var array<string, PrioritizedList<BlockRendererInterface>>
     */
    private $blockRenderersByClass = [];

    /**
     * @var array<string, PrioritizedList<InlineRendererInterface>>
     */
    private $inlineRenderersByClass = [];

    /**
     * @var array<string, PrioritizedList<callable>>
     */
    private $listeners = [];
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab

    /**
     * @var Configuration
     */
    private $config;

    /**
     * @var string
     */
    private $inlineParserCharacterRegex;

    public function __construct(array $config = [])
    {
        $this->config = new Configuration($config);

        $this->blockParsers = new PrioritizedList();
        $this->inlineParsers = new PrioritizedList();
<<<<<<< HEAD
        $this->documentProcessors = new PrioritizedList();
        $this->inlineProcessors = new PrioritizedList();
=======
        $this->delimiterProcessors = new DelimiterProcessorCollection();
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    }

    /**
     * {@inheritdoc}
     */
    public function mergeConfig(array $config = [])
    {
        $this->assertUninitialized('Failed to modify configuration.');

        $this->config->merge($config);
    }

    /**
     * {@inheritdoc}
     */
    public function setConfig(array $config = [])
    {
        $this->assertUninitialized('Failed to modify configuration.');

        $this->config->replace($config);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig($key = null, $default = null)
    {
        return $this->config->get($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function addBlockParser(BlockParserInterface $parser, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add block parser.');

        $this->blockParsers->add($parser, $priority);
        $this->injectEnvironmentAndConfigurationIfNeeded($parser);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addInlineParser(InlineParserInterface $parser, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add inline parser.');

        $this->inlineParsers->add($parser, $priority);
        $this->injectEnvironmentAndConfigurationIfNeeded($parser);
<<<<<<< HEAD

        foreach ($parser->getCharacters() as $character) {
            if (!isset($this->inlineParsersByCharacter[$character])) {
                $this->inlineParsersByCharacter[$character] = new PrioritizedList();
            }

            $this->inlineParsersByCharacter[$character]->add($parser, $priority);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addInlineProcessor(InlineProcessorInterface $processor, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add inline processor.');

        $this->inlineProcessors->add($processor, $priority);
        $this->injectEnvironmentAndConfigurationIfNeeded($processor);
=======

        foreach ($parser->getCharacters() as $character) {
            if (!isset($this->inlineParsersByCharacter[$character])) {
                $this->inlineParsersByCharacter[$character] = new PrioritizedList();
            }

            $this->inlineParsersByCharacter[$character]->add($parser, $priority);
        }
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab

        return $this;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function addDocumentProcessor(DocumentProcessorInterface $processor, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add document processor.');

        $this->documentProcessors->add($processor, $priority);
=======
    public function addDelimiterProcessor(DelimiterProcessorInterface $processor): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add delimiter processor.');
        $this->delimiterProcessors->add($processor);
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
        $this->injectEnvironmentAndConfigurationIfNeeded($processor);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addBlockRenderer($blockClass, BlockRendererInterface $blockRenderer, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add block renderer.');

        if (!isset($this->blockRenderersByClass[$blockClass])) {
            $this->blockRenderersByClass[$blockClass] = new PrioritizedList();
        }

        $this->blockRenderersByClass[$blockClass]->add($blockRenderer, $priority);
        $this->injectEnvironmentAndConfigurationIfNeeded($blockRenderer);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addInlineRenderer(string $inlineClass, InlineRendererInterface $renderer, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add inline renderer.');

        if (!isset($this->inlineRenderersByClass[$inlineClass])) {
            $this->inlineRenderersByClass[$inlineClass] = new PrioritizedList();
        }

        $this->inlineRenderersByClass[$inlineClass]->add($renderer, $priority);
        $this->injectEnvironmentAndConfigurationIfNeeded($renderer);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockParsers(): iterable
    {
        $this->initializeExtensions();

        return $this->blockParsers->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function getInlineParsersForCharacter(string $character): iterable
    {
        $this->initializeExtensions();

        if (!isset($this->inlineParsersByCharacter[$character])) {
            return [];
        }

        return $this->inlineParsersByCharacter[$character]->getIterator();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getInlineProcessors(): iterable
    {
        $this->initializeExtensions();

        return $this->inlineProcessors->getIterator();
=======
    public function getDelimiterProcessors(): DelimiterProcessorCollection
    {
        $this->initializeExtensions();

        return $this->delimiterProcessors;
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getDocumentProcessors(): iterable
    {
        $this->initializeExtensions();

        return $this->documentProcessors->getIterator();
    }

    /**
     * {@inheritdoc}
     */
=======
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    public function getBlockRenderersForClass(string $blockClass): iterable
    {
        $this->initializeExtensions();

        if (!isset($this->blockRenderersByClass[$blockClass])) {
            return [];
        }

        return $this->blockRenderersByClass[$blockClass]->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function getInlineRenderersForClass(string $inlineClass): iterable
    {
        $this->initializeExtensions();

        if (!isset($this->inlineRenderersByClass[$inlineClass])) {
            return [];
        }

        return $this->inlineRenderersByClass[$inlineClass]->getIterator();
    }

    /**
     * Get all registered extensions
     *
     * @return ExtensionInterface[]
     */
    public function getExtensions(): iterable
    {
        return $this->extensions;
    }

    /**
     * Add a single extension
     *
     * @param ExtensionInterface $extension
     *
     * @return $this
     */
    public function addExtension(ExtensionInterface $extension): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add extension.');

        $this->extensions[] = $extension;
        $this->uninitializedExtensions[] = $extension;

        return $this;
    }

    private function initializeExtensions()
    {
        // Only initialize them once
        if ($this->extensionsInitialized) {
            return;
        }

        // Ask all extensions to register their components
        while (!empty($this->uninitializedExtensions)) {
            foreach ($this->uninitializedExtensions as $i => $extension) {
                $extension->register($this);
                unset($this->uninitializedExtensions[$i]);
            }
        }

        $this->extensionsInitialized = true;

        // Lastly, let's build a regex which matches non-inline characters
        // This will enable a huge performance boost with inline parsing
        $this->buildInlineParserCharacterRegex();
    }

    private function injectEnvironmentAndConfigurationIfNeeded($object)
    {
        if ($object instanceof EnvironmentAwareInterface) {
            $object->setEnvironment($this);
        }

        if ($object instanceof ConfigurationAwareInterface) {
            $object->setConfiguration($this->config);
        }
<<<<<<< HEAD
=======
    }

    /**
     * @return Environment
     */
    public static function createCommonMarkEnvironment(): Environment
    {
        $environment = new static();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->mergeConfig([
            'renderer' => [
                'block_separator' => "\n",
                'inner_separator' => "\n",
                'soft_break'      => "\n",
            ],
            'html_input'         => self::HTML_INPUT_ALLOW,
            'allow_unsafe_links' => true,
            'max_nesting_level'  => INF,
        ]);

        return $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getInlineParserCharacterRegex(): string
    {
        return $this->inlineParserCharacterRegex;
    }

    /**
     * {@inheritdoc}
     */
    public function addEventListener(string $eventClass, callable $listener, int $priority = 0): ConfigurableEnvironmentInterface
    {
        $this->assertUninitialized('Failed to add event listener.');

        if (!isset($this->listeners[$eventClass])) {
            $this->listeners[$eventClass] = new PrioritizedList();
        }

        $this->listeners[$eventClass]->add($listener, $priority);

        return $this;
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public static function createCommonMarkEnvironment(): Environment
=======
    public function dispatch(AbstractEvent $event): void
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $this->initializeExtensions();

        $type = get_class($event);

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getInlineParserCharacterRegex(): string
    {
        return $this->inlineParserCharacterRegex;
=======
        foreach ($this->listeners[$type] ?? [] as $listener) {
            if ($event->isPropagationStopped()) {
                return;
            }

            $listener($event);
        }
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    }

    private function buildInlineParserCharacterRegex()
    {
<<<<<<< HEAD
        $chars = \array_keys($this->inlineParsersByCharacter);
=======
        $chars = \array_unique(\array_merge(
            \array_keys($this->inlineParsersByCharacter),
            $this->delimiterProcessors->getDelimiterCharacters()
        ));
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab

        if (empty($chars)) {
            // If no special inline characters exist then parse the whole line
            $this->inlineParserCharacterRegex = '/^.+$/u';
        } else {
            // Match any character which inline parsers are not interested in
            $this->inlineParserCharacterRegex = '/^[^' . \preg_quote(\implode('', $chars), '/') . ']+/u';
        }
    }

    /**
     * @param string $message
     *
     * @throws \RuntimeException
     */
    private function assertUninitialized(string $message)
    {
        if ($this->extensionsInitialized) {
            throw new \RuntimeException($message . ' Extensions have already been initialized.');
        }
    }
}
