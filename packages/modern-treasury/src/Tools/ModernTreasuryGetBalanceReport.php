<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get balance_report.
 *
 * Maps to the official Modern Treasury endpoint get /api/internal_accounts/{internal_account_id}/balance_reports/{id}.
 */
class ModernTreasuryGetBalanceReport extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_balance_report';
    protected const DESCRIPTION = 'get balance_report

Official Modern Treasury endpoint: GET /api/internal_accounts/{internal_account_id}/balance_reports/{id}

Get a single balance report for a given internal account.';
    protected const PARAMETERS = array (
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/internal_accounts/{internal_account_id}/balance_reports/{id}';
    protected const PATH_PARAMS = array (
  'internal_account_id' => 'internal_account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
