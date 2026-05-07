<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update password.
 *
 * Maps to POST /api/my-account/password in the official Logto OpenAPI source.
 */
class LogtoUpdatePassword extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_password',
  'class' => 'LogtoUpdatePassword',
  'method' => 'POST',
  'path' => '/api/my-account/password',
  'operation_id' => 'UpdatePassword',
  'summary' => 'Update password',
  'description' => 'Update password for the user, a logto-verification-id in header is required for checking sensitive permissions.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
