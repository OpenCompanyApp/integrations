<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete routing_detail.
 *
 * Maps to the official Modern Treasury endpoint delete /api/{accounts_type}/{account_id}/routing_details/{id}.
 */
class ModernTreasuryDeleteRoutingDetail extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_routing_detail';
    protected const DESCRIPTION = 'delete routing_detail

Official Modern Treasury endpoint: DELETE /api/{accounts_type}/{account_id}/routing_details/{id}

Delete a routing detail for a single external account.';
    protected const PARAMETERS = array (
  'accounts_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accounts_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'external_accounts',
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
    protected const METHOD = 'delete';
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
