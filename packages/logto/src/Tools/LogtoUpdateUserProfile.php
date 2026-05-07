<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update user profile.
 *
 * Maps to PATCH /api/users/{userId}/profile in the official Logto OpenAPI source.
 */
class LogtoUpdateUserProfile extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user_profile',
  'class' => 'LogtoUpdateUserProfile',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/profile',
  'operation_id' => 'UpdateUserProfile',
  'summary' => 'Update user profile',
  'description' => 'Update profile for the given user ID. This method performs a partial update of the profile object.',
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
