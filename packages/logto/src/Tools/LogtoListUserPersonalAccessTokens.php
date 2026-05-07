<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get personal access tokens.
 *
 * Maps to GET /api/users/{userId}/personal-access-tokens in the official Logto OpenAPI source.
 */
class LogtoListUserPersonalAccessTokens extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_personal_access_tokens',
  'class' => 'LogtoListUserPersonalAccessTokens',
  'method' => 'GET',
  'path' => '/api/users/{userId}/personal-access-tokens',
  'operation_id' => 'ListUserPersonalAccessTokens',
  'summary' => 'Get personal access tokens',
  'description' => 'Get all personal access tokens for the user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
