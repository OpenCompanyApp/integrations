<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update journal_report.
 *
 * Maps to the official Modern Treasury endpoint patch /api/journal_reports/{id}.
 */
class ModernTreasuryUpdateJournalReport extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_journal_report';
    protected const DESCRIPTION = 'update journal_report

Official Modern Treasury endpoint: PATCH /api/journal_reports/{id}

Update a journal report';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/journal_reports/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
