<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list transactions.
 *
 * Maps to the official Modern Treasury endpoint get /api/transactions.
 */
class ModernTreasuryListTransactions extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_transactions';
    protected const DESCRIPTION = 'list transactions

Official Modern Treasury endpoint: GET /api/transactions

Get a list of all transactions.';
    protected const PARAMETERS = array (
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
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'virtual_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `virtual_account_id` from the official Modern Treasury API operation.',
  ),
  'posted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `posted` from the official Modern Treasury API operation.',
  ),
  'as_of_date_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `as_of_date_start` from the official Modern Treasury API operation.',
  ),
  'as_of_date_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `as_of_date_end` from the official Modern Treasury API operation.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `direction` from the official Modern Treasury API operation.',
  ),
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'payment_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_type` from the official Modern Treasury API operation.',
  ),
  'transactable_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `transactable_type` from the official Modern Treasury API operation.',
  ),
  'description' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `description` from the official Modern Treasury API operation.',
  ),
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `vendor_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/transactions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'internal_account_id' => 'internal_account_id',
  'virtual_account_id' => 'virtual_account_id',
  'posted' => 'posted',
  'as_of_date_start' => 'as_of_date_start',
  'as_of_date_end' => 'as_of_date_end',
  'direction' => 'direction',
  'counterparty_id' => 'counterparty_id',
  'payment_type' => 'payment_type',
  'transactable_type' => 'transactable_type',
  'description' => 'description',
  'vendor_id' => 'vendor_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
