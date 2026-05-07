<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list journal_reports.
 *
 * Maps to the official Modern Treasury endpoint get /api/journal_reports.
 */
class ModernTreasuryListJournalReports extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_journal_reports';
    protected const DESCRIPTION = 'list journal_reports

Official Modern Treasury endpoint: GET /api/journal_reports

Retrieve a list of journal reports';
    protected const PARAMETERS = array (
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'draft',
      1 => 'published',
      2 => 'ready',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/journal_reports';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'status' => 'status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
