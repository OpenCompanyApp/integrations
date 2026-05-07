<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete social identity from user.
 *
 * Maps to DELETE /api/users/{userId}/identities/{target} in the official Logto OpenAPI source.
 */
class LogtoDeleteUserIdentity extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user_identity',
  'class' => 'LogtoDeleteUserIdentity',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}/identities/{target}',
  'operation_id' => 'DeleteUserIdentity',
  'summary' => 'Delete social identity from user',
  'description' => 'Delete a social identity from the user.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
