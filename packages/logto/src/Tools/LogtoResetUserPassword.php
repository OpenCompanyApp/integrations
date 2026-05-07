<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Reset user password.
 *
 * Maps to PUT /api/experience/profile/password in the official Logto OpenAPI source.
 */
class LogtoResetUserPassword extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_reset_user_password',
  'class' => 'LogtoResetUserPassword',
  'method' => 'PUT',
  'path' => '/api/experience/profile/password',
  'operation_id' => 'ResetUserPassword',
  'summary' => 'Reset user password',
  'description' => 'Reset the user\'s password. (`ForgotPassword` interaction only)',
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
