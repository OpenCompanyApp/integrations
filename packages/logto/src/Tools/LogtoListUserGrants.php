<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user active grants.
 *
 * Maps to GET /api/users/{userId}/grants in the official Logto OpenAPI source.
 */
class LogtoListUserGrants extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_grants',
  'class' => 'LogtoListUserGrants',
  'method' => 'GET',
  'path' => '/api/users/{userId}/grants',
  'operation_id' => 'ListUserGrants',
  'summary' => 'Get user active grants',
  'description' => 'Retrieve all non-expired grants of the user. Optionally filter by application type via `appType`; when omitted, grants from all application types are returned.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'app_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Application type filter. Use \'thirdParty\' to list third-party app grants only, or \'firstParty\' to list first-party app grants only. If omitted, grants from all applications are returned.',
      'enum' =>
      array (
        0 => 'firstParty',
        1 => 'thirdParty',
      ),
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
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
