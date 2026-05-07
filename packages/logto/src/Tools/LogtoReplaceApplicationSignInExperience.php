<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update application level sign-in experience.
 *
 * Maps to PUT /api/applications/{applicationId}/sign-in-experience in the official Logto OpenAPI source.
 */
class LogtoReplaceApplicationSignInExperience extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_application_sign_in_experience',
  'class' => 'LogtoReplaceApplicationSignInExperience',
  'method' => 'PUT',
  'path' => '/api/applications/{applicationId}/sign-in-experience',
  'operation_id' => 'ReplaceApplicationSignInExperience',
  'summary' => 'Update application level sign-in experience',
  'description' => 'Update application level sign-in experience for the specified application. Create a new sign-in experience if it does not exist. - Only branding properties and terms links customization is supported for now. - Only third-party applications can be customized for now. - Application level sign-in experience customization is optional, if provided, it will override the default branding and terms links.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
    'applicationId' => 'application_id',
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
