<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List users.
 *
 * Maps to the official Ramp endpoint get /developer/v1/users.
 */
class RampGetUserListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_user_list_with_pagination';
    protected const DESCRIPTION = 'List users

Official Ramp endpoint: GET /developer/v1/users';
    protected const PARAMETERS = array (
  'employee_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `employee_id` from the official Ramp API operation.',
  ),
  'role' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `role` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'AUDITOR',
      1 => 'BUSINESS_ADMIN',
      2 => 'BUSINESS_BOOKKEEPER',
      3 => 'BUSINESS_OWNER',
      4 => 'BUSINESS_USER',
      5 => 'GUEST_USER',
      6 => 'IT_ADMIN',
    ),
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'USER_ACTIVE',
      1 => 'USER_DRAFT',
      2 => 'USER_INACTIVE',
      3 => 'USER_SUSPENDED',
    ),
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
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'department_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `department_id` from the official Ramp API operation.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `email` from the official Ramp API operation.',
  ),
  'location_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `location_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'employee_id' => 'employee_id',
  'role' => 'role',
  'status' => 'status',
  'start' => 'start',
  'page_size' => 'page_size',
  'entity_id' => 'entity_id',
  'department_id' => 'department_id',
  'email' => 'email',
  'location_id' => 'location_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
