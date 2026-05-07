<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Revoke a user session.
 *
 * Maps to DELETE /api/users/{userId}/sessions/{sessionId} in the official Logto OpenAPI source.
 */
class LogtoDeleteUserSession extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user_session',
  'class' => 'LogtoDeleteUserSession',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}/sessions/{sessionId}',
  'operation_id' => 'DeleteUserSession',
  'summary' => 'Revoke a user session',
  'description' => 'Revoke a specific user session by its ID, optionally revoking associated target grants and tokens.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'session_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the session.',
    ),
    'revoke_grants_target' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Optional target for revoking associated grants and tokens. \'all\' revokes grants for every application authorized by this session. \'firstParty\' revokes only first-party app grants; third-party app grants remain active. If omitted, grants remain active when the session authorizations include offline_access; otherwise they are revoked.',
      'enum' =>
      array (
        0 => 'all',
        1 => 'firstParty',
      ),
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
    'sessionId' => 'session_id',
  ),
  'query_params' =>
  array (
    'revokeGrantsTarget' => 'revoke_grants_target',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
