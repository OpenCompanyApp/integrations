<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get profile.
 *
 * Maps to GET /api/my-account in the official Logto OpenAPI source.
 */
class LogtoGetProfile extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_profile',
  'class' => 'LogtoGetProfile',
  'method' => 'GET',
  'path' => '/api/my-account',
  'operation_id' => 'GetProfile',
  'summary' => 'Get profile',
  'description' => 'Get profile for the user.',
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
