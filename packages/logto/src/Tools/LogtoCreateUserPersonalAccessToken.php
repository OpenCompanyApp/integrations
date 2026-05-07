<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add personal access token.
 *
 * Maps to POST /api/users/{userId}/personal-access-tokens in the official Logto OpenAPI source.
 */
class LogtoCreateUserPersonalAccessToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_user_personal_access_token',
  'class' => 'LogtoCreateUserPersonalAccessToken',
  'method' => 'POST',
  'path' => '/api/users/{userId}/personal-access-tokens',
  'operation_id' => 'CreateUserPersonalAccessToken',
  'summary' => 'Add personal access token',
  'description' => 'Add a new personal access token for the user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
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
