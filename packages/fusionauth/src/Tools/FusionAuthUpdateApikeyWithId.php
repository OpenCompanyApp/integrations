<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update APIKey With Id.
 *
 * Maps to PUT /api/api-key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateApikeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_apikey_with_id',
  'class' => 'FusionAuthUpdateApikeyWithId',
  'method' => 'PUT',
  'path' => '/api/api-key/{keyId}',
  'operation_id' => 'updateAPIKeyWithId',
  'summary' => 'update APIKey With Id',
  'description' => 'Updates an API key with the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the API key to update.',
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
