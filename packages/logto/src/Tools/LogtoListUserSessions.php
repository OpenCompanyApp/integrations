<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user active sessions.
 *
 * Maps to GET /api/users/{userId}/sessions in the official Logto OpenAPI source.
 */
class LogtoListUserSessions extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_sessions',
  'class' => 'LogtoListUserSessions',
  'method' => 'GET',
  'path' => '/api/users/{userId}/sessions',
  'operation_id' => 'ListUserSessions',
  'summary' => 'Get user active sessions',
  'description' => 'Retrieve all non-expired sessions for the user, including session metadata and interaction details when available.',
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
