<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve recent Open Library changes.
 */
class OpenLibraryRecentChanges extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_recent_changes';
    protected const DESCRIPTION = 'Retrieve recent Open Library changes, optionally filtered by date, transaction kind, pagination, and bot/human changes.';
    protected const METHOD = 'recentChanges';
    protected const PARAMETERS = [
        'year' => ['type' => 'string', 'required' => false, 'description' => 'Year segment, such as 2026.'],
        'month' => ['type' => 'string', 'required' => false, 'description' => 'Month segment, such as 05.'],
        'day' => ['type' => 'string', 'required' => false, 'description' => 'Day segment, such as 07.'],
        'kind' => ['type' => 'string', 'required' => false, 'description' => 'Change kind, such as add-cover, add-book, edit-book, merge-authors, update, revert, new-account, register, or lists.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum changes.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Change offset.'],
        'bot' => ['type' => 'boolean', 'required' => false, 'description' => 'True for bot changes only, false for human changes only.'],
    ];
}
