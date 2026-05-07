<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * show journal_entry.
 *
 * Maps to the official Modern Treasury endpoint get /api/journal_entries/{id}.
 */
class ModernTreasuryGetJournalEntry extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_journal_entry';
    protected const DESCRIPTION = 'show journal_entry

Official Modern Treasury endpoint: GET /api/journal_entries/{id}

Retrieve a specific journal entry';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/journal_entries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
