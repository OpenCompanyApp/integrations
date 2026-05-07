<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List unified requests with pagination.
 *
 * Maps to the official Ramp endpoint get /developer/v1/unified-requests.
 */
class RampGetUnifiedRequestListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_unified_request_list_with_pagination';
    protected const DESCRIPTION = 'List unified requests with pagination

Official Ramp endpoint: GET /developer/v1/unified-requests

NOTE: - Response schema is not finalized and will have breaking changes prior to release - This endpoint _is_ user aware, meaning perm-based filtering is applied to the query';
    protected const PARAMETERS = array (
  'department_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `department_ids` from the official Ramp API operation.',
  ),
  'entity_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `entity_ids` from the official Ramp API operation.',
  ),
  'location_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `location_ids` from the official Ramp API operation.',
  ),
  'owner_user_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `owner_user_ids` from the official Ramp API operation.',
  ),
  'spend_program_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `spend_program_ids` from the official Ramp API operation.',
  ),
  'spend_request_types' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `spend_request_types` from the official Ramp API operation.',
  ),
  'request_statuses' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `request_statuses` from the official Ramp API operation.',
  ),
  'unified_spend_request_types' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `unified_spend_request_types` from the official Ramp API operation.',
  ),
  'include_deleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_deleted` from the official Ramp API operation.',
  ),
  'min_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `min_amount` from the official Ramp API operation.',
  ),
  'max_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `max_amount` from the official Ramp API operation.',
  ),
  'from_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_created_at` from the official Ramp API operation.',
  ),
  'to_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_created_at` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/unified-requests';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'department_ids' => 'department_ids',
  'entity_ids' => 'entity_ids',
  'location_ids' => 'location_ids',
  'owner_user_ids' => 'owner_user_ids',
  'spend_program_ids' => 'spend_program_ids',
  'spend_request_types' => 'spend_request_types',
  'request_statuses' => 'request_statuses',
  'unified_spend_request_types' => 'unified_spend_request_types',
  'include_deleted' => 'include_deleted',
  'min_amount' => 'min_amount',
  'max_amount' => 'max_amount',
  'from_created_at' => 'from_created_at',
  'to_created_at' => 'to_created_at',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
