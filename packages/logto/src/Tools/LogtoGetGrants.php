<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get all active grants.
 *
 * Maps to GET /api/my-account/grants in the official Logto OpenAPI source.
 */
class LogtoGetGrants extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_grants',
  'class' => 'LogtoGetGrants',
  'method' => 'GET',
  'path' => '/api/my-account/grants',
  'operation_id' => 'GetGrants',
  'summary' => 'Get all active grants',
  'description' => 'Retrieve all active application grants for the user. A logto-verification-id in header is required for checking grant details.',
  'parameters' =>
  array (
    'app_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Optional application type filter. Use \'firstParty\' to return grants from first-party applications only, or \'thirdParty\' for third-party applications only.',
      'enum' =>
      array (
        0 => 'firstParty',
        1 => 'thirdParty',
      ),
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'appType' => 'app_type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
