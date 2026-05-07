<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update social identity of user.
 *
 * Maps to PUT /api/users/{userId}/identities/{target} in the official Logto OpenAPI source.
 */
class LogtoReplaceUserIdentity extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_user_identity',
  'class' => 'LogtoReplaceUserIdentity',
  'method' => 'PUT',
  'path' => '/api/users/{userId}/identities/{target}',
  'operation_id' => 'ReplaceUserIdentity',
  'summary' => 'Update social identity of user',
  'description' => 'Directly update a social identity of the user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'target' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `target`.',
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
    'target' => 'target',
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
