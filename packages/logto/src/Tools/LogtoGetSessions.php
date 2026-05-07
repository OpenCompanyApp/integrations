<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get all active sessions.
 *
 * Maps to GET /api/my-account/sessions in the official Logto OpenAPI source.
 */
class LogtoGetSessions extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_sessions',
  'class' => 'LogtoGetSessions',
  'method' => 'GET',
  'path' => '/api/my-account/sessions',
  'operation_id' => 'GetSessions',
  'summary' => 'Get all active sessions',
  'description' => 'Retrieve all non-expired sessions for the user, including session metadata and interaction details when available. A logto-verification-id in header is required for checking sensitive session details.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
