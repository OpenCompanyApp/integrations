<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Health check.
 *
 * Maps to GET /api/status in the official Logto OpenAPI source.
 */
class LogtoGetStatus extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_status',
  'class' => 'LogtoGetStatus',
  'method' => 'GET',
  'path' => '/api/status',
  'operation_id' => 'GetStatus',
  'summary' => 'Health check',
  'description' => 'The traditional health check API. No authentication needed. > **Note** > Even if 204 is returned, it does not guarantee all the APIs are working properly since they may depend on additional resources or external services.',
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
