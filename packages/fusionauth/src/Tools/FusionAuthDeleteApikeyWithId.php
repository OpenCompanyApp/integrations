<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete APIKey With Id.
 *
 * Maps to DELETE /api/api-key/{keyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteApikeyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_apikey_with_id',
  'class' => 'FusionAuthDeleteApikeyWithId',
  'method' => 'DELETE',
  'path' => '/api/api-key/{keyId}',
  'operation_id' => 'deleteAPIKeyWithId',
  'summary' => 'delete APIKey With Id',
  'description' => 'Deletes the API key for the given Id.',
  'parameters' =>
  array (
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the authentication API key to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
