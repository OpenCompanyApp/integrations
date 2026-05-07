<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get application custom domains.
 *
 * Maps to GET /api/applications/{id}/protected-app-metadata/custom-domains in the official Logto OpenAPI source.
 */
class LogtoListApplicationProtectedAppMetadataCustomDomains extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_application_protected_app_metadata_custom_domains',
  'class' => 'LogtoListApplicationProtectedAppMetadataCustomDomains',
  'method' => 'GET',
  'path' => '/api/applications/{id}/protected-app-metadata/custom-domains',
  'operation_id' => 'ListApplicationProtectedAppMetadataCustomDomains',
  'summary' => 'Get application custom domains',
  'description' => 'Get custom domains of the specified application, the application type should be protected app.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
