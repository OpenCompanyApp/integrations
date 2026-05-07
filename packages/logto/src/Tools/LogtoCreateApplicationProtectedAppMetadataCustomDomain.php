<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add a custom domain to the application.
 *
 * Maps to POST /api/applications/{id}/protected-app-metadata/custom-domains in the official Logto OpenAPI source.
 */
class LogtoCreateApplicationProtectedAppMetadataCustomDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_application_protected_app_metadata_custom_domain',
  'class' => 'LogtoCreateApplicationProtectedAppMetadataCustomDomain',
  'method' => 'POST',
  'path' => '/api/applications/{id}/protected-app-metadata/custom-domains',
  'operation_id' => 'CreateApplicationProtectedAppMetadataCustomDomain',
  'summary' => 'Add a custom domain to the application',
  'description' => 'Add a custom domain to the application. You\'ll need to setup DNS record later.',
  'parameters' =>
  array (
    'id' =>
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
    'id' => 'id',
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
