<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get routing_detail.
 *
 * Maps to the official Modern Treasury endpoint get /api/{accounts_type}/{account_id}/routing_details/{id}.
 */
class ModernTreasuryGetRoutingDetail extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_routing_detail';
    protected const DESCRIPTION = 'get routing_detail

Official Modern Treasury endpoint: GET /api/{accounts_type}/{account_id}/routing_details/{id}

Get a single routing detail for a single internal or external account.';
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
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/{accounts_type}/{account_id}/routing_details/{id}';
    protected const PATH_PARAMS = array (
  'accounts_type' => 'accounts_type',
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
