<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List limits.
 *
 * Maps to the official Ramp endpoint get /developer/v1/limits.
 */
class RampGetSpendLimitListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_spend_limit_list_with_pagination';
    protected const DESCRIPTION = 'List limits

Official Ramp endpoint: GET /developer/v1/limits';
    protected const PARAMETERS = array (
  'display_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `display_name` from the official Ramp API operation.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'spend_program_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `spend_program_id` from the official Ramp API operation.',
  ),
  'card_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `card_id` from the official Ramp API operation.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Ramp API operation.',
  ),
  'created_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_after` from the official Ramp API operation.',
  ),
  'created_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_before` from the official Ramp API operation.',
  ),
  'is_terminated' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_terminated` from the official Ramp API operation.',
  ),
  'user_access_roles' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `user_access_roles` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/limits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'display_name' => 'display_name',
  'entity_id' => 'entity_id',
  'spend_program_id' => 'spend_program_id',
  'card_id' => 'card_id',
  'user_id' => 'user_id',
  'created_after' => 'created_after',
  'created_before' => 'created_before',
  'is_terminated' => 'is_terminated',
  'user_access_roles' => 'user_access_roles',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
