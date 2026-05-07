<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List cards.
 *
 * Maps to the official Ramp endpoint get /developer/v1/cards.
 */
class RampGetCardListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_card_list_with_pagination';
    protected const DESCRIPTION = 'List cards

Official Ramp endpoint: GET /developer/v1/cards';
    protected const PARAMETERS = array (
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Ramp API operation.',
  ),
  'display_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `display_name` from the official Ramp API operation.',
  ),
  'is_activated' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_activated` from the official Ramp API operation.',
  ),
  'is_terminated' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_terminated` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/cards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'entity_id' => 'entity_id',
  'user_id' => 'user_id',
  'display_name' => 'display_name',
  'is_activated' => 'is_activated',
  'is_terminated' => 'is_terminated',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
