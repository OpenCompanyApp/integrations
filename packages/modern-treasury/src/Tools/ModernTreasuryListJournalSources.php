<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list journal_sources.
 *
 * Maps to the official Modern Treasury endpoint get /api/journal_sources.
 */
class ModernTreasuryListJournalSources extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_journal_sources';
    protected const DESCRIPTION = 'list journal_sources

Official Modern Treasury endpoint: GET /api/journal_sources

Retrieve a list of journal sources';
    protected const PARAMETERS = array (
  'journal_report_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `journal_report_id` from the official Modern Treasury API operation.',
  ),
  'journal_entry_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `journal_entry_id` from the official Modern Treasury API operation.',
  ),
  'source_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `source_id` from the official Modern Treasury API operation.',
  ),
  'source_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `source_type` from the official Modern Treasury API operation.',
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
    protected const PATH = '/api/journal_sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'journal_report_id' => 'journal_report_id',
  'journal_entry_id' => 'journal_entry_id',
  'source_id' => 'source_id',
  'source_type' => 'source_type',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
