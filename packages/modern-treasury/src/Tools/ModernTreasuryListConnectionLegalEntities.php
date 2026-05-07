<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list connection_legal_entities.
 *
 * Maps to the official Modern Treasury endpoint get /api/connection_legal_entities.
 */
class ModernTreasuryListConnectionLegalEntities extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_connection_legal_entities';
    protected const DESCRIPTION = 'list connection_legal_entities

Official Modern Treasury endpoint: GET /api/connection_legal_entities

Get a list of all connection legal entities.';
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
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `connection_id` from the official Modern Treasury API operation.',
  ),
  'legal_entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `legal_entity_id` from the official Modern Treasury API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'completed',
      1 => 'denied',
      2 => 'failed',
      3 => 'processing',
      4 => 'suspended',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/connection_legal_entities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'connection_id' => 'connection_id',
  'legal_entity_id' => 'legal_entity_id',
  'status' => 'status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
