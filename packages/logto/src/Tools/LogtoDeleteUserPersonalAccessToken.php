<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete personal access token.
 *
 * Maps to DELETE /api/users/{userId}/personal-access-tokens/{name} in the official Logto OpenAPI source.
 */
class LogtoDeleteUserPersonalAccessToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user_personal_access_token',
  'class' => 'LogtoDeleteUserPersonalAccessToken',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}/personal-access-tokens/{name}',
  'operation_id' => 'DeleteUserPersonalAccessToken',
  'summary' => 'Delete personal access token',
  'description' => 'Delete a token for the user by name using the legacy path parameter. Deprecated: use the POST /delete endpoint instead to avoid url name encoding issues.',
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
      'description' => 'The name of the token.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
