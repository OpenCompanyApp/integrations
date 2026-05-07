<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update user custom data.
 *
 * Maps to PATCH /api/users/{userId}/custom-data in the official Logto OpenAPI source.
 */
class LogtoUpdateUserCustomData extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user_custom_data',
  'class' => 'LogtoUpdateUserCustomData',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/custom-data',
  'operation_id' => 'UpdateUserCustomData',
  'summary' => 'Update user custom data',
  'description' => 'Update custom data for the given user ID. This method performs a partial update of the custom data object.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
    'userId' => 'user_id',
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
