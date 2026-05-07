<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete personal access token.
 *
 * Maps to POST /api/users/{userId}/personal-access-tokens/delete in the official Logto OpenAPI source.
 */
class LogtoDeletePersonalAccessTokenPost extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_personal_access_token_post',
  'class' => 'LogtoDeletePersonalAccessTokenPost',
  'method' => 'POST',
  'path' => '/api/users/{userId}/personal-access-tokens/delete',
  'operation_id' => 'DeletePersonalAccessTokenPost',
  'summary' => 'Delete personal access token',
  'description' => 'Delete a token for the user by name.',
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
