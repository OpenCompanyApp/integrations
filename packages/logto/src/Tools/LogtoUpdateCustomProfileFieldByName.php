<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update a custom profile field by name.
 *
 * Maps to PUT /api/custom-profile-fields/{name} in the official Logto OpenAPI source.
 */
class LogtoUpdateCustomProfileFieldByName extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_custom_profile_field_by_name',
  'class' => 'LogtoUpdateCustomProfileFieldByName',
  'method' => 'PUT',
  'path' => '/api/custom-profile-fields/{name}',
  'operation_id' => 'UpdateCustomProfileFieldByName',
  'summary' => 'Update a custom profile field by name',
  'description' => 'Update a custom profile field by name.',
  'parameters' =>
  array (
    'name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `name`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
