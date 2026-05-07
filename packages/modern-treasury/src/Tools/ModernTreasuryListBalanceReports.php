<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list balance_reports.
 *
 * Maps to the official Modern Treasury endpoint get /api/internal_accounts/{internal_account_id}/balance_reports.
 */
class ModernTreasuryListBalanceReports extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_balance_reports';
    protected const DESCRIPTION = 'list balance_reports

Official Modern Treasury endpoint: GET /api/internal_accounts/{internal_account_id}/balance_reports

Get all balance reports for a given internal account.';
    protected const PARAMETERS = array (
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'as_of_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `as_of_date` from the official Modern Treasury API operation.',
  ),
  'balance_report_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `balance_report_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'intraday',
      1 => 'other',
      2 => 'previous_day',
      3 => 'real_time',
    ),
  ),
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/internal_accounts/{internal_account_id}/balance_reports';
    protected const PATH_PARAMS = array (
  'internal_account_id' => 'internal_account_id',
);
    protected const QUERY_PARAMS = array (
  'as_of_date' => 'as_of_date',
  'balance_report_type' => 'balance_report_type',
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
