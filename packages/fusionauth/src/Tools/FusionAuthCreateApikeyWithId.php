<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create APIKey With Id.
 *
 * Maps to POST /api/api-key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateApikeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_apikey_with_id',
  'class' => 'FusionAuthCreateApikeyWithId',
  'method' => 'POST',
  'path' => '/api/api-key/{keyId}',
  'operation_id' => 'createAPIKeyWithId',
  'summary' => 'create APIKey With Id',
  'description' => 'Creates an API key. You can optionally specify a unique Id for the key, if not provided one will be generated. an API key can only be created with equal or lesser authority. An API key cannot create another API key unless it is granted to that API key. If an API key is locked to a tenant, it can only create API Keys for that same tenant.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique Id of the API key. If not provided a secure random Id will be generated.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'keyId' => 'key_id',
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
