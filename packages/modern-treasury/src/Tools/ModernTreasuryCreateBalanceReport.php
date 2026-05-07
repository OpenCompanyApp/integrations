<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create balance reports.
 *
 * Maps to the official Modern Treasury endpoint post /api/internal_accounts/{internal_account_id}/balance_reports.
 */
class ModernTreasuryCreateBalanceReport extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_balance_report';
    protected const DESCRIPTION = 'create balance reports

Official Modern Treasury endpoint: POST /api/internal_accounts/{internal_account_id}/balance_reports';
    protected const PARAMETERS = array (
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/internal_accounts/{internal_account_id}/balance_reports';
    protected const PATH_PARAMS = array (
  'internal_account_id' => 'internal_account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
