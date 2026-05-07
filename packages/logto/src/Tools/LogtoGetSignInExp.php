<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get default sign-in experience settings.
 *
 * Maps to GET /api/sign-in-exp in the official Logto OpenAPI source.
 */
class LogtoGetSignInExp extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_sign_in_exp',
  'class' => 'LogtoGetSignInExp',
  'method' => 'GET',
  'path' => '/api/sign-in-exp',
  'operation_id' => 'GetSignInExp',
  'summary' => 'Get default sign-in experience settings',
  'description' => 'Get the default sign-in experience settings.',
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
