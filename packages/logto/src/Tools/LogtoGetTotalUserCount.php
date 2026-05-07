<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get total user count.
 *
 * Maps to GET /api/dashboard/users/total in the official Logto OpenAPI source.
 */
class LogtoGetTotalUserCount extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_total_user_count',
  'class' => 'LogtoGetTotalUserCount',
  'method' => 'GET',
  'path' => '/api/dashboard/users/total',
  'operation_id' => 'GetTotalUserCount',
  'summary' => 'Get total user count',
  'description' => 'Get total user count in the current tenant.',
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
