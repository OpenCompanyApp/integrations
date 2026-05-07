<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Revoke a user grant.
 *
 * Maps to DELETE /api/users/{userId}/grants/{grantId} in the official Logto OpenAPI source.
 */
class LogtoDeleteUserGrant extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user_grant',
  'class' => 'LogtoDeleteUserGrant',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}/grants/{grantId}',
  'operation_id' => 'DeleteUserGrant',
  'summary' => 'Revoke a user grant',
  'description' => 'Revoke a specific grant and its associated token chain by grant ID. Also removes the matching session authorization entry for this grant from the related active session. The grant must belong to the user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'grant_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the grant.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
    'grantId' => 'grant_id',
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
