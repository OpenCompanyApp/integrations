<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update profile.
 *
 * Maps to PATCH /api/my-account in the official Logto OpenAPI source.
 */
class LogtoUpdateProfile extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_profile',
  'class' => 'LogtoUpdateProfile',
  'method' => 'PATCH',
  'path' => '/api/my-account',
  'operation_id' => 'UpdateProfile',
  'summary' => 'Update profile',
  'description' => 'Update profile for the user, only the fields that are passed in will be updated. Updating or deleting username requires a logto-verification-id header for checking sensitive permissions. Removing any sign-in identifier, including username, is rejected if it would remove the user\'s last identifier.',
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
