<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list external accounts.
 *
 * Maps to the official Modern Treasury endpoint get /api/external_accounts.
 */
class ModernTreasuryListExternalAccounts extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_external_accounts';
    protected const DESCRIPTION = 'list external accounts

Official Modern Treasury endpoint: GET /api/external_accounts';
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
  'party_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `party_name` from the official Modern Treasury API operation.',
  ),
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/external_accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'party_name' => 'party_name',
  'counterparty_id' => 'counterparty_id',
  'external_id' => 'external_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
