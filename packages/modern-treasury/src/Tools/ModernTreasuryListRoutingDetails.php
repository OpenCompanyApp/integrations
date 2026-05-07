<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list routing_details.
 *
 * Maps to the official Modern Treasury endpoint get /api/{accounts_type}/{account_id}/routing_details.
 */
class ModernTreasuryListRoutingDetails extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_routing_details';
    protected const DESCRIPTION = 'list routing_details

Official Modern Treasury endpoint: GET /api/{accounts_type}/{account_id}/routing_details

Get a list of routing details for a single internal or external account.';
    protected const PARAMETERS = array (
  'accounts_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accounts_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'external_accounts',
      1 => 'internal_accounts',
    ),
  ),
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the official Modern Treasury API operation.',
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
    protected const PATH = '/api/{accounts_type}/{account_id}/routing_details';
    protected const PATH_PARAMS = array (
  'accounts_type' => 'accounts_type',
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
