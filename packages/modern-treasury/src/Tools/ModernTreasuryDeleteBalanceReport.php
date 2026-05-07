<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete balance_report.
 *
 * Maps to the official Modern Treasury endpoint delete /api/internal_accounts/{internal_account_id}/balance_reports/{id}.
 */
class ModernTreasuryDeleteBalanceReport extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_balance_report';
    protected const DESCRIPTION = 'delete balance_report

Official Modern Treasury endpoint: DELETE /api/internal_accounts/{internal_account_id}/balance_reports/{id}

Deletes a given balance report.';
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
    protected const METHOD = 'delete';
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
