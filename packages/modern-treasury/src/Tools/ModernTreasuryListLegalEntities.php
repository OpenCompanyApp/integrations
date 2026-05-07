<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list legal_entities.
 *
 * Maps to the official Modern Treasury endpoint get /api/legal_entities.
 */
class ModernTreasuryListLegalEntities extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_legal_entities';
    protected const DESCRIPTION = 'list legal_entities

Official Modern Treasury endpoint: GET /api/legal_entities

Get a list of all legal entities.';
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
  'legal_entity_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `legal_entity_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'business',
      1 => 'individual',
    ),
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'pending',
      1 => 'active',
      2 => 'suspended',
      3 => 'denied',
    ),
  ),
  'show_deleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `show_deleted` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/legal_entities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'legal_entity_type' => 'legal_entity_type',
  'status' => 'status',
  'show_deleted' => 'show_deleted',
  'external_id' => 'external_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
