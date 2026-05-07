<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get new user count.
 *
 * Maps to GET /api/dashboard/users/new in the official Logto OpenAPI source.
 */
class LogtoGetNewUserCounts extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_new_user_counts',
  'class' => 'LogtoGetNewUserCounts',
  'method' => 'GET',
  'path' => '/api/dashboard/users/new',
  'operation_id' => 'GetNewUserCounts',
  'summary' => 'Get new user count',
  'description' => 'Get new user count in the past 7 days.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
