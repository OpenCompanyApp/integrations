<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list journal_entries.
 *
 * Maps to the official Modern Treasury endpoint get /api/journal_entries.
 */
class ModernTreasuryListJournalEntries extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_journal_entries';
    protected const DESCRIPTION = 'list journal_entries

Official Modern Treasury endpoint: GET /api/journal_entries

Retrieve a list of journal entries';
    protected const PARAMETERS = array (
  'journal_report_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `journal_report_id` from the official Modern Treasury API operation.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/journal_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'journal_report_id' => 'journal_report_id',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
