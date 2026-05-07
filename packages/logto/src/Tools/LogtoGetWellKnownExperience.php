<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get full sign-in experience.
 *
 * Maps to GET /api/.well-known/experience in the official Logto OpenAPI source.
 */
class LogtoGetWellKnownExperience extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_well_known_experience',
  'class' => 'LogtoGetWellKnownExperience',
  'method' => 'GET',
  'path' => '/api/.well-known/experience',
  'operation_id' => 'GetWellKnownExperience',
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
