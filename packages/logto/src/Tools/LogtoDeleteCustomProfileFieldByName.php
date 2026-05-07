<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete a custom profile field by name.
 *
 * Maps to DELETE /api/custom-profile-fields/{name} in the official Logto OpenAPI source.
 */
class LogtoDeleteCustomProfileFieldByName extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_custom_profile_field_by_name',
  'class' => 'LogtoDeleteCustomProfileFieldByName',
  'method' => 'DELETE',
  'path' => '/api/custom-profile-fields/{name}',
  'operation_id' => 'DeleteCustomProfileFieldByName',
  'summary' => 'Delete a custom profile field by name',
  'description' => 'Delete a custom profile field by name.',
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
  'type' => 'write',
);
}
