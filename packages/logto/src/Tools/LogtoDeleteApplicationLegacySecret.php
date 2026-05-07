<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete application legacy secret.
 *
 * Maps to DELETE /api/applications/{id}/legacy-secret in the official Logto OpenAPI source.
 */
class LogtoDeleteApplicationLegacySecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application_legacy_secret',
  'class' => 'LogtoDeleteApplicationLegacySecret',
  'method' => 'DELETE',
  'path' => '/api/applications/{id}/legacy-secret',
  'operation_id' => 'DeleteApplicationLegacySecret',
  'summary' => 'Delete application legacy secret',
  'description' => 'Delete the legacy secret for the application and replace it with a new internal secret. Note: This operation does not "really" delete the legacy secret because it is still needed for internal validation. We may remove the display of the legacy secret (the `secret` field in the application response) in the future.',
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
  'type' => 'write',
);
}
