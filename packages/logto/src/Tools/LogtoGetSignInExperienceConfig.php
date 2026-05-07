<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get full sign-in experience.
 *
 * Maps to GET /api/.well-known/sign-in-exp in the official Logto OpenAPI source.
 */
class LogtoGetSignInExperienceConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_sign_in_experience_config',
  'class' => 'LogtoGetSignInExperienceConfig',
  'method' => 'GET',
  'path' => '/api/.well-known/sign-in-exp',
  'operation_id' => 'GetSignInExperienceConfig',
  'summary' => 'Get full sign-in experience',
  'description' => 'Get the full sign-in experience configuration.',
  'parameters' =>
  array (
    'organization_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `organizationId`.',
    ),
    'app_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `appId`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'organizationId' => 'organization_id',
    'appId' => 'app_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
