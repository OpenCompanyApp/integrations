<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Revoke a session by ID.
 *
 * Maps to DELETE /api/my-account/sessions/{sessionId} in the official Logto OpenAPI source.
 */
class LogtoDeleteSessionById extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_session_by_id',
  'class' => 'LogtoDeleteSessionById',
  'method' => 'DELETE',
  'path' => '/api/my-account/sessions/{sessionId}',
  'operation_id' => 'DeleteSessionById',
  'summary' => 'Revoke a session by ID',
  'description' => 'Revoke a specific user session by its ID, optionally revoking target associated grants and tokens. A logto-verification-id in header is required for revoking sessions.',
  'parameters' =>
  array (
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
