<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Query accounting records.
 *
 * Maps to the official Brex endpoint get /v3/accounting/records.
 */
class BrexAccountingQueryAccountingRecords extends AbstractBrexTool
{
    protected const NAME = 'brex_accounting_query_accounting_records';
    protected const DESCRIPTION = 'Query accounting records

Official Brex endpoint: GET /v3/accounting/records

Query accounting records by IDs or with filters for polling. When building integrations with Brex accounting workflow, use filter-based polling as a fallback mechanism. Suggested cadence is 1 hour. **For card and reimbursement records:** Use `review_status` to filter by accounting workflow stage (e.g., READY_FOR_EXPORT, EXPORTED). **For bill records:** Use `source_type=BILL` with `updated_at[gt]` to poll for updated bill records. **Filter Constraints:** - `review_status` is only supported with CARD and REIMBURSEMENT source types';
    protected const PARAMETERS = array (
  'ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `ids` from the official Brex API operation.',
  ),
  'review_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `review_status` from the official Brex API operation.',
    'enum' =>
    array (
      0 => 'PREPARE',
      1 => 'REVIEW',
      2 => 'EXPORTED',
      3 => 'READY_FOR_EXPORT',
    ),
  ),
  'limit' =>
  array (
    'type' => 'number',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'single_entry' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `single_entry` from the official Brex API operation.',
  ),
  'updated_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_at` from the official Brex API operation.',
  ),
  'source_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `source_type` from the official Brex API operation.',
    'enum' =>
    array (
      0 => 'CARD',
      1 => 'REIMBURSEMENT',
      2 => 'BILL',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/accounting/records';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'ids' => 'ids',
  'review_status' => 'review_status',
  'limit' => 'limit',
  'cursor' => 'cursor',
  'single_entry' => 'single_entry',
  'updated_at' => 'updated_at',
  'source_type' => 'source_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
