<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list account_collection_flows.
 *
 * Maps to the official Modern Treasury endpoint get /api/account_collection_flows.
 */
class ModernTreasuryListAccountCollectionFlows extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_account_collection_flows';
    protected const DESCRIPTION = 'list account_collection_flows

Official Modern Treasury endpoint: GET /api/account_collection_flows';
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
  'client_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `client_token` from the official Modern Treasury API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
  ),
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'external_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_account_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/account_collection_flows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'client_token' => 'client_token',
  'status' => 'status',
  'counterparty_id' => 'counterparty_id',
  'external_account_id' => 'external_account_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
