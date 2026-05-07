<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get public interaction data.
 *
 * Maps to GET /api/experience/interaction in the official Logto OpenAPI source.
 */
class LogtoGetInteraction extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_interaction',
  'class' => 'LogtoGetInteraction',
  'method' => 'GET',
  'path' => '/api/experience/interaction',
  'operation_id' => 'GetInteraction',
  'summary' => 'Get public interaction data',
  'description' => 'Get the public interaction data.',
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
