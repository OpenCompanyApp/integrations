<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get active user data.
 *
 * Maps to GET /api/dashboard/users/active in the official Logto OpenAPI source.
 */
class LogtoGetActiveUserCounts extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_active_user_counts',
  'class' => 'LogtoGetActiveUserCounts',
  'method' => 'GET',
  'path' => '/api/dashboard/users/active',
  'operation_id' => 'GetActiveUserCounts',
  'summary' => 'Get active user data',
  'description' => 'Get active user data, including daily active user (DAU), weekly active user (WAU) and monthly active user (MAU). It also includes an array of DAU in the past 30 days.',
  'parameters' =>
  array (
    'date' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The date to get active user data.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'date' => 'date',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
