<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create APIKey.
 *
 * Maps to POST /api/api-key in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateApikey extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_apikey',
  'class' => 'FusionAuthCreateApikey',
  'method' => 'POST',
  'path' => '/api/api-key',
  'operation_id' => 'createAPIKey',
  'summary' => 'create APIKey',
  'description' => 'Creates an API key. You can optionally specify a unique Id for the key, if not provided one will be generated. an API key can only be created with equal or lesser authority. An API key cannot create another API key unless it is granted to that API key. If an API key is locked to a tenant, it can only create API Keys for that same tenant.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
