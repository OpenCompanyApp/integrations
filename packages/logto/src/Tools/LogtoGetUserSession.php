<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user active session.
 *
 * Maps to GET /api/users/{userId}/sessions/{sessionId} in the official Logto OpenAPI source.
 */
class LogtoGetUserSession extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_user_session',
  'class' => 'LogtoGetUserSession',
  'method' => 'GET',
  'path' => '/api/users/{userId}/sessions/{sessionId}',
  'operation_id' => 'GetUserSession',
  'summary' => 'Get user active session',
  'description' => 'Retrieve a non-expired session for the user by session ID, including session metadata and interaction details when available.',
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
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
    'sessionId' => 'session_id',
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
