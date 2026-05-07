<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list counterparties.
 *
 * Maps to the official Modern Treasury endpoint get /api/counterparties.
 */
class ModernTreasuryListCounterparties extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_counterparties';
    protected const DESCRIPTION = 'list counterparties

Official Modern Treasury endpoint: GET /api/counterparties

Get a paginated list of all counterparties.';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Modern Treasury API operation.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `email` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
  'legal_entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `legal_entity_id` from the official Modern Treasury API operation.',
  ),
  'created_at_lower_bound' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_lower_bound` from the official Modern Treasury API operation.',
  ),
  'created_at_upper_bound' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_upper_bound` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/counterparties';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'name' => 'name',
  'email' => 'email',
  'external_id' => 'external_id',
  'legal_entity_id' => 'legal_entity_id',
  'created_at_lower_bound' => 'created_at_lower_bound',
  'created_at_upper_bound' => 'created_at_upper_bound',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
