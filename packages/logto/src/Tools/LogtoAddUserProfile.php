<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add user profile.
 *
 * Maps to POST /api/experience/profile in the official Logto OpenAPI source.
 */
class LogtoAddUserProfile extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_add_user_profile',
  'class' => 'LogtoAddUserProfile',
  'method' => 'POST',
  'path' => '/api/experience/profile',
  'operation_id' => 'AddUserProfile',
  'summary' => 'Add user profile',
  'description' => 'Adds user profile data to the current experience interaction. - For `Register`: The profile data provided before the identification request will be used to create a new user account. - For `SignIn` and `Register`: The profile data provided after the user is identified will be used to update the user\'s profile when the interaction is submitted. - `ForgotPassword`: Not supported.',
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
