<?php
/**
 * webtrees: online genealogy
 * Copyright (C) 2019 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace Fisharebest\Webtrees\Module;

use Fisharebest\Webtrees\Fact;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Individual;
use Fisharebest\Webtrees\Services\ClipboardService;
use Illuminate\Support\Collection;

/**
 * Class NotesTabModule
 */
class NotesTabModule extends AbstractModule implements ModuleTabInterface
{
    use ModuleTabTrait;

    /** @var Collection A list facts for this note. */
    private $facts;

    /** @var ClipboardService */
    private $clipboard_service;

    /**
     * NotesTabModule constructor.
     *
     * @param ClipboardService $clipboard_service
     */
    public function __construct(ClipboardService $clipboard_service)
    {
        $this->clipboard_service = $clipboard_service;
    }

    /**
     * How should this module be identified in the control panel, etc.?
     *
     * @return string
     */
    public function title(): string
    {
        /* I18N: Name of a module */
        return I18N::translate('Notes');
    }

    /**
     * A sentence describing what this module does.
     *
     * @return string
     */
    public function description(): string
    {
        /* I18N: Description of the “Notes” module */
        return I18N::translate('A tab showing the notes attached to an individual.');
    }

    /**
     * The default position for this tab.  It can be changed in the control panel.
     *
     * @return int
     */
    public function defaultTabOrder(): int
    {
        return 4;
    }

    /**
     * Is this tab empty? If so, we don't always need to display it.
     *
     * @param Individual $individual
     *
     * @return bool
     */
    public function hasTabContent(Individual $individual): bool
    {
        return $individual->canEdit() || $this->getFactsWithNotes($individual)->isNotEmpty();
    }

    /**
     * A greyed out tab has no actual content, but may perhaps have
     * options to create content.
     *
     * @param Individual $individual
     *
     * @return bool
     */
    public function isGrayedOut(Individual $individual): bool
    {
        return $this->getFactsWithNotes($individual)->isEmpty();
    }

    /**
     * Generate the HTML content of this tab.
     *
     * @param Individual $individual
     *
     * @return string
     */
    public function getTabContent(Individual $individual): string
    {
        return view('modules/notes/tab', [
            'can_edit'        => $individual->canEdit(),
            'clipboard_facts' => $this->clipboard_service->pastableFactsOfType($individual, $this->supportedFacts()),
            'individual'      => $individual,
            'facts'           => $this->getFactsWithNotes($individual),
        ]);
    }

    /**
     * Get all the facts for an individual which contain notes.
     *
     * @param Individual $individual
     *
     * @return Collection
     */
    private function getFactsWithNotes(Individual $individual): Collection
    {
        if ($this->facts === null) {
            $facts = $individual->facts();

            foreach ($individual->spouseFamilies() as $family) {
                if ($family->canShow()) {
                    foreach ($family->facts() as $fact) {
                        $facts->push($fact);
                    }
                }
            }

            $this->facts = new Collection();

            foreach ($facts as $fact) {
                if (preg_match('/(?:^1|\n\d) NOTE/', $fact->gedcom())) {
                    $this->facts->push($fact);
                }
            }
            $this->facts = Fact::sortFacts($this->facts);
        }

        return $this->facts;
    }

    /**
     * Can this tab load asynchronously?
     *
     * @return bool
     */
    public function canLoadAjax(): bool
    {
        return false;
    }

    /**
     * This module handles the following facts - so don't show them on the "Facts and events" tab.
     *
     * @return Collection
     */
    public function supportedFacts(): Collection
    {
        return new Collection(['NOTE']);
    }
}
