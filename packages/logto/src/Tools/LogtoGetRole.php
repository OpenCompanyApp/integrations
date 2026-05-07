<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get role.
 *
 * Maps to GET /api/roles/{id} in the official Logto OpenAPI source.
 */
class LogtoGetRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_role',
  'class' => 'LogtoGetRole',
  'method' => 'GET',
  'path' => '/api/roles/{id}',
  'operation_id' => 'GetRole',
  'summary' => 'Get role',
  'description' => 'Get role details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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
