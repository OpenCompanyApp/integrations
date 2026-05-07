<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list virtual_accounts.
 *
 * Maps to the official Modern Treasury endpoint get /api/virtual_accounts.
 */
class ModernTreasuryListVirtualAccounts extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_virtual_accounts';
    protected const DESCRIPTION = 'list virtual_accounts

Official Modern Treasury endpoint: GET /api/virtual_accounts

Get a list of virtual accounts.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/virtual_accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'internal_account_id' => 'internal_account_id',
  'counterparty_id' => 'counterparty_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
