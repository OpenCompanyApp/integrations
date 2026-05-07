<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove custom domain.
 *
 * Maps to DELETE /api/applications/{id}/protected-app-metadata/custom-domains/{domain} in the official Logto OpenAPI source.
 */
class LogtoDeleteApplicationProtectedAppMetadataCustomDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application_protected_app_metadata_custom_domain',
  'class' => 'LogtoDeleteApplicationProtectedAppMetadataCustomDomain',
  'method' => 'DELETE',
  'path' => '/api/applications/{id}/protected-app-metadata/custom-domains/{domain}',
  'operation_id' => 'DeleteApplicationProtectedAppMetadataCustomDomain',
  'summary' => 'Remove custom domain',
  'description' => 'Remove custom domain from the specified application.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
    'domain' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `domain`.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'domain' => 'domain',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
