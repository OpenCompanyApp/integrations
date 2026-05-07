<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update personal access token.
 *
 * Maps to PATCH /api/users/{userId}/personal-access-tokens/{name} in the official Logto OpenAPI source.
 */
class LogtoUpdateUserPersonalAccessToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user_personal_access_token',
  'class' => 'LogtoUpdateUserPersonalAccessToken',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/personal-access-tokens/{name}',
  'operation_id' => 'UpdateUserPersonalAccessToken',
  'summary' => 'Update personal access token',
  'description' => 'Update a token for the user by name using the legacy path parameter. Deprecated: use the PATCH /personal-access-tokens endpoint instead to avoid url name encoding issues.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The current name of the token.',
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
    'name' => 'name',
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
