<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get a custom profile field by name.
 *
 * Maps to GET /api/custom-profile-fields/{name} in the official Logto OpenAPI source.
 */
class LogtoGetCustomProfileFieldByName extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_custom_profile_field_by_name',
  'class' => 'LogtoGetCustomProfileFieldByName',
  'method' => 'GET',
  'path' => '/api/custom-profile-fields/{name}',
  'operation_id' => 'GetCustomProfileFieldByName',
  'summary' => 'Get a custom profile field by name',
  'description' => 'Get a custom profile field by name.',
  'parameters' =>
  array (
    'name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
    'name' => 'name',
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
