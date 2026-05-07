<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list returns.
 *
 * Maps to the official Modern Treasury endpoint get /api/returns.
 */
class ModernTreasuryListReturns extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_returns';
    protected const DESCRIPTION = 'list returns

Official Modern Treasury endpoint: GET /api/returns

Get a list of returns.';
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
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'returnable_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `returnable_id` from the official Modern Treasury API operation.',
  ),
  'returnable_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `returnable_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'incoming_payment_detail',
      1 => 'payment_order',
      2 => 'return',
      3 => 'reversal',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/returns';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'internal_account_id' => 'internal_account_id',
  'counterparty_id' => 'counterparty_id',
  'returnable_id' => 'returnable_id',
  'returnable_type' => 'returnable_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
