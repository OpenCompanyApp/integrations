<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create user.
 *
 * Maps to POST /api/users in the official Logto OpenAPI source.
 */
class LogtoCreateUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_user',
  'class' => 'LogtoCreateUser',
  'method' => 'POST',
  'path' => '/api/users',
  'operation_id' => 'CreateUser',
  'summary' => 'Create user',
  'description' => 'Create a new user with the given data.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
