<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch APIKey With Id.
 *
 * Maps to PATCH /api/api-key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchApikeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_apikey_with_id',
  'class' => 'FusionAuthPatchApikeyWithId',
  'method' => 'PATCH',
  'path' => '/api/api-key/{keyId}',
  'operation_id' => 'patchAPIKeyWithId',
  'summary' => 'patch APIKey With Id',
  'description' => 'Updates an API key with the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the API key. If not provided a secure random api key will be generated.',
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
