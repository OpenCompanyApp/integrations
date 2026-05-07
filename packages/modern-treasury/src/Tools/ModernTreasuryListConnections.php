<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list connections.
 *
 * Maps to the official Modern Treasury endpoint get /api/connections.
 */
class ModernTreasuryListConnections extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_connections';
    protected const DESCRIPTION = 'list connections

Official Modern Treasury endpoint: GET /api/connections

Get a list of all connections.';
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
  'vendor_customer_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `vendor_customer_id` from the official Modern Treasury API operation.',
  ),
  'entity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'vendor_customer_id' => 'vendor_customer_id',
  'entity' => 'entity',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
