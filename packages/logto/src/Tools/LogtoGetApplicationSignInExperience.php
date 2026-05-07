<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get the application level sign-in experience.
 *
 * Maps to GET /api/applications/{applicationId}/sign-in-experience in the official Logto OpenAPI source.
 */
class LogtoGetApplicationSignInExperience extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_application_sign_in_experience',
  'class' => 'LogtoGetApplicationSignInExperience',
  'method' => 'GET',
  'path' => '/api/applications/{applicationId}/sign-in-experience',
  'operation_id' => 'GetApplicationSignInExperience',
  'summary' => 'Get the application level sign-in experience',
  'description' => 'Get application level sign-in experience for a given application. - Only branding properties and terms links customization is supported for now. - Only third-party applications can have the sign-in experience customization for now.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
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
