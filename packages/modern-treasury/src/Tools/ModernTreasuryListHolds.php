<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list holds.
 *
 * Maps to the official Modern Treasury endpoint get /api/holds.
 */
class ModernTreasuryListHolds extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_holds';
    protected const DESCRIPTION = 'list holds

Official Modern Treasury endpoint: GET /api/holds

Get a list of holds.';
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
  'target_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_id` from the official Modern Treasury API operation.',
  ),
  'target_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'payment_order',
    ),
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'active',
      1 => 'resolved',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/holds';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'target_id' => 'target_id',
  'target_type' => 'target_type',
  'status' => 'status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
