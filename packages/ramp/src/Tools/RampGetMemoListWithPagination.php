<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List memos.
 *
 * Maps to the official Ramp endpoint get /developer/v1/memos.
 */
class RampGetMemoListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_memo_list_with_pagination';
    protected const DESCRIPTION = 'List memos

Official Ramp endpoint: GET /developer/v1/memos';
    protected const PARAMETERS = array (
  'card_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `card_id` from the official Ramp API operation.',
  ),
  'department_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `department_id` from the official Ramp API operation.',
  ),
  'location_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `location_id` from the official Ramp API operation.',
  ),
  'manager_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `manager_id` from the official Ramp API operation.',
  ),
  'merchant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `merchant_id` from the official Ramp API operation.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Ramp API operation.',
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_date` from the official Ramp API operation.',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_date` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/memos';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'card_id' => 'card_id',
  'department_id' => 'department_id',
  'location_id' => 'location_id',
  'manager_id' => 'manager_id',
  'merchant_id' => 'merchant_id',
  'user_id' => 'user_id',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
