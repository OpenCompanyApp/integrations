<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Upsert ID token claims configuration.
 *
 * Maps to PUT /api/configs/id-token in the official Logto OpenAPI source.
 */
class LogtoUpsertIdTokenConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_upsert_id_token_config',
  'class' => 'LogtoUpsertIdTokenConfig',
  'method' => 'PUT',
  'path' => '/api/configs/id-token',
  'operation_id' => 'UpsertIdTokenConfig',
  'summary' => 'Upsert ID token claims configuration',
  'description' => 'Create or update the ID token extended claims configuration for the tenant. This controls which extended claims are included in ID tokens when the corresponding scopes are requested.',
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
