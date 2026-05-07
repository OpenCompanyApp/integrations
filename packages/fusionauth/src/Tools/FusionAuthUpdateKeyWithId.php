<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Key With Id.
 *
 * Maps to PUT /api/key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateKeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_key_with_id',
  'class' => 'FusionAuthUpdateKeyWithId',
  'method' => 'PUT',
  'path' => '/api/key/{keyId}',
  'operation_id' => 'updateKeyWithId',
  'summary' => 'update Key With Id',
  'description' => 'Updates the key with the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the key to update.',
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
