<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update personal access token.
 *
 * Maps to PATCH /api/users/{userId}/personal-access-tokens in the official Logto OpenAPI source.
 */
class LogtoUpdatePersonalAccessTokenName extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_personal_access_token_name',
  'class' => 'LogtoUpdatePersonalAccessTokenName',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/personal-access-tokens',
  'operation_id' => 'UpdatePersonalAccessTokenName',
  'summary' => 'Update personal access token',
  'description' => 'Update a token for the user by name.',
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
