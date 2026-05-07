<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user custom data.
 *
 * Maps to GET /api/users/{userId}/custom-data in the official Logto OpenAPI source.
 */
class LogtoListUserCustomData extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_custom_data',
  'class' => 'LogtoListUserCustomData',
  'method' => 'GET',
  'path' => '/api/users/{userId}/custom-data',
  'operation_id' => 'ListUserCustomData',
  'summary' => 'Get user custom data',
  'description' => 'Get custom data for the given user ID.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
