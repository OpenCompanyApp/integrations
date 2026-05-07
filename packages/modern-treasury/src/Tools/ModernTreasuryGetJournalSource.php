<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * show journal_source.
 *
 * Maps to the official Modern Treasury endpoint get /api/journal_sources/{id}.
 */
class ModernTreasuryGetJournalSource extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_journal_source';
    protected const DESCRIPTION = 'show journal_source

Official Modern Treasury endpoint: GET /api/journal_sources/{id}

Retrieve a specific journal source';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/journal_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
