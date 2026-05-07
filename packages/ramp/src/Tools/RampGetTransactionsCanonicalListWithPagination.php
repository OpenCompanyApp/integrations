<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List transactions.
 *
 * Maps to the official Ramp endpoint get /developer/v1/transactions.
 */
class RampGetTransactionsCanonicalListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_transactions_canonical_list_with_pagination';
    protected const DESCRIPTION = 'List transactions

Official Ramp endpoint: GET /developer/v1/transactions

This endpoint supports filtering and ordering. If state is not set, all transactions except declined transactions will be returned. Note that setting multiple ordering parameters is unsupported.';
    protected const PARAMETERS = array (
  'sk_category_id' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `sk_category_id` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 1,
      1 => 10,
      2 => 11,
      3 => 12,
      4 => 13,
      5 => 14,
      6 => 15,
      7 => 16,
      8 => 17,
      9 => 18,
      10 => 19,
      11 => 2,
      12 => 20,
      13 => 21,
      14 => 23,
      15 => 24,
      16 => 25,
      17 => 26,
      18 => 27,
      19 => 28,
      20 => 29,
      21 => 3,
      22 => 30,
      23 => 31,
      24 => 32,
      25 => 33,
      26 => 34,
      27 => 35,
      28 => 36,
      29 => 37,
      30 => 38,
      31 => 39,
      32 => 4,
      33 => 40,
      34 => 41,
      35 => 42,
      36 => 43,
      37 => 44,
      38 => 5,
      39 => 6,
      40 => 7,
      41 => 8,
      42 => 9,
    ),
  ),
  'department_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `department_id` from the official Ramp API operation.',
  ),
  'limit_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `limit_id` from the official Ramp API operation.',
  ),
  'location_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `location_id` from the official Ramp API operation.',
  ),
  'merchant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `merchant_id` from the official Ramp API operation.',
  ),
  'card_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `card_id` from the official Ramp API operation.',
  ),
  'spend_program_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `spend_program_id` from the official Ramp API operation.',
  ),
  'statement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `statement_id` from the official Ramp API operation.',
  ),
  'approval_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `approval_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'AWAITING_EMPLOYEE',
      1 => 'AWAITING_EMPLOYEE_CHANGES_REQUESTED',
      2 => 'AWAITING_EMPLOYEE_MISSING_ITEMS',
      3 => 'AWAITING_EMPLOYEE_REPAYMENT_FAILED',
      4 => 'AWAITING_EMPLOYEE_REPAYMENT_REQUESTED',
      5 => 'AWAITING_REVIEWER',
      6 => 'FULLY_APPROVED',
    ),
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `state` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'ALL',
      1 => 'CLEARED',
      2 => 'COMPLETION',
      3 => 'DECLINED',
      4 => 'ERROR',
      5 => 'PENDING',
      6 => 'PENDING_INITIATION',
    ),
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Ramp API operation.',
  ),
  'awaiting_approval_by_user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `awaiting_approval_by_user_id` from the official Ramp API operation.',
  ),
  'sync_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sync_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'NOT_SYNC_READY',
      1 => 'SYNCED',
      2 => 'SYNC_READY',
    ),
  ),
  'has_been_approved' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_been_approved` from the official Ramp API operation.',
  ),
  'all_requirements_met_and_approved' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `all_requirements_met_and_approved` from the official Ramp API operation.',
  ),
  'has_statement' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_statement` from the official Ramp API operation.',
  ),
  'synced_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `synced_after` from the official Ramp API operation.',
  ),
  'min_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `min_amount` from the official Ramp API operation.',
  ),
  'has_no_sync_commits' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_no_sync_commits` from the official Ramp API operation.',
  ),
  'max_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `max_amount` from the official Ramp API operation.',
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_date` from the official Ramp API operation.',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_date` from the official Ramp API operation.',
  ),
  'trip_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `trip_id` from the official Ramp API operation.',
  ),
  'accounting_field_selection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_field_selection_id` from the official Ramp API operation.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'requires_memo' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `requires_memo` from the official Ramp API operation.',
  ),
  'include_merchant_data' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_merchant_data` from the official Ramp API operation.',
  ),
  'order_by_date_asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `order_by_date_asc` from the official Ramp API operation.',
  ),
  'order_by_date_desc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `order_by_date_desc` from the official Ramp API operation.',
  ),
  'order_by_amount_asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `order_by_amount_asc` from the official Ramp API operation.',
  ),
  'order_by_amount_desc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `order_by_amount_desc` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/transactions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'sk_category_id' => 'sk_category_id',
  'department_id' => 'department_id',
  'limit_id' => 'limit_id',
  'location_id' => 'location_id',
  'merchant_id' => 'merchant_id',
  'card_id' => 'card_id',
  'spend_program_id' => 'spend_program_id',
  'statement_id' => 'statement_id',
  'approval_status' => 'approval_status',
  'state' => 'state',
  'user_id' => 'user_id',
  'awaiting_approval_by_user_id' => 'awaiting_approval_by_user_id',
  'sync_status' => 'sync_status',
  'has_been_approved' => 'has_been_approved',
  'all_requirements_met_and_approved' => 'all_requirements_met_and_approved',
  'has_statement' => 'has_statement',
  'synced_after' => 'synced_after',
  'min_amount' => 'min_amount',
  'has_no_sync_commits' => 'has_no_sync_commits',
  'max_amount' => 'max_amount',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'trip_id' => 'trip_id',
  'accounting_field_selection_id' => 'accounting_field_selection_id',
  'entity_id' => 'entity_id',
  'requires_memo' => 'requires_memo',
  'include_merchant_data' => 'include_merchant_data',
  'order_by_date_asc' => 'order_by_date_asc',
  'order_by_date_desc' => 'order_by_date_desc',
  'order_by_amount_asc' => 'order_by_amount_asc',
  'order_by_amount_desc' => 'order_by_amount_desc',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
